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
	<title>Create a Category</title>
</head>
<body>
    @if(session("error"))
    <div>
        {{ session("error") }}
    </div>
	@endif
    <header>
        <h1>Create a Category</h1>
    </header>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <label for="name">Category Name: </label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error("name")
        <p>{{ $message }}</p>
        @enderror
        <button type="submit">Create a new Category</button>
    </form>    
</body>
</html>
