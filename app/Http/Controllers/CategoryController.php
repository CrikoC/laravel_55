<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Session;
use Purifier;


class CategoryController extends Controller
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
        /*
        Display all categories It will also include a
        form to create a new category so no create function will be needed
        */

        // create variable and store all categories from database

        $categories = Category::orderBy('id', 'asc')->paginate(10);
        $parents = Category::where('parent_id', '=', '0')->get();

        //Reurn a view and pass in the variable
        return view('categories.index')->withCategories($categories)->withParents($parents);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::where('parent_id', '=', '0')->get();
        return view('categories.create')->withParents($parents);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required|max:255',
//            'slug'      => 'required|alpha_dash|min:5|max:255|unique:categories,slug',
//        ]);

        //Store data in the database
        $category = new Category;

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->body = Purifier::clean($request->body);
        $category->parent_id = $request->parent_id;



        $category->save();

        Session::flash('success', 'The category was successfully saved.');

        //redirect to the inserted post via ID
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $parents = Category::where('parent_id', '=', '0')->get();

        $category = Category::find($id);
        return view('categories.edit')->withCategory($category)->withParents($parents)->withCategories($categories);

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
        $category = Category::find($id);

//        if($request->input('slug') == $category->slug) {
//            //Validate the data without the slug
//            $this->validate($request, [
//                'name'         => 'required|max:255',
//                'category_id'   => 'required|integer',
//                'body'          => 'required'
//            ]);
//        } else {
//            //Validate the data with the slug
//            $this->validate($request, [
//                'name'         => 'required|max:255',
//                'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
//                'category_id'   => 'required|integer',
//                'body'          => 'required'
//            ]);
//        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->body = Purifier::clean($request->body);
        $category->parent_id = $request->parent_id;
        $category->save();

        Session::flash('success', 'The category was updated successfully.');

        return redirect()->route('categories.show', $category->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
