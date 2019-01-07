<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>

    <!-- display a table of products -->
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($products as $product) :
            $ts = strtotime($product['releaseDate']);
            $release_date_formatted = date('n/j/Y', $ts);
        ?>
        <tr>
            <td><?php echo htmlspecialchars($product['productCode']); ?></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['version']); ?></td>
            <td><?php echo $release_date_formatted; ?></td>
            <td><form action="." method="post">
                <input type="hidden" name="action"
                       value="delete_product">
                <input type="hidden" name="product_code"
                       value="<?php echo htmlspecialchars($product['productCode']); ?>">
                <input type="submit" value="Delete">
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Product</a></p>

</main>
<?php include '../view/footer.php'; ?>