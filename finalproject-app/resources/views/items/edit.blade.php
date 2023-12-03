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

<body>
    <header>
        <h1>Edit and Item</h1>
    </header>
    <form action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data" method="post" > 
        @csrf
        @method("PATCH")
        <label for="category_id">Category: </label>
        <select name="category_id" id="category_id">
                <option value=" "></option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>        
        @error ("category_id")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="title">Item Title: </label>
        <input type="text" name="title" value= "{{ $item->title }}" id="title" required>
        @if(session("error_title"))
        <div>
            {{ session("error_title") }}
        </div>
        @endif	
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
        @if(session("error_SKU"))
        <div>
            {{ session("error_SKU") }}
        </div>
        @endif	
        @error ("SKU")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="picture">Item Image: </label>
        <input type="file" name="picture" id="picture" required>
        @if(session("error_image"))
        <div>
            {{ session("error_image") }}
        </div>
        @endif	
        @error ("picture")
        <p>{{ $message }}</p>
        @enderror
        <br>
        <button type="submit">Edit the Current Item</button>
    </form>
</body>
</html>
