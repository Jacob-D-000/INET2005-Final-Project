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
	<title>Create a Item</title>
</head>

<body>
    <header>
        <h1>Create a Item</h1>
    </header>
    <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data"> 
        @csrf
        <label for="category_id">Category: </label>
        <select name="category_id" id="category_id">
                <option value=" "></option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>        
        @if(session("error_category"))
        <div>
            {{ session("error_category") }}
        </div>
        @endif	
        @error ("category_id")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="title">Item Title: </label>
        <input type="text" name="title" value= "{{ old('title') }}" id="title" required>
        @error ("title")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="description">Item Description: </label>
        <input type="text" name="description" value="{{ old('description') }}" id="description" required>
        @error ("description")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="price">Item Price: </label>
        <input type="text" name="price" value="{{ old('price') }}" id="price" required>
        @error ("price")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="quantity">Item Quantity: </label>
        <input type="text" name="quantity" value="{{ old('quantity') }}" id="quantity" required>
        @error ("quantity")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="SKU">Item SKU: </label>
        <input type="text" name="SKU" value="{{ old('SKU') }}" id="SKU" required>
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
        <button type="submit">Add a new Item</button>
    </form>
</body>
</html>