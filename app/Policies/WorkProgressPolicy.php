<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\Supervisor;
use App\Models\WorkProgress;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkProgressPolicy
{
    use HandlesAuthorization;

    public function viewAny(Staff|Supervisor|null $user)
    {
        return true;
    }

    public function view(Staff|Supervisor $user, WorkProgress $workProgress)
    {
        return true;
    }

    public function create(Staff|Supervisor $user)
    {
        return true;
    }

    public function update(Staff|Supervisor $user, WorkProgress $workProgress)
    {
        return true;
    }

    public function delete(Staff|Supervisor $user, WorkProgress $workProgress)
    {
        return true;
    }
}