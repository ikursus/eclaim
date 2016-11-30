<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Semak adakah pengguna telah login?
      if ( Auth::check() )
      {
        // Jika ya, maka redirect ke dashboard user
        return redirect('user/dashboard');
      }

      // Paparkan template homepage jika pengguna belum lagi login
      return view('homepage');
    }


    public function dashboard()
    {
        return view('dashboard');
    }
}
