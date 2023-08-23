<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class LibraryAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        $profileId = $request->route('profileId');
        $user = Auth::user();

        if ($user->profile->id == $profileId) {
            return $next($request);
        }

        if ($user->hasLibraryAccess($profileId)) {
            $targetUser = User::findOrFail($profileId);
            if ($targetUser->hasLibraryAccess($user->profile->id)) {
                return $next($request);
            }
        }

        abort(403, 'Вы не имеете доступ к библиотеке.');
    }
}




