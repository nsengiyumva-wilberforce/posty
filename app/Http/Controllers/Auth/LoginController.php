<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }
    public function index(Request $request){
            return view('auth.login');
    }
    public function store(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ]);

   if (!auth()->attempt($request->only('email', 'password'))){
       return back()->with('status', 'invalid login details');
   }
   return redirect()->route('dashboard');
    }
}
