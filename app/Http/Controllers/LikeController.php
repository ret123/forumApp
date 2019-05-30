<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\LikeEvent;

class LikeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function likeIt(Reply $reply) {
        $reply->likes()->create([
            'user_id' => Auth::id()
        ]);
        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }
    public function unlikeIt(Reply $reply) {
        $reply->likes()->where('user_id', Auth::id())->first()->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();
    }
}
