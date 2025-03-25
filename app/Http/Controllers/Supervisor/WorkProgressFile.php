<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\WorkProgressFile as WorkProgressFileModel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WorkProgressFile extends Controller
{
    /**
     * Download a work progress file
     *
     * @param WorkProgressFileModel $file
     * @return StreamedResponse
     */
    public function __invoke(WorkProgressFileModel $file)
    {
        // Verify that the file belongs to a staff member supervised by the current user
        $this->authorize('view', $file->workProgress()->first());

        // Verify the file exists
        if (!Storage::exists($file->file_path)) {
            abort(404, 'File not found');
        }

        // Return the file as a download response
        return Storage::download(
            $file->file_path,
            $file->original_name
        );
    }
}