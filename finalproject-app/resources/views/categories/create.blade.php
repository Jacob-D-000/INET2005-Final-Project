<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project: Project: finalproject-app/categories
	Author: Jacob Dimoff
	Date: 4/12/23
	Filename: create.blade.php
	Purpose: Act as a form for the creation of new category rows in our database
	-->
	
<head>
	<title>Create a Category</title>
</head>
<body>
    <header>
        <h1>Create a Category</h1>
    </header>
    
    {{-- When the current form is submitted, data will be routed to the store function in the category controller class --}}
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <label for="name">Category Name: </label>

        {{-- Input field allows for the the previous data name to be used. --}}
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        {{-- If their is an error in the name input, catch it and print out the error message --}}
        @error("name")
        <p>{{ $message }}</p>
        @enderror
        <button type="submit">Create a new Category</button>
    </form>    
</body>
</html>
