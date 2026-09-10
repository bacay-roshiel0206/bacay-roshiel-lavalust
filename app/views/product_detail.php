<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0; }
        .header h2 { color: #0f172a; font-size: 20px; font-weight: 700; }
        .detail-row { margin-bottom: 16px; }
        .label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px; }
        .value { font-size: 15px; color: #0f172a; font-weight: 500; background-color: #f8fafc; padding: 10px 14px; border-radius: 6px; border: 1px solid #f1f5f9; }
        .btn-group { display: flex; justify-content: space-between; align-items: center; margin-top: 28px; pt: 16px; border-top: 1px solid #e2e8f0; }
        .btn-left, .btn-right { display: flex; gap: 8px; }
        .btn { padding: 9px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; }
        .btn-secondary { background-color: #475569; color: #ffffff; }
        .btn-secondary:hover { background-color: #334155; }
        .btn-warning { background-color: #d97706; color: #ffffff; }
        .btn-warning:hover { background-color: #b45309; }
        .btn-danger { background-color: #dc2626; color: #ffffff; }
        .btn-danger:hover { background-color: #b91c1c; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Product Details</h2>
        <span style="font-size: 13px; color: #64748b; font-weight: 600;">ID #<?php echo $product['id'] ?? ''; ?></span>
    </div>

    <div class="detail-row">
        <div class="label">Product Name</div>
        <div class="value"><?php echo htmlspecialchars($product['product_name'] ?? ''); ?></div>
    </div>

    <div class="detail-row">
        <div class="label">Description</div>
        <div class="value"><?php echo htmlspecialchars($product['description'] ?? 'No description provided'); ?></div>
    </div>

    <div class="detail-row">
        <div class="label">Price</div>
        <div class="value">₱<?php echo number_format($product['price'] ?? 0, 2); ?></div>
    </div>

    <div class="detail-row">
        <div class="label">Quantity Available</div>
        <div class="value"><?php echo $product['quantity'] ?? 0; ?> pcs</div>
    </div>

    <div class="btn-group">
        <div class="btn-left">
            <a href="<?php echo site_url('product'); ?>" class="btn btn-secondary">← Back to Product List</a>
        </div>
        <div class="btn-right">
            <a href="<?php echo site_url('product/edit/' . ($product['id'] ?? '')); ?>" class="btn btn-warning">Edit Again</a>
            <a href="<?php echo site_url('product/delete/' . ($product['id'] ?? '')); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
        </div>
    </div>
</div>

</body>
</html>