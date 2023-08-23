<?php

namespace App\Services\Auth;

use App\Models\Profile;
use App\Models\User;

class LoginService
{
    public function createUser(string $login, string $password): User
    {
        $user = User::create([
            'login' => $login,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        Profile::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
