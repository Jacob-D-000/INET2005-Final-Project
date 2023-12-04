<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project: Project: finalproject-app/items
	Author: Jacob Dimoff
	Date: 4/12/23
	Filename: edit.blade.php
	Purpose: Act as a form to edit current item rows in a database
	-->
	
<head>
	<title>Edit and Item</title>
</head>

<body>
    <header>
        <h1>Edit and Item</h1>
    </header>

    {{-- When the current form is submitted, data will be routed to the update function in the item controller class with the current item id as an argument. --}}
    <form action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data" method="post" > 
        @csrf
        @method("PATCH")

        {{-- category_id Section --}}
        <label for="category_id">Category: </label>
        <select name="category_id" id="category_id">
            
            {{-- Create a blank option for the user --}}
            <option value=" "></option>

            {{-- For each category in the categories arrays, create an option with value of the category id and display value as that category name. --}}
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>        

        {{-- If their is an error in the category_id input, catch it and print out the error message --}}
        @error ("category_id")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{-- title Section --}}
        <label for="title">Item Title: </label>
        <input type="text" name="title" value= "{{ $item->title }}" id="title" required>

        {{-- If the error_title redirect occurs, print the appropriate error message. --}}
        @if(session("error_title"))
        <div>
            {{ session("error_title") }}
        </div>
        @endif	

        {{-- If their is an error in the title input, catch it and print out the error message --}}
        @error ("title")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{-- description Section --}}
        <label for="description">Item Description: </label>
        <input type="text" name="description" value="{{ $item->description }}" id="description" required>
        
        {{-- If their is an error in the description input, catch it and print out the error message --}}
        @error ("description")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{-- price Section --}}
        <label for="price">Item Price: </label>
        <input type="text" name="price" value="{{ $item->price }}" id="price" required>

        {{-- If their is an error in the price input, catch it and print out the error message --}}
        @error ("price")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{-- quantity Section --}}
        <label for="quantity">Item Quantity: </label>
        <input type="text" name="quantity" value="{{ $item->quantity }}" id="quantity" required>

        {{-- If their is an error in the quantity input, catch it and print out the error message --}}
        @error ("quantity")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{-- SKU Section --}}
        <label for="SKU">Item SKU: </label>
        <input type="text" name="SKU" value="{{ $item->SKU }}" id="SKU" required>

        {{-- If the error_SKU redirect occurs, print the appropriate error message. --}}
        @if(session("error_SKU"))
        <div>
            {{ session("error_SKU") }}
        </div>
        @endif	
        
        {{-- If their is an error in the SKU input, catch it and print out the error message --}}
        @error ("SKU")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{-- picture Section --}}
        <label for="picture">Item Image: </label>
        <input type="file" name="picture" id="picture" required>

        {{-- If their is an error in the picture input, catch it and print out the error message --}}
        @error ("picture")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <button type="submit">Edit the Current Item</button>
    </form>
</body>
</html>
