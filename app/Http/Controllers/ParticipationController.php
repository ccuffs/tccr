<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Project;
use App\Member;
use Carbon\Carbon;

class ParticipationController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $participation)
    {
        $request->validate([
            'title' => 'required',
            'period' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);

        $participation->abstract =  $request->get('abstract', '');
        $participation->save();

        return [
            'success' => true
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'period' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);

        $project = new Project([
            'title' => $request->get('title'),
            'abstract' => $request->get('abstract', ''),
            'period' => $request->get('period'),
            'type' => $request->get('type'),
            'status' => $request->get('status')
        ]);

        return [
            'success' => true
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Member $participation)
    {
        $participation->delete();

        return [
            'success' => true
        ];
    }
}
