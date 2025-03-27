<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\WorkProgressFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WorkProgressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:staff');
        // \DB::enableQueryLog();
    }

    public function index()
    {
        $workProgresses = WorkProgress::with('files')
            ->where('staff_id', auth('staff')->id())
            ->latest()
            ->paginate(10);

        return view('staff.work-progress.index', compact('workProgresses'));
    }

    public function create()
    {
        return view('staff.work-progress.create');
    }

    public function store(Request $request)
    {
        $user = auth('staff')->user();
        if (!$user) {
            return back()->with('error', 'No staff record found for your account. Please contact your supervisor.');
        }

        $validator = Validator::make($request->all(), [
            'project_topic' => ['required', 'string', Rule::in(['Perencanaan', 'Pengawasan', 'Kajian'])],
            'company_name' => 'required|string|max:255',
            'work_description' => 'required|string|min:100',
            'status' => ['required', 'string', Rule::in(['pending', 'in_progress', 'completed'])],
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|max:153600' // 150MB max per file
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!$request->hasFile('files')) {
            return back()->with('error', 'Please upload at least one file.');
        }
        
        try {
            DB::beginTransaction();
            
            $workProgress = WorkProgress::create([
                'staff_id' => $user->id,
                'project_topic' => $request->project_topic,
                'company_name' => $request->company_name,
                'work_description' => $request->work_description,
                'status' => $request->status,
                'start_date' => now()
            ]);

            foreach ($request->file('files') as $file) {
                // Get the actual MIME type from the file
                $mimeType = $file->getMimeType();
                if (!$mimeType) {
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_file($finfo, $file->getPathname());
                    finfo_close($finfo);
                }

                // Generate a unique filename with original extension
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '_' . str_replace(['#', '?', '%'], '-', $file->getClientOriginalName());
                
                // Store the file with original name preserved
                $path = $file->storeAs(
                    'work-progress/' . $user->id,
                    $filename,
                    ['disk' => 'public']
                );
                
                if (!$path || !Storage::disk('public')->exists($path)) {
                    throw new \Exception('Failed to store file: ' . $file->getClientOriginalName());
                }
                
                // Verify file integrity
                $storedSize = Storage::disk('public')->size($path);
                if ($storedSize !== $file->getSize()) {
                    Storage::disk('public')->delete($path);
                    throw new \Exception('File size mismatch for: ' . $file->getClientOriginalName());
                }
                
                WorkProgressFile::create([
                    'work_progress_id' => $workProgress->id,
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $mimeType ?: 'application/octet-stream',
                    'file_size' => $file->getSize()
                ]);
            }
            
            DB::commit();
            
            return redirect()
                ->route('staff.work-progress.index')
                ->with('success', 'Work progress submitted successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Work progress submission failed: ' . $e->getMessage());
            return back()
                ->with('error', 'Failed to submit work progress. Please try again.')
                ->withInput();
        }
    }

    public function show(WorkProgress $workProgress)
    {
        $this->authorize('view', $workProgress);
        return view('staff.work-progress.show', compact('workProgress'));
    }

    public function downloadFile(WorkProgressFile $file)
    {
        $this->authorize('view', $file->workProgress);

        if (!Storage::disk('public')->exists($file->file_path)) {
            return back()->with('error', 'File not found.');
        }

        try {
            $filePath = Storage::disk('public')->path($file->file_path);
            
            if (!file_exists($filePath)) {
                throw new \Exception('Physical file not found');
            }

            // Verify file size before sending
            $actualSize = filesize($filePath);
            if ($actualSize !== $file->file_size) {
                \Log::error('File size mismatch:', [
                    'file' => $file->original_name,
                    'expected' => $file->file_size,
                    'actual' => $actualSize
                ]);
                return back()->with('error', 'File integrity check failed.');
            }

            // Stream the file directly to output
            return response()->stream(
                function() use ($filePath) {
                    $handle = fopen($filePath, 'rb');
                    while (!feof($handle)) {
                        echo fread($handle, 8192);
                        flush();
                    }
                    fclose($handle);
                },
                200,
                [
                    'Content-Type' => $file->mime_type,
                    'Content-Disposition' => 'attachment; filename="' . rawurlencode($file->original_name) . '"; filename*=UTF-8\'\''. rawurlencode($file->original_name),
                    'Content-Length' => $actualSize,
                    'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
                    'Pragma' => 'public'
                ]
            );
            
        } catch (\Exception $e) {
            \Log::error('File download failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to download file. Please try again.');
        }
    }
    }