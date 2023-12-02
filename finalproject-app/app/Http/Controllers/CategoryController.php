<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // function to return the form view aka the page the form is on.
    public function create() {
        return view("categories.create");
    }

    // this function will be called when the submit button has been pressed. I initially named the function submit but proper naming conventions suggest to use store
    public function store(Request $request) {

        // Validate the input if the request is invalid based off of the rules given, it continues down the logical flow. If the data is invalid, it should redirect back to the form with old data
        $validateData = $request->validate(["name"=>"required|unique:categories|max:255"]);

        // Once validated, create a new category object with the submitted data.
        Category::create($validateData);
        
        // Once the object has been created, go to the category page. Think about adding a message.
        return redirect("/categories");
    }
}
