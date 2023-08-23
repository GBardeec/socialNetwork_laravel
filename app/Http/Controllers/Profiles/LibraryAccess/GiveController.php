<?php

namespace App\Http\Controllers\Profiles\LibraryAccess;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GiveController extends Controller
{
    public function __invoke($profileId)
    {
        $user = Auth::user();
        $user->accesses()->create(['user_id_shared' => $profileId]);

        return redirect()->back()->with('success', 'Access granted successfully.');
    }
}

