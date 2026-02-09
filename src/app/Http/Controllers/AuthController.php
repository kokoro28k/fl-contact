<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends Controller
{
  
public function showRegister() {
    
    return view('auth.register');

}

public function register(AuthRequest $request)
{
    $data = $request->validated();

    User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    return redirect('/admin');
}
    public function store(AuthRequest $request)
{
    $userData = $request->only(['name', 'email']);
    $userData['password'] = Hash::make($request->password);
    $user = User::create($userData);

    Auth::login($user);

    return redirect('/admin');
}

 public function showLogin()
    {
        return view('auth.login');
    }


    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->withErrors([
            'password' => 'ログイン情報が登録されていません',
        ]);
    }

     return redirect('/admin');

    
}




}