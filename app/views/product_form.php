<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($product['id']) ? 'Edit Product' : 'Add New Product'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        body { background-color: #f8fafc; color: #0f172a; padding: 40px 20px; line-height: 1.5; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0; }
        .header { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0; }
        .header h2 { color: #0f172a; font-size: 20px; font-weight: 700; letter-spacing: -0.02em; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.03em; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #0f172a; background-color: #ffffff; transition: border-color 0.2s; }
        input:focus, textarea:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        textarea { resize: vertical; min-height: 90px; }
        .btn-group { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; }
        .btn { padding: 10px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s ease; }
        .btn-primary { background-color: #2563eb; color: #ffffff; }
        .btn-primary:hover { background-color: #1d4ed8; }
        .btn-secondary { background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-secondary:hover { background-color: #e2e8f0; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2><?php echo !empty($product['id']) ? 'Edit Product' : 'Add New Product'; ?></h2>
    </div>

    <form action="" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name'] ?? ''); ?>" required placeholder="Enter product name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter product description"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price (PHP)</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required placeholder="0.00">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['quantity'] ?? ''); ?>" required placeholder="0">
        </div>

        <div class="btn-group">
            <a href="<?php echo site_url('product'); ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary"><?php echo !empty($product['id']) ? 'Update Product' : 'Save Product'; ?></button>
        </div>
    </form>
</div>

</body>
</html>