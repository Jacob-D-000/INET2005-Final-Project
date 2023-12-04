<!DOCTYPE html>
<html lang="en">

	<!-- 
	Project: Project: finalproject-app/items
	Author: Jacob Dimoff
	Date: 4/12/23
	Filename: index.blade.php
	Purpose: Act as a display of the items table of the database.
	-->
	
<head>
	<title>Item</title>
	{{-- Set the style of the table in the file --}}
	<style>
		table, th, td {
  			border: 1px solid;
		}
	</style>
</head>

<body>
	<header>
		<h1>Item</h1>
	</header>
	<table>
		<tr>
			<td>Item</td>
			<td>Category Name</td>
			<td>Description</td>
			<td>Price</td>
			<td>Quantity</td>
			<td>SKU</td>
			<td>Image</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>

		{{-- For each item in the items array create a table row with the data from the database--}}
		@foreach ($items as $item)
		<tr>
			<td>{{ $item->title }}</td>

			{{-- Find the name of a category based on the id stored in the item's row --}}
			<td>{{ $categories->($item->category_id)->name }}</td>
			<td>{{ $item->description }}</td>
			<td>${{ $item->price }}</td>
			<td>{{ $item->quantity }}</td>
			<td>{{ $item->SKU }}</td>

			{{-- To display the image use the asset function load the image. Since the file path stored in the database is the not accessible by this webpage, replace move the public section of the file path replace it with storage/  --}}
			<td><img src="{{ asset(str_replace('public/', 'storage/', $item->picture)) }}" alt="Image of {{ $item->title }}" style="width: 400px">
			</td>
			
			{{-- Link to the edit page with the current item's id --}}
			<td><a href="{{ route('items.edit', $item->id) }}">Edit</a></td>
			<td>
				{{-- When the current form is submitted, data will be routed to the destroy function in the item controller class with the current item id as an argument. --}}
				<form action="{{ route('items.destroy', $item->id) }}" method="post" id="deleteForm{{ $item->id }}">
					@csrf
					@method("DELETE")
					<button class="deleteButton" id="{{ $item->id }}">Delete</button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	<p><a href="{{ route('items.create') }}">Add a new item</a></p>
	{{-- If the a new item has been added, updated, or deleted display the success message. --}}
	@if(session("success"))
    <div>
        {{ session("success") }}
    </div>
	@endif	
	{{-- Script to confirm the deletion of an item locally --}}
	<script>

		// Add an event listener in the current dom using the following function
		document.addEventListener("DOMContentLoaded", function() {
			// Get all the delete button
			var deleteButtonList = document.querySelectorAll(".deleteButton");

			// for each button execute the following function
			deleteButtonList.forEach(function(button) {

				// Add a clock event listen and execute the following function
				button.addEventListener("click", function(){

					// Get the current buttons id
					var item = this.getAttribute("id")

					// Declare a confirmation message.
					var confirmation = confirm('Are you sure you want to delete this item?');
		
					// If the confirmation is true get the form by the id deleteFrom+item
					if (confirmation) {
						var deleteForm = document.getElementById("deleteForm" + item)

						//submit current form, executing the Controller function
						deleteForm.submit()
					}
				})
			})
		})
	</script>
</body>
</html>
