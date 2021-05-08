<?php

namespace App\Http\Controllers;

use App\Forum;
use App\User;
use Illuminate\Http\Request;
use Pusher\Pusher;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $results = Forum::with(['user','comment.user','comment'])
                ->where('parent_id','=',null)
                ->orderBy('created_at', 'DESC')->get();
            return response()->json([
                'results' => $results
            ]);
        }
        return view('forums.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $forums = Forum::create($input);
        
        $options =  [
            'cluster' => 'ap1',
            'useTLS' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $message= "Hello Cloudways";

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('priority', 'App\\Events\\Priority', $message);
        return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Disimpan",
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        //
    }
}
