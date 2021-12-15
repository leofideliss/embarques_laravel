<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    protected $table = 'users';

    public function showFormLogin()
    {
        return view('login');
    }

    public function home()
    {
        return redirect()->route('boarding.index');
    }

    public function login(Request $request)
    {

        if (!strlen($request->login) > 0 || strlen($request->login) > 10) {
            return redirect()->back()->withInput()->withErrors(['Login inválido']);
        }
        
        
        $user = (["login" => $request->login,"password" => $request->password]);
 
        if (Auth::attempt($user)) {
            return redirect()->route('home');
        }

        return redirect()->back()->withInput()->withErrors(['Dados inválidos']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('home');
    }
}
