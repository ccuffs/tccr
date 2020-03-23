<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Member;
use App\Project;

class InfoController extends Controller
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
    public function users()
    {
        return response()->json([
            ['username' => 'fernando.bevilacqua', 'email' => 'fernando.bevilacqua@uffs.edu.br', 'name' => 'Fernando Bevilacqua'],
            ['username' => 'lcaimi', 'email' => 'lcaimi@uffs.edu.br', 'name' => 'Luciano Lores Caimi'],
            ['username' => 'duarte', 'email' => 'duarte@uffs.edu.br', 'name' => 'Denio Duarte'],
        ]);
    }
}
