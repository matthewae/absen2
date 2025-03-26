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

                // Generate a unique filename
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                
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

        // Verify file integrity before sending
        $actualSize = Storage::disk('public')->size($file->file_path);
        if ($actualSize !== $file->file_size) {
            \Log::error('File size mismatch:', [
                'file' => $file->original_name,
                'expected' => $file->file_size,
                'actual' => $actualSize
            ]);
            return back()->with('error', 'File integrity check failed.');
        }

        // Get the MIME type using multiple methods for better accuracy
        $mimeType = $file->mime_type;
        $storedMimeType = Storage::disk('public')->mimeType($file->file_path);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $finfoMimeType = finfo_file($finfo, Storage::disk('public')->path($file->file_path));
        finfo_close($finfo);

        // Use the most specific MIME type available
        if ($finfoMimeType && $finfoMimeType !== 'application/octet-stream') {
            $mimeType = $finfoMimeType;
        } elseif ($storedMimeType && $storedMimeType !== 'application/octet-stream') {
            $mimeType = $storedMimeType;
        }

        // Special handling for common file types
        $extension = strtolower(pathinfo($file->original_name, PATHINFO_EXTENSION));
        $commonMimeTypes = [
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'exe' => 'application/x-msdownload'
        ];

        if (isset($commonMimeTypes[$extension])) {
            $mimeType = $commonMimeTypes[$extension];
        }

        // Set up proper headers for download
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Length' => $actualSize,
            'Content-Disposition' => 'attachment; filename="' . rawurlencode($file->original_name) . '"; filename*=UTF-8\'\''. rawurlencode($file->original_name),
            'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'X-Content-Type-Options' => 'nosniff'
        ];

        // Stream the file response
        return Storage::disk('public')->response($file->file_path, $file->original_name, $headers);
    }
}