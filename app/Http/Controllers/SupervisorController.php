<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor_Supervisor;
use App\Instituicao;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:supervisor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $id = Auth::id();
        session(['id_supervisor' => $id]);
        
        return view('supervisor');
    }

}
