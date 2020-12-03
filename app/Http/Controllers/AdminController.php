<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
class AdminController extends Controller
{   
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout','Profile');
    }
    public function LoginView(){
        return view('AdminAuth.login');
    }

    public function RegisterView(){
        return view('AdminAuth.register');
    }
    public function Profile(){
        $user=Auth::guard('admin')->user();
        return view('AdminAuth.dashboard',compact('user'));
    }


    public function Register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 
        $admin=Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        event(new Registered($admin));
        return redirect('/admin/login');
    }
    public function Login(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]); 
        $credentials = $request->only('email', 'password');
        $user=Admin::where('email',$request->email)->first();
        if($user!=null && $user->hasVerifiedEmail()){
        if (Auth::guard('admin')->attempt($credentials) and 0){
            return redirect('/admin/profile');            
        }else{
            return redirect()->back();
        }

        }
       
        else{
            return redirect()->back();
        }


    }
    public function logout(){
      Auth::guard('admin')->logout();
      return redirect('/admin/login');
    }
}
