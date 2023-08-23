<?php

namespace App\Http\Controllers\Profiles\LibraryAccess;

use App\Http\Controllers\Controller;
use App\Models\LibraryUserAccesses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevokeController extends Controller
{
    public function __invoke($profileId)
    {
        $user = Auth::user();
        $user->accesses()->where('user_id_shared', $profileId)->delete();

        return redirect()->back()->with('success', 'Access revoked successfully.');
    }
}
