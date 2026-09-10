<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo empty($product['id']) ? 'Add Product' : 'Edit Product'; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9f9f9; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        textarea { resize: vertical; height: 100px; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; border: none; cursor: pointer; font-size: 14px; }
        .btn-primary { background-color: #28a745; }
        .btn-secondary { background-color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo empty($product['id']) ? 'Add New Product' : 'Edit Product'; ?></h2>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Product Name:</label>
                <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Price:</label>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo empty($product['id']) ? site_url('product') : site_url('product/view/' . $product['id']); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>