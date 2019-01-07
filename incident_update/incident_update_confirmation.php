<?php include '../view/header.php'; ?>
<main>
    <h3>Update Incident</h3>
    <div id="main">
        <p>This incident was updated.</p>
        <p><a href=".">Select Another Incident</a></p>
        <form action="." method ="post" id="logout">
            <input type="hidden" name="action" value="logout" />
            <p>You are logged in as <?php echo $_SESSION['tech_user']['email']; ?></p>
            <input type="submit" value="Logout" />
        </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>