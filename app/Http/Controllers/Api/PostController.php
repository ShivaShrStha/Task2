<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Fetch all posts
    public function index()
    {
        $posts = Post::all(); // Fetch all posts from the database
        return response()->json($posts);
    }

    // Create a new post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
        ]);

        $post = Post::create($validatedData);
        return response()->json($post, 201);
    }

    // Fetch a single post
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }

    // Delete a post
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(null, 204);
    }
}
