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
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }

        $posts = Post::where('creator_id', Auth::user()->id)->get();
        $title = 'Total Posts By You : '. count($posts);
        return view('creator.posts.index', compact('posts', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $title = 'Add Post';
        $categories = Category::all();
        $companies = Company::all();
        return view('creator.posts.create', compact('title', 'categories', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'post_image_path' => 'image|file|max:4096',
            'body' => 'required',
            'category_id' => 'required',
            'company_id' => 'required',
        ]);
        if ($request->file('post_image_path')) {
            $validatedData['post_image_path'] = $request->file('post_image_path')->store('post-images');
        }
        $validatedData['creator_id'] = Auth::user()->id;
        $validatedData['slug'] = Str::slug($request->title, '-');
        Post::create($validatedData);
        return redirect()->route('creator.posts.index')->with('status', 'Post Added Successfully!');
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
        return view('creator.posts.show', compact('post', 'title'));
    }

    public function show_by_category(Category $category)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $category->posts()->where('creator_id', Auth::user()->id)->get();
        $title = 'Posts By Category '. $category->name .' : '. count($posts);
        return view('creator.posts.index', compact('posts', 'title'));
    }

    public function show_by_company(Company $company)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $company->posts()->where('creator_id', Auth::user()->id)->get();
        $title = 'Posts By Company '. $company->name.' : '. count($posts);
        return view('creator.posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Gate::denies('creator')) {
            abort(403, 'Unauthorized action.');
        }
        $title = 'Edit Post : '. $post->title;
        $categories = Category::all();
        $companies = Company::all();
        return view('creator.posts.edit', compact('post', 'title', 'categories', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request -> validate([
            'title' => 'required|max:255',
            'post_image_path' => 'image|file|max:4096',
            'body' => 'required',
            'category_id' => 'required',
            'company_id' => 'required',
        ]);

        if ($request->file('post_image_path')) {
            if ($post->oldImage) {
                Storage::delete($post->oldImage);
            }
            $validatedData['post_image_path'] = $request->file('post_image_path')->store('post-images');
        }
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'company_id' => $request->company_id,
            'post_image_path' => $validatedData['post_image_path']??null,
        ]);
        return redirect()->route('creator.posts.index')->with('status', 'Post Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        return redirect()->route('creator.posts.index')->with('status', 'Post Deleted Successfully!');
    }
}
