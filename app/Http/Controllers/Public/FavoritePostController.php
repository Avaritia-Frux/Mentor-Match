<?php

namespace App\Http\Controllers\Public;

use App\Models\User;
use App\Models\Post;
use App\Models\Company;
use App\Models\Category;
use App\Models\Post_like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class FavoritePostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('public')) {
            abort(403, 'Unauthorized action.');
        }

        $post_likes = Post_like::where('user_id', Auth::user()->id)->pluck('post_id');
        $posts = Post::whereIn('id', $post_likes)->get();

        if (count($posts) > 0) {
            $title = 'Your Favorite Programs : '. count($posts);
        } else {
            $title = 'Favorite Programs Not Found';
        }

        return view('public.favorite-posts.index', compact('posts', 'title'));
    }

    public function like($slug)
    {
        if (Gate::denies('public')) {
            abort(403, 'Unauthorized action.');
        }

        $post = Post::where('slug', $slug)->first();
        $like = new Post_like;
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        return redirect()->back();
    }

    public function unlike($slug)
    {
        if (Gate::denies('public')) {
            abort(403, 'Unauthorized action.');
        }

        $post = Post::where('slug', $slug)->first();
        $like = Post_like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        if ($like) {
            $like->delete();
        }
        return redirect()->back();
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
        if (Gate::denies('public')) {
            abort(403, 'Unauthorized action.');
        }

        $liked = Post_like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        $like = Post_like::where('post_id', $post->id)->count();
        $title = 'Detail Program : '. $post->title;
        return view('public.favorite-posts.show', compact('post', 'title', 'liked', 'like'));
    }

    public function show_by_category(Category $category)
    {
        if (Gate::denies('public')) {
            abort(403, 'Unauthorized action.');
        }

        $liked_post_ids = Post_like::where('user_id', Auth::user()->id)->pluck('post_id');
        $posts = $category->posts()->whereIn('id', $liked_post_ids)->get();
        $title = 'Programs By Category '. $category->name .' : '. count($posts);
        return view('public.favorite-posts.index', compact('posts', 'title'));
    }

    public function show_by_company(Company $company)
    {
        if (Gate::denies('public')) {
            abort(403, 'Unauthorized action.');
        }

        $liked_post_ids = Post_like::where('user_id', Auth::user()->id)->pluck('post_id');
        $posts = $company->posts()->whereIn('id', $liked_post_ids)->get();
        $title = 'Programs By Company '. $company->name .' : '. count($posts);
        return view('public.favorite-posts.index', compact('posts', 'title'));
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
