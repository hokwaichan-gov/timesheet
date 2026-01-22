<?php

namespace App\Policies;

use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TimesheetPolicy
{
    public function edit(User $user, Timesheet $timesheet)
    {
        return $timesheet->employee->user->is($user) || $user->isAdmin();
    }
}
