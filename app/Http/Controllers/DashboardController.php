<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Designation;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * home dashboard - products
     */
    public function dashboard()
    {
        $totalDesignation = Designation::count();

        $totalUser = User::where('role', '!=', UserRoles::Admin->value)->count(); // all non admin users

        $userCounts = UserDetail::whereHas('user', function ($query) {
                            $query->where('role', '!=', UserRoles::Admin->value);
                        })
                        ->selectRaw('status, COUNT(*) as count')
                        ->groupBy('status')
                        ->pluck('count', 'status');

        return view('dashboard', [
            'total_designations' => $totalDesignation,
            'total_users' => $totalUser,
            'active_users' => $userCounts[1] ?? 0,
            'inactive_users' => $userCounts[0] ?? 0,
        ]);
    }
}
