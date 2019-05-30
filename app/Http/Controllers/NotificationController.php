<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;
class NotificationController extends Controller
{  
   
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function index() {
        $user = Auth::user();
        return [
            'read' => NotificationResource::collection($user->readNotifications),
            'unread' => NotificationResource::collection($user->unreadNotifications),
            
        ];
        //  $unread=[];
        //  $read = [];
        // $user = Auth::user();
        // foreach ($user->unreadNotifications as $unreadNotification) {
        //    $unread = $unreadNotification;
        // }
        // foreach ($user->readNotifications as $readNotification) {
        //     $read = $readNotification;
        //  }
        // return [
        //     'read' => $read,
        //     'unread' =>$unread
        // ];
    }
    public function markAsRead(Request $request) {
        Auth::user()->notifications->where('id', $request->id)->markAsRead();
    }
}
