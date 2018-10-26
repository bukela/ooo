<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users',
            'role_id'    => 'required',
            'password'   => 'required|confirmed'
        ]);

        $user             = new User();
        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->email      = $data['email'];
        $user->role_id    = $data['role_id'];
        $user->password   = bcrypt($data['password']);

        $user->save();

        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'User created successfully.']);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|confirmed'
        ]);

        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->email      = $data['email'];

        if (isset($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->update();

        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'User updated successfully.']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('status', ['type' => 'success', 'message' => 'User deleted successfully.']);
    }
}
