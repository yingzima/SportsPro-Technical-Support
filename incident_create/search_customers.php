<?php

include ('../view/header.php')?>

<main>
		<h1>Get Customer</h1>
			<p class="title">You must enter the customer's email address to select the customer.</p>
			<form action="." method="post" id="display_incident">
			<input type="hidden" name="action" value="display_incident">
				<label for="Email">Email:</label>
				<input type="text" id="Email" name="Email" maxlength="50" size="20" />
				<input type="submit" name="submit" id="submit" value="Get Customer" />
			</form><br>
		<?php if (isset($message)) : ?>
        <p class="error"><?php echo $message; ?></p>
</main>
<?php
endif;
include ('../view/footer.php')?>
</html>
