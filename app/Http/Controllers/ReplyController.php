<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\Reply as ReplyResource;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewReplyNotification;

use App\Events\DeleteReplyEvent;

class ReplyController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        
        return ReplyResource::collection($question->replies);
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
    public function store(Question $question,Request $request)
    {   
        $request['user_id'] = Auth::id();
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        if($reply->user_id !== $question->user_id) {
            $user->notify(new NewReplyNotification($reply));
        }
     
        return response(['reply' => new ReplyResource($reply)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question,Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response('Updated', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response(null, 204);
    }
}
