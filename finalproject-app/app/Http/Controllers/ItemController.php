<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class ItemController extends Controller
{

    public function index() {
        $categories = Category::all();
        $items = Item::all();

        // Unlike previous view returns, I won't use compact so I can return multiple arrays
        return view("items.index", [
            "categories" => $categories,
            "items" => $items
        ]);
    }

    //
    public function create() {
        
        // Adding categories to this create page will allow the user to select category to give an item from some kind of this.
        $categories = Category::all();
        return view("items.create", compact("categories"));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            "category_id" => "required",
            "title" => "required|unique:items|max:255",
            "description" => "required|max:255",
            "price" => "required",
            "quantity" => "required|numeric",
            "SKU" => "required|unique:items|max:255",
            "picture" => "required|unique:items|file",
        ]);

        
        if (!Category::find($validatedData["category_id"])) {
            return redirect("/items/create")->with("error_category", "Category not found");
        }

        if ($request->hasFile("picture")) {
            $picture = $request->file("picture");
            $pictureName = $picture->getClientOriginalName();
            $picturePath = $picture->store("public/picture");
        }

        Item::create([
            "category_id" => $validatedData["category_id"],
            "title" => $validatedData["title"],
            "description" => $validatedData["description"],
            "price" => $validatedData["price"],
            "quantity" => $validatedData["quantity"],
            "SKU" => $validatedData["SKU"],     
            "picture" => $picturePath
        ]); 


        return redirect("/items")->with("success", "New Item was created");   
    }

    public function edit($id) {
        $item = Item::find($id);
        $categories = Category::all();

        return view("items.edit", [
            "categories"=> $categories,
            "item" => $item
        ]);
    }

    public function update(Request $request, $id){
        $item =  Item::find($id);
        $validatedData = $request->validate([
            "category_id" => "required",
            "title" => "required|max:255",
            "description" => "required|max:255",
            "price" => "required|regex:/^\d+(\.\d{1,2})?$/",
            "quantity" => "required|numeric",
            "SKU" => "required|max:255",
            "picture" => "required|file",
        ]);

        if (Item::where("title", $validatedData["title"])->where("id", "!=", $id)->first()) {
            return redirect("/items/{$id}/edit")->with("error_title", "Item already exists");
        }

        if (Item::where("SKU", $validatedData["SKU"])->where("id", "!=", $id)->first()) {
            return redirect("/items/{$id}/edit")->with("error_SKU", "SKU already exists");
        }

        if ($request->hasFile("picture")) {
            $picture = $request->file("picture");
            $picturePath = $picture->store("public/picture");
        }

        if (Item::where("picture", $picturePath)->where("id", "!=", $id)->first()) {
            return redirect("/items/{$id}/edit")->with("error_image", "picture already exists");
        }


       $item->update([
            "category_id" => $validatedData["category_id"],
            "title" => $validatedData["title"],
            "description" => $validatedData["description"],
            "price" => $validatedData["price"],
            "quantity" => $validatedData["quantity"],
            "SKU" => $validatedData["SKU"],     
            "picture" => $picturePath
        ]);    

        return redirect("/items")->with("success", "Item has been updated");   
    }

    public function destroy($id){
        $item = Item::find($id);
        if (!$item) {
            return redirect("/items")->with('error_id', 'Item not found');
        }

        $item->delete();

        return redirect("/items")->with("success", "Item was deleted");
    }
}
