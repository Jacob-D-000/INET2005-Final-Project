<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project: Project: finalproject-app/categories
	Author: Jacob Dimoff
	Date: 4/12/23
	Filename: index.blade.php
	Purpose: Act as a display of the category table of the database.
	-->
	
<head>
	<title>Category</title>
</head>

<body>
    <header>
        <h1>Category</h1>
    </header>
    <table>
        <tr>
			<td>Category Name</td>
		</tr>
        {{-- For each category array in categories array --}}
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }} </td>

            {{-- When this button is pressed, the page is routed edit page with the current category's id --}}
            <td><a href="{{ route('categories.edit', $category->id) }}">Edit</a></td>
        </tr>
        @endforeach
    </table>

    {{-- Link to a page to add a new category. --}}
    <p><a href="{{ route('categories.create') }}">Add a new Category</a></p>

    {{-- If the a new category has been added, display the success message. --}}
    @if(session("success"))
    <div>
        {{ session("success") }}
    </div>
	@endif	
</body>
</html>
