<?php

namespace App\Http\Controllers;

use App\User;
use App\Marketplace;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Auth;

class MarketplaceController extends Controller
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public function insertmp(Request $request)
    {
        if ($request->picture) {
            // Get image file
            $image = $request->picture;
            // Make a image name based on user name and current timestamp
            $name = 'marketplace'.'_'.time();
            // Define folder path
            $folder = '/uploads/images/marketplace/picture/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image,$folder,'public', $name);
        }

        $mp = new Marketplace;

        $mp->user_id = Auth::user()->id;
        $mp->goods = $request->goods;
        $mp->price = $request->price;
        $mp->location = $request->location;
        $mp->description = $request->description;
        $mp->picture = $filePath;
        $mp->save();

        return response()->json(['Messages' => 'New goods was already to sell']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mp = User::with(['marketplace'])->orderBy('created_at', 'DESC')->get();

        return response()->json(['marketplace' => $mp]);
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
     * @param  \App\Marketplace  $marketplace
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mp = User::with('marketplace')->orderBy('created_at', 'DESC')->findOrFail($id);

        return response()->json(['marketplace' => $mp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marketplace  $marketplace
     * @return \Illuminate\Http\Response
     */
    public function edit(Marketplace $marketplace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marketplace  $marketplace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->picture) {
            // Get image file
            $image = $request->picture;
            // Make a image name based on user name and current timestamp
            $name = 'marketplace'.'_'.time();
            // Define folder path
            $folder = '/uploads/images/marketplace/picture/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image,$folder,'public', $name);
        }

        $mp = Marketplace::find($id);
        $mp->user_id = Auth::user()->id;
        $mp->goods = $request->goods;
        $mp->price = $request->price;
        $mp->location = $request->location;
        $mp->description = $request->description;
        $mp->picture = $filePath;
        $mp->update();

        return response()->json(['Messages' => 'The goods has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marketplace  $marketplace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marketplace $marketplace)
    {
        //
    }

    public function deletemp($id)
    {
        $mp = Marketplace::find($id);
        $mp->delete();

        return response()->json(['Messages' => 'The goods has been deleted']);
    }
}
