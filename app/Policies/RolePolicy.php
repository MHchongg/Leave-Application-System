<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function is_user (User $user) {
        $user->role === 'user';
    }

    public function is_admin (User $user) {
        $user->role === 'admin';
    }
}
