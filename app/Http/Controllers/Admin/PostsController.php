<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {

        $categories = Category::all();
        $tags = tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));


    }
// public function store(Request $request) {         return $request->all();   }
public function store(Request $request)
{
    //validacion
  // return Post::create($request->all());

  $post = new Post;
  $post->title = $request->get('title');
  $post->body = $request->get('body');
  $post->excerpt = $request->get('excerpt');
  $post->published_at = Carbon::parse($request->get('published_at'));
  $post->category_id = $request->get('category');
  $post->save();

  $post->tags()->attach($request->get('tags'));
  
  return back()->with('flash','Tu publicación ha sido creada');
}



}
