<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9f9f9; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .detail-group { margin-bottom: 12px; }
        label { font-weight: bold; display: block; color: #555; }
        p { margin: 5px 0 15px 0; font-size: 16px; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; display: inline-block; }
        .btn-warning { background-color: #ffc107; color: black; font-weight: bold; }
        .btn-danger { background-color: #dc3545; }
        .btn-secondary { background-color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Details</h2>
        
        <div class="detail-group">
            <label>Product Name:</label>
            <p><?php echo htmlspecialchars($product['product_name']); ?></p>
        </div>

        <div class="detail-group">
            <label>Description:</label>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
        </div>

        <div class="detail-group">
            <label>Price:</label>
            <p>$<?php echo number_format($product['price'], 2); ?></p>
        </div>

        <div class="detail-group">
            <label>Quantity:</label>
            <p><?php echo $product['quantity']; ?></p>
        </div>

        <div style="margin-top: 20px;">
            <a href="<?php echo site_url('product/edit/' . $product['id']); ?>" class="btn btn-warning">Edit</a>
            
            <!-- Delete na may JS Confirmation prompt -->
            <a href="<?php echo site_url('product/delete/' . $product['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure, you want to DELETE this product?');">Delete</a>
            
            <a href="<?php echo site_url('product'); ?>" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</body>
</html>