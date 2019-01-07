<?php include '../view/header.php'; ?>
<main>

    <h1>Technician List</h1>

    <!-- display a table of technicians -->
    <table>
        <tr>
		    <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($technicians as $technician) : ?>
        <tr>
		    <td><?php echo Technician::get_names($technician); ?></td>
            <td><?php echo htmlspecialchars($technician['email']); ?></td>
            <td><?php echo htmlspecialchars($technician['phone']); ?></td>
            <td><?php echo htmlspecialchars($technician['password']); ?></td>
            <td><form action="." method="post">
                <input type="hidden" name="action"
                       value="delete_technician">
                <input type="hidden" name="technician_id"
                       value="<?php echo htmlspecialchars($technician['techID']); ?>">
                <input type="submit" value="Delete">
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Technician</a></p>

</main>
<?php include '../view/footer.php'; ?>