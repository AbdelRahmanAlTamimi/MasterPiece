<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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

    public function create()
    {
        return Inertia::render('Forum/CreateUser');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users')->with('success', 'User created successfully');
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
