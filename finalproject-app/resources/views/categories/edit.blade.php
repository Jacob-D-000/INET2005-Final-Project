<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project: Project: finalproject-app/categories
	Author: Jacob Dimoff
	Date: 4/12/23
	Filename: edit.blade.php
	Purpose: Act as a form to edit current category rows in a database
	-->
	
<head>
	<title>Update a Category</title>
</head>
<body>
    <header>
        <h1>Update a Category</h1>
    </header>	

    {{-- When the current form is submitted, data will be routed to the update function in the category controller class with the current category id as an argument. --}}
    <form action="{{route('categories.update', $category->id )}}" method="post">
        @csrf
        @method("PATCH")

        {{-- This will display the id of the category --}}
        <label for="name">Category Name(ID: {{ $category->id }}): </label>

        {{-- This will show the category name when the page loads --}}
        <input type="text" name="name" id="name" value="{{ $category->name }}" required>

        {{-- If the error_name redirect occurs, print the appropriate error message. --}}
        @if(session("error_name"))
        <div>
            {{ session("error_name") }}
        </div>

        {{-- If there was any other kind of error with the name field, catch and print the appropriate error message. --}}
        @error("name")
            <p>{{$message}}</p>
        @enderror
        <button type="submit">Update the Category Name</button>
    </form>    
</body>
</html>
