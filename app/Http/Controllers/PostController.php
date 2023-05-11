<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $post = Post::all();

        return response()->json(['success' =>true, 'data' => $post],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => request('user_id')
        ]);

        return response()->json(['success' =>true, 'data' => $post],201);
    }

    public function likePost(Request $request)
    {
        $post = PostUser::create([
            'like' => request('like'),
            'user_id' => request('user_id'),
            'post_id' => request('post_id')
        ]);

        return response()->json(['success' =>true, 'data' => $post],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        return response()->json(['success' =>true, 'data' => new PostResource($post)],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => request('user_id')
        ]);

        return response()->json(['success' =>true, 'data' => $post],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['success' =>true, 'message' => 'Data delete successlully!'],200);
    }
}
