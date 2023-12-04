<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project: Project: finalproject-app/items
	Author: Jacob Dimoff
	Date: 4/12/23
	Filename: create.blade.php
	Purpose: Act as a form for the creation of new items rows in our database
	-->
	
<head>
	<title>Create a Item</title>
</head>

<body>
    <header>
        <h1>Create a Item</h1>
    </header>

    {{-- When the current form is submitted, data will be routed to the store function in the items controller class. Note the enctype allowing for image data transfer --}}
    <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data"> 
        @csrf

        {{-- category_id Section --}}
        <label for="category_id">Category: </label>
        <select name="category_id" id="category_id">

            {{-- Create a blank option for the user --}}
            <option value=""></option>
        
            {{-- For each category in the categories arrays, create an option with value of the category id and display value as that category name. --}}
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>     
        
        {{-- If the error_category redirect occurs, print the appropriate error message. --}}
        @if(session("error_category"))
        <div>
            {{ session("error_category") }}
        </div>
        @endif	

        {{-- If their is an error in the category_id input, catch it and print out the error message --}}
        @error ("category_id")
        <p>{{ $message }}</p>
        @enderror
        <br>
        {{--  Section --}}
        <label for="title">Item Title: </label>
        <input type="text" name="title" value= "{{ old('title') }}" id="title" required>

        {{-- If their is an error in the title input, catch it and print out the error message --}}
        @error ("title")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{--  Section --}}
        <label for="description">Item Description: </label>
        <input type="text" name="description" value="{{ old('description') }}" id="description" required>
        
        {{-- If their is an error in the description input, catch it and print out the error message --}}
        @error ("description")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="price">Item Price: </label>
        <input type="text" name="price" value="{{ old('price') }}" id="price" required>

        {{-- If their is an error in the price input, catch it and print out the error message --}}
        @error ("price")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{--  Section --}}
        <label for="quantity">Item Quantity: </label>
        <input type="text" name="quantity" value="{{ old('quantity') }}" id="quantity" required>

        {{-- If their is an error in the quantity input, catch it and print out the error message --}}
        @error ("quantity")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{--  Section --}}
        <label for="SKU">Item SKU: </label>
        <input type="text" name="SKU" value="{{ old('SKU') }}" id="SKU" required>

        {{-- If their is an error in the SKU input, catch it and print out the error message --}}
        @error ("SKU")
        <p>{{ $message }}</p>
        @enderror
        <br>

        {{--  Section --}}
        <label for="picture">Item Image: </label>
        <input type="file" name="picture" id="picture" required>

        {{-- If their is an error in the picture input, catch it and print out the error message --}}
        @error ("picture")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <button type="submit">Add a new Item</button>
    </form>
</body>
</html>