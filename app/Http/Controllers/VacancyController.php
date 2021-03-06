<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Auth;

class VacancyController extends Controller
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vacancy::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($_FILES['img_banner']) {
            return response()->json(['Messages' => 'dsada']);
        }

        if ($request->img_banner) {
            // Get image file
            $image = $request->file(img_banner);
            // Make a image name based on user name and current timestamp
            $name = "vacancy".'_'.time();
            // Define folder path
            $folder = '/uploads/images/vacancies/banner/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image,$folder,'public', $name);

            return response()->json(['Messages' => 'dsada']);
        }

        $vcy = new Vacancy;

        $vcy->company = $request->company;
        $vcy->isi = $request->isi;
        $vcy->img_banner = $filePath;
        $vcy->user_id = Auth::user()->id;
        $vcy->skill_id = $request->skill_id;
        $vcy->gaji = $request->gaji;
        $vcy->save();

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
     * @param  \App\vangancy  $vangancy
     * @return \Illuminate\Http\Response
     */
    public function show(vangancy $vangancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vangancy  $vangancy
     * @return \Illuminate\Http\Response
     */
    public function edit(vangancy $vangancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vangancy  $vangancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->img_banner) {
            // Get image file
            $image = $request->img_banner;
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->img_banner).'_'.time();
            // Define folder path
            $folder = '/uploads/images/vacancies/banner/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image,$folder,'public', $name);
        }

        $vcy = Vacancy::find($id);

        $vcy->company = $request->company;
        $vcy->isi = $request->isi;
        $vcy->img_banner = $filePath;
        $vcy->user_id = $request->user_id;
        $vcy->gaji = $request->gaji;
        $vcy->update();

        return response()->json(['Messages' => 'Successfully updating the vacancy']);
    }

    public function delete($id)
    {
        $vng = Vacancy::find($id);

        $vng->delete();

        return response()->json(['Messages' => 'Successfully deleting the vacancy']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vangancy  $vangancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(vangancy $vangancy)
    {
        //
    }
}
