<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
    public function start()
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
    public function view(Project $project)
    {
        return view('project.view', [
            'user' => Auth::user(),
            'project' => []
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
}
