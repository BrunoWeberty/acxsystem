<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AlunoLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:aluno', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.aluno-login');
    }

    public function login(Request $request)
    {
    	//validar os dados do formulario
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	//registrar o usuario
    	if (Auth::guard('aluno')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    		//se bem sucedido, redirecionar
    		return redirect()->intended(route('aluno.dashboard'));
    	}

    	//se não bem sucedido, redirecionar de volta para o login
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('aluno')->logout();

       // $request->session()->invalidate();

        return redirect('/');
    }
}
