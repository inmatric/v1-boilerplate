<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('email') && $request->email != '') {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $users = $query->orderBy('email')->get();

        return view('users.index', compact('users'));
    }
    public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:users',
        'username' => 'required|string|unique:users',
        'address' => 'nullable|string',
        'password' => 'required|min:8',
        'role_name' => 'required|in:admin,user,hrd',
    ]);

    User::create([
        'email' => $validated['email'],
        'username' => $validated['username'],
        'address' => $validated['address'],
        'password' => Hash::make($validated['password']),
        'role_name' => $validated['role_name'],
    ]);

    return redirect('/users')->with('success', 'User berhasil ditambahkan.');
}
public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'address' => 'nullable|string',
            'role_name' => 'required|in:admin,user,hrd',
            'password' => 'nullable|min:8', // Add password validation
        ]);

        $data = [
            'email' => $validated['email'],
            'username' => $validated['username'],
            'address' => $validated['address'],
            'role_name' => $validated['role_name'],
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/users')->with('success', 'User berhasil dihapus.');
    }
}
