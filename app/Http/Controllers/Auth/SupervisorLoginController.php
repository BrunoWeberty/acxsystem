<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SupervisorLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:supervisor', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.supervisor-login');
    }

    public function login(Request $request)
    {
    	//validar os dados do formulario
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	//registrar o usuario
    	if (Auth::guard('supervisor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    		//se bem sucedido, redirecionar
    		return redirect()->intended(route('supervisor.dashboard'));
    	}

    	//se não bem sucedido, redirecionar de volta para o login
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('supervisor')->logout();

        //$request->session()->invalidate();

        return redirect('/supervisor');
    }
}
