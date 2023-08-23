<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private readonly LoginService $loginService)
    {

    }

    public function __invoke(AuthRequest $request): View
    {
        $data = $request->validated();

        $user = User::query()->where('login', $data['login'])->first() ?? $this->loginService->createUser($data['login'], $data['password']);

        abort_if(!password_verify($data['password'], $user->password), 403, 'Вы ввели неправельный пароль.');

        Auth::login($user);

        return view('socialNetwork.index');
    }
}
