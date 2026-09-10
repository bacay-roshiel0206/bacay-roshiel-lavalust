<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management - LavaLust</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; }
        .btn-primary { background-color: #007bff; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; }
        .btn-secondary { background-color: #6c757d; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Product Inventory List</h2>
        <div>
            <span>Welcome, <strong><?php echo $_SESSION['username'] ?? 'User'; ?></strong></span> | 
            <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-secondary">Logout</a>
        </div>
    </div>

    <p>
        <a href="<?php echo site_url('product/create'); ?>" class="btn btn-primary">+ Add New Product</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($products)): ?>
                <?php foreach($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['created_at']; ?></td>
                    <td>
                        <a href="<?php echo site_url('product/edit/' . $product['id']); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo site_url('product/delete/' . $product['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>