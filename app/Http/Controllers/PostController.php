<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
  public function index() {
    // \Illuminate\Support\Facades\DB::listen(function($query) {
    //   logger($query->sql, $query->bindings);
    // });
    return view('posts', [
      // 'posts' => Post::all()
      // 'posts' => Post::latest()->with(['category', 'author'])->get()
      // 'posts' => Post::latest()->get(),
      // 'posts' => $posts->get(),
      'posts' => Post::latest()->filter(request(['search']))->get(),
      'categories' => Category::all()
    ]);
  }

  public function show(Post $post)
  {
    return view('post', [
      // 'post' => Post::findOrFail($id)
      'post' => $post
    ]);
  }
}

