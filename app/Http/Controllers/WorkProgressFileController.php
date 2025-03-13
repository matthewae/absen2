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

        return Storage::disk('public')->download(
            $file->file_path,
            $file->original_name
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

        return Storage::disk('public')->response(
            $file->file_path,
            $file->original_name,
            [
                'Content-Type' => $file->mime_type,
                'Content-Disposition' => 'inline; filename="' . $file->original_name . '"'
            ]
        );
    }
}