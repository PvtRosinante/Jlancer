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

        return response()->json(['cv' => $cv]);
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

    public function updatecontact(Request $request, $id)
    {
        $cnt = Contact::find($id);

        $cnt->user_id = Auth::user()->id;
        $cnt->phone = $request->phone;
        $cnt->facebook = $request->facebook;
        $cnt->twitter = $request->twitter;
        $cnt->instagram = $request->instagram;
        $cnt->update();

        return response()->json(['Messages'=> 'Successfully updating the Contact']);
    }

    public function updateaward(Request $request, $id)
    {
        $aw = Award::find($id);

        $aw->user_id = Auth::user()->id;
        $aw->award = $request->award;
        $aw->update();

        return response()->json(['Messages'=> 'Successfully updating the Award']);
    }

    public function updateother(Request $request, $id)
    {
        $oth = Other::find($id);

        $oth->user_id = Auth::user()->id;
        $oth->birth = $request->birth;
        $oth->skill = $request->skill;
        $oth->language = $request->language;
        $oth->interest = $request->interest;
        $oth->other_info = $request->other_info;
        $oth->update();

        return response()->json(['Messages'=> 'Successfully updating the Other']);
    }

    public function updatesummary(Request $request, $id)
    {
        $sum = Summary::find($id);

        $sum->user_id = Auth::user()->id;
        $sum->summary = $request->summary;
        $sum->update();

        return response()->json(['Messages'=> 'Successfully updating the Summary']);
    }

    public function updateeducation(Request $request, $id)
    {
        $edu = Education::find($id);

        $edu->user_id = Auth::user()->id;
        $edu->agency = $request->agency;
        $edu->time = $request->time;
        $edu->study_prog = $request->study_prog;
        $edu->description = $request->description;
        $edu->update();

        return response()->json(['Messages'=> 'Successfully updating the Education']);
    }

    public function updateexperience(Request $request, $id)
    {
        $exp = Experience::find($id);

        $exp->user_id = Auth::user()->id;
        $exp->experience = $request->experience;
        $exp->time = $request->time;
        $exp->sub_exp = $request->sub_exp;
        $exp->description = $request->description;
        $exp->update();

        return response()->json(['Messages'=> 'Successfully updating the Experience']);
    }

    public function updateproject(Request $request, $id)
    {
        $prj = Project::find($id);

        $prj->user_id = Auth::user()->id;
        $prj->project = $request->project;
        $prj->time = $request->time;
        $prj->sub_project = $request->sub_project;
        $prj->description = $request->description;
        $prj->update();

        return response()->json(['Messages'=> 'Successfully updating the Project']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatecv(Request $request, $id)
    {
        $cnt = Contact::find($id);

        $cnt->user_id = Auth::user()->id;
        $cnt->phone = $request->phone;
        $cnt->facebook = $request->facebook;
        $cnt->twitter = $request->twitter;
        $cnt->instagram = $request->instagram;
        $cnt->update();


        $aw = Award::find($id);

        $aw->user_id = Auth::user()->id;
        $aw->award = $request->award;
        $aw->update();


        $oth = Other::find($id);

        $oth->user_id = Auth::user()->id;
        $oth->birth = $request->birth;
        $oth->skill = $request->skill;
        $oth->language = $request->language;
        $oth->interest = $request->interest;
        $oth->other_info = $request->other_info;
        $oth->update();


        $sum = Summary::find($id);

        $sum->user_id = Auth::user()->id;
        $sum->summary = $request->summary;
        $sum->update();

        $edu = Education::find($id);

        $edu->user_id = Auth::user()->id;
        $edu->agency = $request->agency;
        $edu->time = $request->time;
        $edu->study_prog = $request->study_prog;
        $edu->description = $request->description;
        $edu->update();


        $exp = Experience::find($id);

        $exp->user_id = Auth::user()->id;
        $exp->experience = $request->experience;
        $exp->time = $request->time;
        $exp->sub_exp = $request->sub_exp;
        $exp->description = $request->description;
        $exp->update();


        $prj = Project::find($id);

        $prj->user_id = Auth::user()->id;
        $prj->project = $request->project;
        $prj->time = $request->time;
        $prj->sub_project = $request->sub_project;
        $prj->description = $request->description;
        $prj->update();

        return response()->json(['Messages' => 'CV was successfully updated!']);
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

    public function delcontact($id)
    {
        $cnt = Contact::find($id);
        $cnt->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }
    
    public function delaward($id)
    {
        $aw = Award::find($id);
        $aw->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }

    public function delother($id)
    {
        $oth = Other::find($id);
        $oth->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }

    public function delsummary($id)
    {
        $sum = Summary::find($id);
        $sum->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }

    public function deleducation($id)
    {
        $edu = Education::find($id);
        $edu->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }

    public function delexperience($id)
    {
        $exp = Experience::find($id);
        $exp->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }

    public function delproject($id)
    {
        $prj = Project::find($id);
        $prj->delete();

        return response()->json(['Messages' => 'CV was successfully deleted!']);
    }
}
