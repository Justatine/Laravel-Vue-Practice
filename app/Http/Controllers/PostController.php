<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            "file" => "nullable|file|mimes:jpg,jpeg,png|max:2048",
        ]);

        if ($request->hasFile('file')) {
            // $filePath = $request->file('file')->store('files','public');
            $file = request()->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files/'), $imageName);

            $validated['file'] = $imageName;
        }

        $addPost = Posts::create($validated);
        if (!$addPost) {
            return response()->json([
                'success'=>true,
                'message'=>'Failed to add post'
            ], 204);
        }

        return response()->json([
            'success'=>false,
            'message'=>'Post added',
            'data'=>$validated
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
            "title" => "required|unique:posts|min:3|max:20",
            "content" => "required|min:3|max:255",
            "file" => "nullable|file|mimes:jpg,jpeg,png|max:2048",
        ]);
      
        if ($request->hasFile('file')) {
            if ($post->file) {
                $imagePath = public_path('files/'.$post->file);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $file = request()->file('file');
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files/'), $imageName);
    
                $validated['file'] = $imageName;
            }
            
        } else{
            $validated['file'] = $post->file;
        }

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

        if ($post->file) {
            $imagePath = public_path('files/'.$post->file);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $post->delete();
            return response()->json([
              "success" => true,
              "message" => "Post deleted"
            ], 200);
        }
    }
}
