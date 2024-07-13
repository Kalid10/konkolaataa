<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Index');
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role', 'all');

        $usersQuery = User::query();

        if ($search) {
            $usersQuery->where(function ($queryBuilder) use ($search) {
                $queryBuilder->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        if ($role !== 'all') {
            $usersQuery->where('role', $role);
        }

        $users = $usersQuery->paginate(10);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'search' => $search,
            'role' => $role,
        ]);
    }

    public function register(): Response
    {
        return Inertia::render('Admin/Users/Register');
    }
}
