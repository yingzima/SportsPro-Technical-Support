<?php include ('../view/header.php')?>
<main>
		<h1>Create Incident</h1>
				<p><?php if (isset($message)) : ?>
			<p class="valerror"><?php echo $message; ?></p>
			<a class="title" href="?action=search_customers">Return to Search Customer</a>
			<p><?php elseif (isset($success)) : ?>
			<p class="title"><?php echo $success; ?></p>
			<br>
</main>
<?php

endif;
include ('../view/footer.php')?>
</html>
