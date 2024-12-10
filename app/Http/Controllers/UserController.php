<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
    
        return view('users.index', compact('users'));
    }
    
    public function create()
{
    return view('users.create'); // Formani ko'rsatadigan view
}


    public function show(User $user)
{
    return view('users.show', compact('user'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|string|in:user,admin',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $user->assignRole($request->role);

    return redirect()->route('users.index')->with('success', 'User created successfully!');
}

protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // Default rolni belgilash (masalan: "user")
            $user->assignRole('user');
        });
    }

}
