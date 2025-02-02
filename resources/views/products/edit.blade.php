<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="{{route('product.update',['product'=>$Product])}}">
        @csrf
        @method('PUT') <!-- Method spoofing for PUT request -->
        
        <div>
            <label for="name">Product Name</label>
            <input id="name" placeholder="Product Name" type="text" name="name" value="{{ $Product->name }}" >
        </div>
        
        <div>
            <label for="category">Category</label>
            <input id="category" placeholder="Category" type="text" name="category" value="{{ $Product->category }}" >
        </div>
        
        <div>
            <label for="price">Price</label>
            <input id="price" placeholder="Price" type="text" name="price" value="{{ $Product->price }}" >
        </div>
        
        <div>
            <label for="Descriptions">Description</label>
            <input id="Descriptions" placeholder="Product Description" type="text" name="Descriptions" value="{{ $Product->Descriptions }}">
        </div>
        
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>
