<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class PublicBookAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        $book = $request->route('book');
        $user = Auth::user();
        $profileId = $request->route('profileId');

        if ($book->link_accessible == 1) {
            return $next($request);
        }

        if ($user && $user->profile->id == $profileId) {
            return $next($request);

            $profileId = $request->route('profileId');
            if ($user->hasLibraryAccess($profileId)) {
                $targetUser = User::findOrFail($profileId);
                if ($targetUser->hasLibraryAccess($user->profile->id)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Вы не имеете доступ к этой книге.');
    }
}




