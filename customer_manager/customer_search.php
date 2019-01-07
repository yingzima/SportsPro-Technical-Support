<?php include '../view/header.php'; ?>
<main>

    <h2>Customer Search</h2>
    
    <!-- display a search form -->
    <form action="." method="post">
        <input type="hidden" name="action" value="display_customers">
        <label>Last Name:</label>
        <input type="text" name="last_name" 
               value="<?php echo htmlspecialchars($last_name); ?>">
        <input type="submit" value="Search">
    </form>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php elseif ($customers) : ?>
        <h2>Results</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo htmlspecialchars(
                        $customer['firstName'] . ' ' . 
                        $customer['lastName']); ?></td>
                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                <td><?php echo htmlspecialchars($customer['city']); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="display_customer" />
                    <input type="hidden" name="customer_id"
                           value="<?php echo htmlspecialchars($customer['customerID']); ?>" />
                    <input type="submit" value="Select" />
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</main>
<?php include '../view/footer.php'; ?>