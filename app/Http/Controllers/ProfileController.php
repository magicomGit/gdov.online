<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function news(){
        $posts = Post::orderByDesc('id')->paginate(20);
        return view('profile.news', compact('posts'));
    }

    public function createNews()
    {

        return view('profile.createNews');
    }

    public function editNews()
    {

        return view('profile.createNews');
    }
}


