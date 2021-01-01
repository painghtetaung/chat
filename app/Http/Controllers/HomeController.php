<?php

namespace App\Http\Controllers;

use App\Models\Activefriend;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        $this->middleware('auth');
     
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activefriend = Activefriend::create([
            'activeFriend_id' => auth()->id(),
        ]);
        return view('home');
    }

    
}
