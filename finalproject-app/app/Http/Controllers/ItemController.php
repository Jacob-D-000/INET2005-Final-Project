<?php

// Project: finalproject-app/items
// Author: Jacob Dimoff
// Date: 4/12/23
// Filename: ItemController.php
// Purpose: Act as a way to connect all CRUD activity's for the items model

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class ItemController extends Controller {
    // Function to load the items index page.
    public function index() {

        // get all the category rows and store them in array
        $categories = Category::all();

        // get all item rows and store them in array
        $items = Item::all();

        // Unlike previous view returns, I won't use compact so I can return multiple arrays
        return view("items.index", [
            "categories" => $categories,
            "items" => $items
        ]);
    }

    // Function to load the item creation page.
    public function create() {
        
        // Adding categories to this create page will allow the user to select category to give an item from some kind of this.
        $categories = Category::all();

        // Return the create page for items including the array of all rows in the category database.
        return view("items.create", compact("categories"));
    }

    // Function to store newly created rows for the items table
    public function store(Request $request) {

        // Make sure all the data inputted by the user is valid
        $validatedData = $request->validate([
            "category_id" => "required",
            "title" => "required|unique:items|max:255",
            "description" => "required|max:255",

            // This regex will allow of the decimal number to a precision of two
            "price" => "required|regex:/^\d+(\.\d{1,2})?$/",
            "quantity" => "required|numeric",
            "SKU" => "required|unique:items|max:255",
            "picture" => "required|unique:items|file",
        ]);

        // If the category can't be found, redirect to the create form and display the appropriate error message.
        if (!Category::find($validatedData["category_id"])) {
            return redirect("/items/create")->with("error_category", "Category not found");
        }

        // If the form had an inputted file set the file path
        if ($request->hasFile("picture")) {
            $picturePath = $request->file("picture")->store("public/picture");
        }

        // Once all validation is complete, create an Item object which will be added to the database 
        Item::create([
            "category_id" => $validatedData["category_id"],
            "title" => $validatedData["title"],
            "description" => $validatedData["description"],
            "price" => $validatedData["price"],
            "quantity" => $validatedData["quantity"],
            "SKU" => $validatedData["SKU"],     
            "picture" => $picturePath
        ]); 

        // Return to the items index page and print the appropriate success message.
        return redirect("/items")->with("success", "New Item was created");   
    }

    // A function ot load the edit form based on an Items Id
    public function edit($id) {

        // Find the item in the database based on the item
        $item = Item::find($id);

        // Get all the category rows 
        $categories = Category::all();

        // return to the edit view for the items with the two previous variables packaged with it.
        return view("items.edit", [
            "categories"=> $categories,
            "item" => $item
        ]);
    }

    // Function to update an item row with request data based on an id
    public function update(Request $request, $id){

        // Find an item row based on an id
        $item =  Item::find($id);

        //  Validate all the data from the forms input
        $validatedData = $request->validate([
            "category_id" => "required",
            "title" => "required|max:255",
            "description" => "required|max:255",

            // This regex will allow of the decimal number to a precision of two
            "price" => "required|regex:/^\d+(\.\d{1,2})?$/",
            "quantity" => "required|numeric",
            "SKU" => "required|max:255",
            "picture" => "required|file",
        ]);

        // Search the database for the first row where the rows title field is equal to the validated data name and where the id doesn't match the current rows id 
        if (Item::where("title", $validatedData["title"])->where("id", "!=", $id)->first()) {
            return redirect("/items/{$id}/edit")->with("error_title", "Item already exists");
        }
        // Search the database for the first row where the rows SKU field is equal to the validated data name and where the id doesn't match the current rows id 
        if (Item::where("SKU", $validatedData["SKU"])->where("id", "!=", $id)->first()) {
            return redirect("/items/{$id}/edit")->with("error_SKU", "SKU already exists");
        }

        // If the form had an inputted file set the file path
        if ($request->hasFile("picture")) {
            $picturePath = $request->file("picture")->store("public/picture");
        }

        // update the current DTO with the validated form data.
       $item->update([
            "category_id" => $validatedData["category_id"],
            "title" => $validatedData["title"],
            "description" => $validatedData["description"],
            "price" => $validatedData["price"],
            "quantity" => $validatedData["quantity"],
            "SKU" => $validatedData["SKU"],     
            "picture" => $picturePath
        ]);    

        // redirect to the items page with the appropriate success message.
        return redirect("/items")->with("success", "Item has been updated");   
    }

    // Function to drop a row from the database based on the id
    public function destroy($id){

        // Find the item object with argument id
        $item = Item::find($id);

        // If the item doesn't exist, redirect back to the items page with the appropriate error message
        if (!$item) {
            return redirect("/items")->with('error_id', 'Item not found');
        }

        // Delete the item from the database
        $item->delete();

        // redirect to the item page with a message saying the item has been deleted.
        return redirect("/items")->with("success", "Item was deleted");
    }
}
