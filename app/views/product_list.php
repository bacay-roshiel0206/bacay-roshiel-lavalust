<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f9; color: #333; padding: 30px 15px; }
        .container { max-width: 1100px; margin: 0 auto; background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #eef2f5; }
        .header h2 { color: #2c3e50; font-size: 24px; font-weight: 600; }
        .btn-group { display: flex; gap: 10px; }
        .btn { padding: 9px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s ease; display: inline-block; }
        .btn-add { background-color: #28a745; color: #fff; }
        .btn-add:hover { background-color: #218838; }
        .btn-logout { background-color: #dc3545; color: #fff; }
        .btn-logout:hover { background-color: #c82333; }
        .btn-edit { background-color: #ffc107; color: #212529; }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-delete { background-color: #dc3545; color: #fff; }
        .btn-delete:hover { background-color: #bd2130; }
        .btn-sm { padding: 6px 12px; font-size: 13px; }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 14px 15px; text-align: left; border-bottom: 1px solid #edf2f7; font-size: 14px; }
        th { background-color: #f8fafc; color: #4a5568; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        tr:hover { background-color: #f8fafc; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; }
        .badge-price { background-color: #e3f2fd; color: #0d47a1; }
        .badge-qty { background-color: #e8f5e9; color: #1b5e20; }
        .actions { display: flex; gap: 6px; }
        .empty-state { text-align: center; padding: 40px; color: #718096; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Product List</h2>
        <div class="btn-group">
            <a href="<?php echo site_url('product/create'); ?>" class="btn btn-add">+ Add New Product</a>
            <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-logout">Logout</a>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($products) && is_array($products)): ?>
                    <?php foreach($products as $product): ?>
                        <?php if(is_array($product)): ?>
                        <tr>
                            <td><strong>#<?php echo $product['id'] ?? ''; ?></strong></td>
                            <td><?php echo htmlspecialchars($product['product_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($product['description'] ?? '-'); ?></td>
                            <td><span class="badge badge-price">₱<?php echo number_format($product['price'] ?? 0, 2); ?></span></td>
                            <td><span class="badge badge-qty"><?php echo $product['quantity'] ?? 0; ?> pcs</span></td>
                            <td>
                                <div class="actions">
                                    <a href="<?php echo site_url('product/edit/' . ($product['id'] ?? '')); ?>" class="btn btn-edit btn-sm">Edit</a>
                                    <a href="<?php echo site_url('product/delete/' . ($product['id'] ?? '')); ?>" class="btn btn-delete btn-sm" onclick="return confirm('Sigurado ka bang gusto mong burahin ang produktong ito?');">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            Walang mahanap na produkto. I-click ang "+ Add New Product" para magdagdag.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>