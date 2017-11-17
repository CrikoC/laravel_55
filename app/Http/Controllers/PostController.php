<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Session;
use App\Category;
use App\Tag;
use Purifier;
use File;
use Image;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create variable and store all posts from database
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        //Reurn a view and pass in the variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required'
        ]);

        //Store data in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        //Save featured image
        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');

            //Save image
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'. $filename);
            Image::make($image)->save($location);
            $post->image = $filename;

            //Save thumbnail
            $thumbnail_filename = time() . '_small.' . $image->getClientOriginalExtension();
            $thumbnail_location = public_path('images/thumbnails/'. $thumbnail_filename);
            Image::make($image)->fit(300, 300)->save($thumbnail_location);
            $post->thumbnail = $thumbnail_filename;
        }

        $post->save();

        //attach the tags array to the created post
        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The post was successfully saved.');

        //redirect to the inserted post via ID
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //generate all the categoriew for the edit page
        $categories = Category::all();
        $cats = [];

//        foreach($categories as $category) {
//            $cats[$category->id] = $category->name;
//        }

        $tags = Tag::all();
        $tags2 = [];

        foreach($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        //find the post in the database and save it as a variable
        $post = Post::find($id);

        //Return view with the variable
        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if the slug already exists
        $post = Post::find($id);

        if($request->input('slug') == $post->slug) {
            //Validate the data without the slug
            $request->validate([
                'title'         => 'required|max:255',
                'category_id'   => 'required|integer',
                'body'          => 'required'
            ]);
        } else {
            //Validate the data with the slug
            $request->validate([
                'title'         => 'required|max:255',
                'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'   => 'required|integer',
                'body'          => 'required'
            ]);
        }

        //Store data in the database
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        //Save featured image
        if($request->hasFile('featured_image')) {
            //Delete existing
            File::delete('images/'. $post->image);
            File::delete('images/thumbnails/'. $post->thumbnail);

            $image = $request->file('featured_image');
            //Save image
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'. $filename);
            Image::make($image)->save($location);
            $post->image = $filename;

            //Save thumbnail
            $thumbnail_filename = time() . '_small.' . $image->getClientOriginalExtension();
            $thumbnail_location = public_path('images/thumbnails/'. $thumbnail_filename);
            Image::make($image)->fit(300, 300)->save($thumbnail_location);
            $post->thumbnail = $thumbnail_filename;

        }

        $post->save();


        if(isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

        //Set flush data with success message
        Session::flash('success', 'The post was successfully updated.');

        //redirect to the updated post via ID
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //Remove any reference of this post from the tags table
        $post->tags()->detach();

        File::delete('images/'. $post->image);
        File::delete('images/thumbnails/'. $post->thumbnail);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');

        return redirect()->route('posts.index');
    }
}
