<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Forum/Users', [
            'users' => $users,
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Forum/UserDetails', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('Forum/EditUser', [
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
