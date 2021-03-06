<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($slug) {
        //fetsh from db based on slug
        $post = Post::where('slug', '=', $slug)->first();

        //return view and pass in the post object
        return view('blog.single')->withPost($post);
    }

    public function getIndex() {

        //fetsh from db
        $posts = Post::paginate(10);

        //return view and pass in the post object
        return view('blog.index')->withPosts($posts);
    }
}
