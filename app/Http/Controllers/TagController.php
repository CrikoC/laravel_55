<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Tag;
use Session;

class TagController extends Controller
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
        // create variable and store all tags from database
        $tags = Tag::all();

        //Reurn a view and pass in the variable
        return view('tags.index')->withTags($tags);
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
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        //Store data in the database
        $tag = new Tag;

        $tag->name = $request->name;


        $tag->save();

        Session::flash('success', 'The tag was successfully saved.');

        //redirect to the tags
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.edit')->withTag($tag);
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
        $tag = Tag::find($id);
        $this->validate($request, ['name'=> 'required|max:255']);

        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'The tag was updated successfully.');

        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        //Remove any reference of this tag from the posts
        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success', 'The tag was deleted successfully.');

        return redirect()->route('tags.index');
    }
}
