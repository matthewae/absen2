<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\WorkProgress;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkProgressPolicy
{
    use HandlesAuthorization;

    public function viewAny(?Staff $staff)
    {
        return true;
    }

    public function view(Staff $staff, WorkProgress $workProgress)
    {
        return true;
    }

    public function create(Staff $staff)
    {
        return true;
    }

    public function update(Staff $staff, WorkProgress $workProgress)
    {
        return true;
    }

    public function delete(Staff $staff, WorkProgress $workProgress)
    {
        return true;
    }
}