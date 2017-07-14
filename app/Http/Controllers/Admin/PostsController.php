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

    // public function create()
    // {
    //
    //     $categories = Category::all();
    //     $tags = tag::all();
    //     return view('admin.posts.create', compact('categories', 'tags'));
    // }

        public function store(Request $request)
        {
          $this->validate($request, ['title' => 'required']);

          $post = Post::create([
            'title' => $request->get('title'),
            'url' => str_slug($request->get('title')),
          ]);

          return redirect()->route('admin.posts.edit', $post);
        }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = tag::all();
        return view('admin.posts.edit', compact('categories', 'tags', 'post'));

    }



// public function store(Request $request) {         return $request->all();   }
public function update(Post $post, Request $request)
{
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required',
      'category' => 'required',
      'excerpt' => 'required',
      'tags' => 'required'
    ]);
  // return Post::create($request->all());
  $post->title = $request->get('title');
  $post->url = str_slug($request->get('title'));
  $post->body = $request->get('body');
  $post->excerpt = $request->get('excerpt');
  $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
  // $post->published_at =  Carbon::parse($request->get('published_at'));
  $post->category_id = $request->get('category');
  $post->save();

  $post->tags()->sync($request->get('tags'));

  return redirect()->route('admin.posts.edit', $post)->with('flash','Tu publicación ha sido guardada');
}






}
