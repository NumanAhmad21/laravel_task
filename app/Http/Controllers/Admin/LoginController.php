<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    
    public function index(){
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        // Set the content type to JSON
         header('Content-Type: application/json');
         $request->header('Content-Type', 'application/json');
         $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed...
            $notification=array(
                'messege'=>'Login Successfully!',
                'alert-type'=>'success'
                 );
            return redirect()->route('admin.home')->with($notification);
        } else {
            $notification=array(
                'messege'=>'Incorrect Credentials!',
                'alert-type'=>'error'
                 );
            return redirect()->route('admin.login')->with($notification);
        }
    }
    // 
    
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
