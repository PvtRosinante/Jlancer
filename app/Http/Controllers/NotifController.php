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
        $user = User::all();
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            // 'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            // 'actionText' => 'View My Site',
            // 'actionURL' => url('/'),
            // 'order_id' => 101
        ];
  
        Notification::send($user, new jobnotif($details));

        return response()->json(['status' => 'Yes']);
    }
}
