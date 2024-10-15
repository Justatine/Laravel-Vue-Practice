<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::orderBy('created_at','DESC')->get();
        
        if ($posts->isEmpty()) {
            return response()->json([
                'success'=>false,
                'posts'=>$posts
            ], 204);
        }

        return response()->json([
            'success'=>true,
            'posts'=>$posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|min:3|max:20",
            "content" => "required|min:3|max:255",
        ]);

        $addPost = Posts::create($validated);
        if (!$addPost) {
            return response()->json([
                'success'=>false,
                'message'=>'Failed to add post'
            ], 204);
        }

        return response()->json([
            'success'=>false,
            'message'=>'Post added'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $post)
    {
        return response()->json([
            "success" => true,
            "post" => $post,
          ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $post)
    {
        $validated = $request->validate([
            "title" => "required|min:3|max:20",
            "content" => "required|min:3|max:255",
          ]);
      
          $post->update($validated);
      
          return response()->json([
            "success" => true,
            "message" => "Post updated",
            "post" => $post
          ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        if (!$post) {
            return response()->json([
                "success" => false,
                "message" => "Post not found"
              ], status: 404);
        }

        $post->delete();
        return response()->json([
          "success" => true,
          "message" => "Post deleted"
        ], 200);
    }
}
