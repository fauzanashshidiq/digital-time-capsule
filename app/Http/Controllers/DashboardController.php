<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $lockedCapsules = $user->capsules()
            ->where('unlock_date', '>', now())
            ->orderBy('unlock_date')
            ->get();

        $unlockedCapsules = $user->capsules()
            ->where('unlock_date', '<=', now())
            ->orderByDesc('unlock_date')
            ->get();

        return view('dashboard', compact(
            'lockedCapsules',
            'unlockedCapsules'
        ));
    }

}
