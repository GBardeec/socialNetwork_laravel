<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->isMethod('post')) {
            $login = htmlspecialchars($request->input('login'));
            $password = htmlspecialchars($request->input('password'));

            $user = User::where('login', $login)->first();

            if (!$user) {
                $user = $this->createUser($login, $password);
                Auth::login($user);
                return view('socialNetwork.index');
            } else {
                if ($this->verifyPassword($password, $user->password)) {
                    Auth::login($user);
                    return view('socialNetwork.index');
                }
            }
        }

        return view('auth.index');
    }

    private function createUser($login, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = User::create([
            'login' => $login,
            'password' => $hashedPassword,
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }

    private function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}
