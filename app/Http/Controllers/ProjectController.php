<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Project;
use App\Member;
use Carbon\Carbon;

class ProjectController extends Controller
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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        // TODO: check if user already has a project
        $existingMember = Member::where('user_id', Auth::user()->id)->first();

        if($existingMember) {
            dd($existingMember);
        }

        $project = Project::create([
            'type' => Project::TYPE_PLAN,
            'status' => Project::STATUS_WAITING_SUPERVISION
        ]);

        $member = Member::create([
            'user_id' => Auth::user()->id,
            'project_id' => $project->id,
            'role' => Member::AUTHOR,
            'confirmed' => true,
            'confirmed_on' => Carbon::now()
        ]);

        return $this->edit($project);
    }

    /**
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Project $project)
    {
        return view('project.view', [
            'user' => Auth::user(),
            'project' => $project
        ]);
    }

        /**
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Project $project)
    {
        return view('project.edit', [
            'user' => Auth::user(),
            'project' => $project
        ]);
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
            'type'=>'required'
        ]);

        $project = new Project([
            'type' => $request->get('first_name'),
        ]);

        $project->save();
        return redirect('/home')->with('success', 'Project saved!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $project = Project::find($id);
        $project->type =  $request->get('type');
        $project->save();

        return redirect('/home')->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect('/home')->with('success', 'Project deleted!');
    }
}
