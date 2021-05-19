<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
  public $title;

  public $excerpt;

  public $date;

  public $body;

  public $slug;

  public function __construct($title, $excerpt, $date, $body, $slug)
  {
    $this->title = $title;
    $this->excerpt = $excerpt;
    $this->date = $date;
    $this->body = $body;
    $this->slug = $slug;
  }

  public static function all()
  {
    // $files = File::files(resource_path("posts"));
    // $posts = [];
    // foreach ($files as $file) {
    //   $document = YamlFrontMatter::parseFile($file);
    //   $posts[] = new Post(
    //     $document->title,
    //     $document->excerpt,
    //     $document->date,
    //     $document->body(),
    //     $document->slug,
    //   );
    // }

    // return $posts; // foreach way

    // $files = File::files(resource_path("posts"));
    // return $posts = array_map(function($file) {
    //   $document = YamlFrontMatter::parseFile($file);

    //   return new Post(
    //     $document->title,
    //     $document->excerpt,
    //     $document->date,
    //     $document->body(),
    //     $document->slug,
    //   );
    // }, $files); // array_map way

    return $posts = collect($files = File::files(resource_path("posts")))
      ->map(fn($file) => YamlFrontMatter::parseFile($file))
      ->map(fn($document) => new Post(
        $document->title,
        $document->excerpt,
        $document->date,
        $document->body(),
        $document->slug
      )); // Laravel collect way
  }

  // public static function find($slug)
  // {
  //   if (!file_exists($path = resource_path("/posts/{$slug}.html"))) {
  //     throw new ModelNotFoundException();
  //   }

  //   // $post = cache()->remember("posts.{$slug}", 1200, function() use ($path) {
  //   //   return file_get_contents($path);
  //   // });
  //   return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path)); // Short form
  // }


  public static function find($slug)
  {
    return static::all()->firstWhere('slug', $slug);
  }
}

