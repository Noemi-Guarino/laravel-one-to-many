<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

        /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationResult = $request->validate([
            'title' => 'required|max:64',
            'slug' => 'nullable|max:1000',
            'content' => 'nullable|max:1000',
        ]);

        $post = Post::create($validationResult);
        // dd($validationResult);

        return redirect()->route('admin.posts.show', ['post' => $post->slug]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $validationResult = $request->validate([
            'title' => 'required|max:64',
            'slug' => 'nullable|max:1000',
            'content' => 'nullable|max:1000',
        ]);

        $post->update($validationResult);
        // dd($validationResult);
        return redirect()->route('admin.posts.index');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
