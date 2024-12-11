<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(25);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $input = $request->all();

        $request->validate([
            'title' => 'required|string|max:255',
            'post_image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'content' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('files', $imageName);
            $input['post_image'] = 'files/' . $imageName;
        }

        Post::create($input);

        return redirect()->route('posts.index')->with('success', 'Амжилттай хадгаллаа!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        $request->validate([
            'title' => 'required|string|max:255',
            'post_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'content' => 'required',
        ]);

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('files', $imageName);
            $input['post_image'] = 'files/' . $imageName;
        }

        $post->update($input);

        return redirect()->route('posts.index')->with('success', 'Амжилттай засагдлаа!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Амжилттай устгалаа!');
    }

    public function detail(Post $post)
    {
        return view('posts.detail', compact('post'));
    }

    public function list()
    {
        $posts = Post::latest()->paginate(10);  // Adjust the pagination per your need
        return view('posts.list', compact('posts'));
    }
}
