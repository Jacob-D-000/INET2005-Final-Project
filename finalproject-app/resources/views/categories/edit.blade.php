<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project:
	Author: Jacob Dimoff
	Date:
	Filename:
	Purpose:
	-->
	
<head>
	<title>Update a Category</title>
</head>
<header>
    <h1>Update a Category</h1>
</header>
<body>
    <form action="{{route('categories.update')}}" method="post">
        @csrf
        @method('PATCH')
        {{-- This will display the id of the category --}}
        <label for="name">Category Name(ID: {{ $category->id }}): </label>

        {{-- This will show the category name when the page loads --}}
        <input type="text" name="name" id="name" value="{{ $category->name }}" required>
        @error("name")
            <p>{{$message}}</p>
        @enderror
        <button type="submit">Update the Category Name</button>
    </form>    
</body>
</html>
