<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogPostController extends Controller
{
    // Show list of blog posts
    public function index()
    {
        $posts = BlogPost::all();
        return view('blog.index', compact('posts'));
    }

    // Show form to create a new blog post
    public function create()
    {
        return view('blog.create');
    }

    // Store a new blog post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('blog.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

        BlogPost::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.index');
    }

    // Show form to edit an existing blog post
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('blog.edit', compact('post'));
    }

    // Update an existing blog post
    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('blog.edit', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        // Handle image upload
        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.index');
    }

    // Delete a blog post
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        // Delete image from storage
        if ($post->image && Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('blog.index');
    }
}

