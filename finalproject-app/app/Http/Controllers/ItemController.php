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
            "categoryName" => "required",
            "title" => "required|unique:categories|max:255",
            "description" => "required|max:255",
            "price" => "required",
            "quantity" => "required|7",
            "SKU" => "required|unique:categories|max:255",
    
            // This not the actual image but the filepath
            "picture|required"
        ]);

        if ($request->hasFile("picture")) {
            $picture = $request->file("picture");
            $picturePath = $picture->store('images', 'public');
        }

    
        $categoryName = $validatedDate->categoryName;
        $category = Category::find($categoryName);

            Item::create([
            "category_id" => $category["id"],
            "title" => $validatedData["title"],
            "description" => $validatedData["description"],
            "price" => $validatedData["price"],
            "quantity" => $validatedData["quantity"],
            "SKU" => $validatedDateSKU["SKU"],     
            'picture' => $picturePath
            
        ]); 


        return redirect("/items");   
    }

    public function edit($id) {
        $item = Item::find($id);
        $categories = Category::all();

        return view("items.edit", [
            "category"=> $categories,
            "item" => $item
        ]);
    }

    public function update(Request $request, $id){
        $item =  Item::find($id);
        $validatedData = $request->validate([
            "categoryName" => "required",
            "title" => "required|unique:items|max:255",
            "description" => "required|max:255",
            "price" => "required",
            "quantity" => "required|7",
            "SKU" => "required|unique:items|max:255",
    
            // This not the actual image but the filepath
            "picture|required"
        ]);
        if ($request->hasFile("picture")) {
            $picture = $request->file("picture");
            $picturePath = $picture->store('images', 'public');
        }
        $categoryName = $validatedDate->categoryName;
        $category = Category::find($categoryName);

       $item->update([
            "category_id" => $category["id"],
            "title" => $validatedData["title"],
            "description" => $validatedData["description"],
            "price" => $validatedData["price"],
            "quantity" => $validatedData["quantity"],
            "SKU" => $validatedDateSKU["SKU"],     
            'picture' => $picturePath
        ]);    

        return redirect("/items");   
    }

    public function destroy($id){
        $item = Item::find($id);
        if (!$item) {
            return redirect("/items")->with('error', 'Item not found');
        }

        $item->delete();

        return redirect("/items");
    }
}
