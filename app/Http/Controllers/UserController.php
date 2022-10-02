<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'users' => User::all()
        );
        return view('users.index', $data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'role' => 'required'
        ]);

        $data = array(
            'name'  =>  strtolower($request['name']),
            'email' =>  $request['email'],
            'role'  =>  $request['role'],
            'password' => Hash::make('bmis_2022')
        );

        User::create($data);
        return redirect()->back()->with('create', true);
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        $user->name = strtolower($request->name);
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('update', 1);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
