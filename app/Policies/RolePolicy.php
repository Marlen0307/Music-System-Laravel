<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function admin(User $user){
        return $user->isAdministrator();
    }

    public function artist (User $user){
        return $user->isArtist();
    }
}
