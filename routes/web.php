<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('posts', [
    'posts' => Post::all()
  ]);
});

Route::get('posts/{post}', function ($slug) {
  // Find a post by its slug and pass it to a view called "post"

  return view('post', [
    'post' => Post::find($slug)
  ]);
  // if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
  //   return redirect('/');
  //   // abort(404);
  // }

  // // $post = cache()->remember("posts.{$slug}", 1200, function() use ($path) {
  // //   return file_get_contents($path);
  // // });
  // $post = cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path)); // Short form

  // return view('post', ['post' => $post]);
})->where('post', '[A-z_\-]+');

