<?php

// Project: finalproject-app/categories
// Author: Jacob Dimoff
// Date: 4/12/23
// Filename: CategoryController.php
// Purpose: Act as a way to connect all CRUD activity's for the Category model

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller {
    // function to return and index page
    public function index() {
        
        // Get all category tows and store it in a variable
        $categories = Category::all();

        // return the categories index view with the array of category rows from the database.
        return view("categories.index", compact("categories"));
    }

    // function to return the form view aka the page the form is on.
    public function create() {
        return view("categories.create");
    }

    // Function to store new rows passed on the data based by the create form
    public function store(Request $request) {

        // Validate the name field
        $validateData = $request->validate(["name"=>"required|unique:categories|max:255"]);

        // Create a new category object with the validated name as an argument.
        Category::create($validateData);
        
        // redirect to the index page with the appropriate success message.
        return redirect("/categories")->with("success", "A new category was created.");
    }

    // Function to load the edit view for categories
    public function edit($id) {

        // Using the id provided by the request (based off of the category the user chooses to edit), get the corresponding row from the database.
        $category = Category::find($id);

        // Return the edit view for categories with the category row as taken based on the id. This will allow the page to uses that rows day inside of it.
        return view('categories.edit', compact('category'));
    }
    
    // Validation and updating existing category
    public function update(Request $request, $id) {
        
        // Using the id of the edited field, find the row within th database
        $category = Category::find($id);

        // Validate the date so that it can be inputted into the database properly
        $validateData = $request->validate(["name"=>"required|max:255"]);
        
        // Search the database for the first row where the rows name field is equal to the validated data name and where the id doesn't match the current rows id 
        if (Category::where("name", $validatedData["name"])->where("id", "!=", $id)->first()) {

            // If true, redirect to the edit page and print the appropriate error message.
            return redirect("/categories/{$id}/edit")->with("error_name", "Category already exists");
        }
        
        // update the category DTO with the validated data
        $category->update($validateData);

        // Redirect to the category's index age with a message saying the item has been updated.
        return redirect("/categories")->with("success", "Category was successfully updated.");       
    }
}
