<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use App\Award;
use App\Other;
use App\Summary;
use App\Education;
use App\Experience;
use App\Project;
use Illuminate\Http\Request;
use Auth;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cv = User::with(['contact', 'award', 'other', 'summary', 'education', 'experience', 'project'])->orderBy('created_at', 'DESC')->get();

        return response()->json(['data' => $cv]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cv = User::with('contact')->with('award')->with('other')->with('summary')->with('education')->with('experience')->with('project')->orderBy('created_at', 'DESC')->findOrFail($id);

        return response()->json(['data' => $cv]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function insertcv(Request $request)
    {
        $cnt = new Contact;

        $cnt->user_id = Auth::user()->id;
        $cnt->phone = $request->phone;
        $cnt->facebook = $request->facebook;
        $cnt->twitter = $request->twitter;
        $cnt->instagram = $request->instagram;
        $cnt->save();


        $aw = new Award;

        $aw->user_id = Auth::user()->id;
        $aw->award = $request->award;
        $aw->save();


        $oth = new Other;

        $oth->user_id = Auth::user()->id;
        $oth->birth = $request->birth;
        $oth->skill = $request->skill;
        $oth->language = $request->language;
        $oth->interest = $request->interest;
        $oth->other_info = $request->other_info;
        $oth->save();


        $sum = new Summary;

        $sum->user_id = Auth::user()->id;
        $sum->summary = $request->summary;
        $sum->save();

        $edu = new Education;

        $edu->user_id = Auth::user()->id;
        $edu->agency = $request->agency;
        $edu->time = $request->time;
        $edu->study_prog = $request->study_prog;
        $edu->description = $request->description;
        $edu->save();


        $exp = new Experience;

        $exp->user_id = Auth::user()->id;
        $exp->experience = $request->experience;
        $exp->time = $request->time;
        $exp->sub_exp = $request->sub_exp;
        $exp->description = $request->description;
        $exp->save();


        $prj = new Project;

        $prj->user_id = Auth::user()->id;
        $prj->project = $request->project;
        $prj->time = $request->time;
        $prj->sub_project = $request->sub_project;
        $prj->description = $request->description;
        $prj->save();

        return response()->json(['Messages' => 'CV was successfully inserted!']);
    }
}
