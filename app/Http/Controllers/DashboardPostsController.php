<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.posts.index',[
            'posts' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'content' => 'required'
        ]);

        Post::create($validatedData);
        return redirect('/dashboard/posts')->with('success', 'Post berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show',[
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit',[
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules =[
            'title' => 'required|max:255',
            'content' => 'required'
        ];
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        Post::where('id', $post->id)->update($validatedData);
        return redirect('/dashboard/posts')->with('success', 'Post berhasil diUbah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $slug = Post::where('slug', $post->slug)->first();
        // dd($slug->id);
        Post::destroy($slug->id);
        return redirect('/dashboard/posts')->with('success', 'Data Berhasil DiHapus');
    }

    public function checkSlug(Request $request)
    {
        $title = $request->input('title');
        $slug = SlugService::createSlug(Post::class, 'slug', $title);
        return response()->json($slug);
    }
}
