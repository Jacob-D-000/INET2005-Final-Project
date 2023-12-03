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
	<title>Edit and Item</title>
</head>
<header>
    <h1>Edit and Item</h1>
</header>
<body>
    <form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data"> 
        @csrf
        <label for="categoryName">Category: </label>
        <select name="categoryName" id="categoryName" >
            @foreach ($categories as $category)
            <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error ("categoryName")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="title">Item Title: </label>
        <input type="text" name="title" value= "{{ $item->title }}" id="title" required>
        @error ("title")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="description">Item Description: </label>
        <input type="text" name="description" value="{{ $item->description }}" id="description" required>
        @error ("description")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="price">Item Price: </label>
        <input type="text" name="price" value="{{ $item->price }}" id="price" required>
        @error ("price")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="quantity">Item Quantity: </label>
        <input type="text" name="quantity" value="{{ $item->quantity }}" id="quantity" required>
        @error ("quantity")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="SKU">Item SKU: </label>
        <input type="text" name="SKU" value="{{ $item->SKU }}" id="SKU" required>
        @error ("SKU")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="picture">Item Image: </label>
        <input type="file" name="picture" id="picture" required>
        @error ("file")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <button type="submit">Edit the Current Item</button>
    </form>
</body>
</html>
