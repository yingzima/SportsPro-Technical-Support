<?php include '../view/header.php'; ?>
<main>
    <h1>Add Product</h1>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="add_product">

        <label>Code:</label>
        <input type="text" name="code"><br>

        <label>Name:</label>
        <input type="text" name="name"><br>

        <label>Version:</label>
        <input type="text" name="version"><br>

        <label>Release Date:</label>
        <input type="text" name="release_date">
        <label class="message">Use any valid date format</label><br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Product"><br>
    </form>
    <p><a href="?action=list_products">View Product List</a></p>

</main>
<?php include '../view/footer.php'; ?>