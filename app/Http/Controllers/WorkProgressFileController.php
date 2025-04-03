<?php

namespace App\Http\Controllers;

use App\Models\WorkProgressFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WorkProgressFileController extends Controller
{
    public function download(WorkProgressFile $file)
    {
        if (!Storage::disk('public')->exists($file->file_path)) {
            return back()->with('error', 'File not found.');
        }

        $stream = Storage::disk('public')->readStream($file->file_path);
        $headers = [
            'Content-Type' => $file->mime_type,
            'Content-Length' => Storage::disk('public')->size($file->file_path),
            'Content-Disposition' => 'attachment; filename="' . $file->original_name . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            },
            200,
            $headers
        );
    }

    public function destroy(WorkProgressFile $file)
    {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();

        return back()->with('success', 'File deleted successfully.');
    }

    public function stream(WorkProgressFile $file): StreamedResponse
    {
        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File not found');
        }

        $stream = Storage::disk('public')->readStream($file->file_path);
        $headers = [
            'Content-Type' => $file->mime_type,
            'Content-Length' => Storage::disk('public')->size($file->file_path),
            'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            },
            200,
            $headers
        );
    }
}