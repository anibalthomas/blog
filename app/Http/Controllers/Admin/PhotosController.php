<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
          $this->validate(request(), [
            // 'photo' => 'image|max:2048'  tambien puede ser defino la dimencion con |dimensions:min_height
            'photo' => 'required|image'
          ]);

          $photo = request()->file('photo');
    }
}
