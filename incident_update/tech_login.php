<?php include '../view/header.php'; ?>
<main>
    <h3>Technician Login</h3>
    <div id="main">
        <p>You must log in before you can update an incident.</p>
        <form action="." method="post" id="login_form">
            <input type="hidden" name="action" value="login">

            <label>E-Mail:</label>
            <input type="text" name="email"
                   value="<?php echo htmlspecialchars($email); ?>" size="30">
            <br />

            <label>Password:</label>
            <input type="password" name="password"
                   value="<?php echo htmlspecialchars($password); ?>" size="30">
            <br />

            <input type="submit" value="Login">
            <?php if (!empty($error_message)) : ?>         
            <span class="error"><?php echo htmlspecialchars($error_message); ?></span><br>
            <?php endif; ?>
        </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>
