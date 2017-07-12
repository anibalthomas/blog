<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use Carbon\Carbon;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Post::truncate();
          Category::truncate();

          $category = new Category;
          $category->name = "Categoria 1";
          $category->save();

          $category = new Category;
          $category->name = "Categoria 2";
          $category->save();



          $post = new Post;
          $post->title = "Mi primer Post";
          $post->url = str_slug("Mi primer Post");
          $post->excerpt = "Extracto de mi primer post";
          $post->body = "<p>Contenido de mi primer post</p>";
          $post->published_at = Carbon::now()->subDays(4);
          $post->category_id = 1;
          $post->save();

          $post = new Post;
          $post->title = "Mi segundo Post";
          $post->url = str_slug("Mi segundo Post");
          $post->excerpt = "Extracto de mi segundo post";
          $post->body = "<p>Contenido de mi segundo post</p>";
          $post->published_at = Carbon::now()->subDays(3);
          $post->category_id = 1;
          $post->save();

          $post = new Post;
          $post->title = "Mi tercer Post";
          $post->url = str_slug("Mi tercer Post");
          $post->excerpt = "Extracto de mi tercer post";
          $post->body = "<p>Contenido de mi tercer post</p>";
          $post->published_at = Carbon::now()->subDays(2);
          $post->category_id = 1;
          $post->save();

          $post = new Post;
          $post->title = "Mi cuarto Post";
          $post->url = str_slug("Mi cuarto Post");
          $post->excerpt = "Extracto de mi cuarto post";
          $post->body = "<p>Contenido de mi cuarto post</p>";
          $post->published_at = Carbon::now()->subDays(1);
          $post->category_id = 2;
          $post->save();

          $post = new Post;
          $post->title = "Mi quinto Post";
          $post->url = str_slug("Mi quinto Post");
          $post->excerpt = "Extracto de mi quinto post";
          $post->body = "<p>Contenido de mi quinto post</p>";
          $post->published_at = Carbon::now();
          $post->category_id = 2;
          $post->save();




    }
}
