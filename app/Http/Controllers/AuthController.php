<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    /**
     * User login view
     */
    public function login()
    {
        return view('login');
    }

    /**
     * User register view 
     */
    public function register()
    {
        return view('register');
    }

    /**
     * User Signin - Registration
     */
    public function signup(AdminRegisterRequest $request)
    {
        
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => UserRoles::Admin->value,
        ]);
         
        return redirect('dashboard')->withSuccess('You have signed-in');

    }

    /**
     * User Login - authenticate
     */
    public function authenticate(AdminLoginRequest $request)
    {
        
        $credentials = $request->validated();  

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role === UserRoles::Admin->value) {
                return redirect()->intended('dashboard')->withSuccess('Signed in');
            }
    
            Auth::logout();
            return back()->withInput()->withErrors(['email' => 'Invalid access!']);
        }
    
        return back()->withInput()->withErrors(['email' => 'Invalid credentials']);

    }

    /**
     * User Logout
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}
