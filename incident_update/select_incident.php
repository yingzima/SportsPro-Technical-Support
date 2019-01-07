<?php include '../view/header.php'; ?>
<main>
    <h3>Select Incident</h3>

    <div id="main">
        <?php if (!empty($incidents)) : ?>
        <!-- display a table of incidents -->
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['firstName'] . " ". $incident['lastName']; ?></td>
                <td><?php echo $incident['productCode']; ?></td>
                <td><?php $date = new DateTime($incident['dateOpened']); 
                          echo $date->format('m/d/Y'); ?></td>
                <td><?php echo $incident['title']; ?></td>
                <td><?php echo $incident['description']; ?></td>
                <!-- select the incident -->
                <td><form action="" method="post">
                    <input type="hidden" name="action"
                           value="show_update_incident">
                    <input type="hidden" name="id"
                           value="<?php echo $incident['incidentID']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <p>This technician has no open incidents at this time.</p>
        <p><a href=".">Refresh List of Incidents</a></p>
        <?php endif; ?>
        <form action="." method ="post" id="logout">
            <input type="hidden" name="action" value="logout" />
            <p>You are logged in as <?php echo $_SESSION['tech_user']['email']; ?></p>
            <input type="submit" value="Logout" />
        </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>