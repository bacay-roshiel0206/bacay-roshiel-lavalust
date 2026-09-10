<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
    <!-- Google Fonts for Design Unity -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        body { 
                background: linear-gradient(135deg, #e2e8f0 0%, #f1f5f9 50%, #dbeafe 100%); 
                min-height: 100vh;
                color: #0f172a; 
                padding: 40px 20px; 
                line-height: 1.5; 
            }
        .container { max-width: 1100px; margin: 0 auto; background: #ffffff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0; }
        .header h2 { color: #0f172a; font-size: 22px; font-weight: 700; letter-spacing: -0.02em; }
        .btn-group { display: flex; gap: 10px; }
        .btn { padding: 9px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; }
        .btn-add { background-color: #2563eb; color: #ffffff; }
        .btn-add:hover { background-color: #1d4ed8; }
        .btn-logout { background-color: #475569; color: #ffffff; }
        .btn-logout:hover { background-color: #334155; }
        .btn-edit { background-color: #d97706; color: #ffffff; }
        .btn-edit:hover { background-color: #b45309; }
        .btn-delete { background-color: #dc2626; color: #ffffff; }
        .btn-delete:hover { background-color: #b91c1c; }
        .btn-sm { padding: 6px 12px; font-size: 13px; font-weight: 500; }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        th { background-color: #f8fafc; color: #475568; font-weight: 600; text-transform: uppercase; font-size: 11px; letter-spacing: 0.05em; }
        tr:hover { background-color: #f8fafc; }
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-price { background-color: #eff6ff; color: #1e40af; border: 1px solid #dbeafe; }
        .badge-qty { background-color: #f0fdf4; color: #166534; border: 1px solid #dcfce7; }
        .actions { display: flex; gap: 8px; }
        .empty-state { text-align: center; padding: 48px 20px; color: #64748b; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Product Inventory</h2>
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
                        <tr>
                            <td><strong>#<?php echo is_array($product) ? ($product['id'] ?? '') : $product; ?></strong></td>
                            <td><?php echo htmlspecialchars($product['product_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($product['description'] ?? '-'); ?></td>
                            <td><span class="badge badge-price">₱<?php echo number_format($product['price'] ?? 0, 2); ?></span></td>
                            <td><span class="badge badge-qty"><?php echo $product['quantity'] ?? 0; ?> pcs</span></td>
                            <td>
                                <div class="actions">
                                    <a href="<?php echo site_url('product/edit/' . ($product['id'] ?? '')); ?>" class="btn btn-edit btn-sm">Edit</a>
                                    <a href="<?php echo site_url('product/delete/' . ($product['id'] ?? '')); ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            No products available. Click <strong>"+ Add New Product"</strong> to add a new item.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>