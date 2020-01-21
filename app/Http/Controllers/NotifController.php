<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Notification;
use App\Notifications\jobnotif;
use App\User;
use Auth;

class NotifController extends Controller
{
    public function add(Request $req ){
        $user = User::find(2);
        $pelamar = Auth::user()->id();
        $details = [
            'body' => $pelamar.'Melamar Kerja',
            'id_job' => 2,
            'actionURL' => url('/'),
        ];
  
        Notification::send($user, new jobnotif($details));

        return response()->json(['status' => 'Yes']);
    }
}
