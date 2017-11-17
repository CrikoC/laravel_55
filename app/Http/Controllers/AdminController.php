<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Session;
use App\Category;
use App\Tag;
use App\Comment;
use Purifier;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        $tags = Tag::all();
        $comments = Comment::orderBy('id', 'desc')->paginate(10);

        return view('admin.index')->withCategories($categories)
                                        ->withPosts($posts)
                                        ->withTags($tags)
                                        ->withComments($comments);
    }
}