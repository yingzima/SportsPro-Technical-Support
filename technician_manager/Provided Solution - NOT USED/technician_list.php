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
            <td><?php echo htmlspecialchars($technician->getFullName()); ?></td>
            <td><?php echo htmlspecialchars($technician->getEmail()); ?></td>
            <td><?php echo htmlspecialchars($technician->getPhone()); ?></td>
            <td><?php echo htmlspecialchars($technician->getPassword()); ?></td>
            <td><form action="." method="post">
                <input type="hidden" name="action"
                       value="delete_technician">
                <input type="hidden" name="technician_id"
                       value="<?php echo htmlspecialchars($technician->getID()); ?>">
                <input type="submit" value="Delete">
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Technician</a></p>

</main>
<?php include '../view/footer.php'; ?>