<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>
    <form method="post" action="{{ route('product.store') }}">
        @csrf
        @method('post')
        
        <div>
            <label for="name">Product Name</label>
            <input id="name" placeholder="Product Name" type="text" name="name" required>
        </div>
        
        <div>
            <label for="category">Category</label>
            <input id="category" placeholder="Category" type="text" name="category" required>
        </div>
        
        <div>
            <label for="price">Price</label>
            <input id="price" placeholder="Price" type="text" name="price" required>
        </div>
        
        <div>
            <label for="Descriptions">Description</label>
            <input id="Descriptions" placeholder="Product Description" type="text" name="Descriptions">
        </div>
        
        <div>
            <input type="submit" value="Save New Product">
        </div>
    </form>
</body>
</html>
