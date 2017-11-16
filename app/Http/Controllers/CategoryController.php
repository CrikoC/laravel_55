<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Session;


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
        $categories = Category::all();

        //Reurn a view and pass in the variable
        return view('categories.index')->withCategories($categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save a new category

        // Validate the data
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        //Store data in the database
        $category = new Category;

        $category->name = $request->name;


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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
