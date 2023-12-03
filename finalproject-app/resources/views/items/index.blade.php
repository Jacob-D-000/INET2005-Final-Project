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
	<title>Item</title>
</head>

<body>
		<header>
		<h1>Item</h1>
	</header>
	<table>
		<tr>
			<td>Item</td>
			<td>Catergory Name</td>
			<td>Description</td>
			<td>Price</td>
			<td>Quanitiy</td>
			<td>SKU</td>
			<td>Image</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
		@foreach ($items as $item)
		<tr>
			<td>{{ $item->title }}</td>
			<td>{{ $categories->firstWhere('id', $item->category_id )->name }}</td>
			<td>{{ $item->description }}</td>
			<td>${{ $item->price }}</td>
			<td>{{ $item->quantity }}</td>
			<td>{{ $item->SKU }}</td>
			<td><img src="{{ $item->picture }}" alt="Image of  {{ $item->title }}" style="width: 400px"></td>
			<td><a href="{{ route('items.edit', $item->id) }}">Edit</a></td>
			<td>
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
	@if(session("success"))
    <div>
        {{ session("success") }}
    </div>
	@endif	
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var deleteButtonList = document.querySelectorAll(".deleteButton");
			deleteButtonList.forEach(function(button) {
				button.addEventListener("click", function(){
					var item = this.getAttribute("id")
					var confirmation = confirm('Are you sure you want to delete this item?');
		
					if (confirmation) {
						var deleteForm = document.getElementById("deleteForm" + item)
						deleteForm.submit()
					}
				})
			})
		})
	</script>
</body>
</html>
