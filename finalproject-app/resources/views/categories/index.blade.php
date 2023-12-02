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
	<title>Category</title>
</head>
<header>
    <h1>Category</h1>
</header>
<body>
    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }} </td>

            {{-- When this button is pressed, the page is routed edit page with the current catergory's id.--}}
            <td><a href="{{ route('categories.edit', $category->id) }}">Edit</a></td>
        </tr>
    @endforeach
    <p><a href="{{ route('categories.create') }}">Add a new Catergory</a></p>
</body>
</html>
