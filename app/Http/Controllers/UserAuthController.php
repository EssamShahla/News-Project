<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLogin($guard){
        return response()->view('cms.authuntication.login' , compact('guard'));
    }

    public function login(Request $request){
        $validator = Validator($request->all() ,[
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'

        ]);

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials)) {
                return response()->json(['icon' => 'success', 'title' => 'Login is Successfully'], 200);
            }else {
                return response()->json([
                'icon' => 'error',
                'title' => 'incorrect password or email'],
                400);
            }
        } else {
            return response()->json([
                'icon' => 'error' ,
                'message' => $validator->getMessageBag()->first()],
                 400);
        }
    }

    public function logout(Request $request){
        $guard = Auth('admin')->check() ? 'admin' : 'author' ;
        Auth::guard($guard)->logout();
        $request->session()->invalidate();

        return redirect()->route('showLogin' , $guard);
    }

    public function changePassword(){

    }

    public function resetPassword(Request $request){

    }

    public function editProfile($id){

    }

    public function updateProfile(Request $request , $id){

    }
}
