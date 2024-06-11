<?php

namespace App\Http\Controllers\Creator;

use App\Models\Post;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AllPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }

        $posts = Post::all();
        $title = 'Total Posts : '. count($posts);
        return view('creator.all-posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $title = 'Detail Post : '. $post->title;
        return view('creator.all-posts.show', compact('post', 'title'));
    }


    public function show_by_creator(User $creator)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $creator->posts;
        $title = 'Posts By Creator '. $creator->name.' : '. count($posts);
        return view('creator.all-posts.index', compact('posts', 'title'));
    }

    public function show_by_category(Category $category)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $category->posts;
        $title = 'Posts By Category '. $category->name .' : '. count($posts);
        return view('creator.all-posts.index', compact('posts', 'title'));
    }

    public function show_by_company(Company $company)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $company->posts;
        $title = 'Posts By Company '. $company->name.' : '. count($posts);
        return view('creator.all-posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return redirect()->back();
    }
}
