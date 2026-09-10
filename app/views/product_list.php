<tbody>
    <?php if(!empty($products) && is_array($products)): ?>
        <?php foreach($products as $product): ?>
            <?php if(is_array($product)): ?>
            <tr>
                <td><?php echo $product['id'] ?? ''; ?></td>
                <td><?php echo htmlspecialchars($product['product_name'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($product['description'] ?? ''); ?></td>
                <td>$<?php echo number_format($product['price'] ?? 0, 2); ?></td>
                <td><?php echo $product['quantity'] ?? 0; ?></td>
                <td><?php echo $product['created_at'] ?? ''; ?></td>
                <td>
                    <a href="<?php echo site_url('product/edit/' . ($product['id'] ?? '')); ?>" class="btn btn-warning">Edit</a>
                    <a href="<?php echo site_url('product/delete/' . ($product['id'] ?? '')); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No products found.</td>
        </tr>
    <?php endif; ?>
</tbody>