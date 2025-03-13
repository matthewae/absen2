<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\WorkProgressFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkProgressFilePolicy
{
    use HandlesAuthorization;

    public function view(Staff $staff, WorkProgressFile $file)
    {
        return true;
    }

    public function download(Staff $staff, WorkProgressFile $file)
    {
        return true;
    }

    public function delete(Staff $staff, WorkProgressFile $file)
    {
        return true;
    }
}