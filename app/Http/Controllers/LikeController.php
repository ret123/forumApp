<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeIt(Reply $reply) {
        $reply->likes()->create([
            'user_id' => '1'
        ]);
    }
    public function unlikeIt(Reply $reply) {
        $reply->likes()->where('user_id', '1')->first()->delete();
    }
}
