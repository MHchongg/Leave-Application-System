<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;

class LeavePolicy
{
    
    public function view_leave (User $user, Leave $leave) {
        if ($user->role === 'admin') {
            return true;
        }
        return $user->id === $leave->user_id;
    }

    public function delete_leave (User $user, Leave $leave) {
        return $user->id === $leave->user_id;
    }

    public function __construct()
    {
        //
    }
}
