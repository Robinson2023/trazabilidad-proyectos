<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view(
            'users.index',
            compact('users')
        );
    }

    public function updateRole(
        Request $request,
        User $user
    )
    {
        $request->validate([
            'role' => 'required'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return back()->with(
            'success',
            'Rol actualizado'
        );
    }

    public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required'
    ]);

    User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role' => $data['role']
    ]);

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'Usuario creado correctamente'
        );
}
}
