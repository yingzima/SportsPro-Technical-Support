<?php include '../view/header.php'; ?>
<main>
	<h1>Create Incident</h1>
			<form action="." method="post" id="aligned">
			<input type="hidden" name="action" value="create_incident">
				<label for="Customer">Customer:</label>
				<label for="CustName"><?php echo $wholeName;?></label><br>
				<label>Product:</label>
				<?php 
				// list products registered by selected customer, stored in the $products multi-dim array, which a calls function from product_db.php
					echo "<select name='prodid'>";
					foreach($products as $row) {
						$code = $row['productCode'];
						$name = $row['name'];
						echo '<option value="'.$code.'">'.$name.'</option>';
				}
					echo "</select>";				
				?> <br>
				<label>Title:</label>
				<input type="text" name="Subject"><br>
				<label>Description:</label>
				<textarea rows="5" cols="50" name="Description" maxlength="500" ></textarea><br>
				<input type="hidden" name="custid" id="custid" value="<?php echo $id;?>" />
				<label>&nbsp;</label>
				<input type="submit" value="Create Incident" />
			</form>
</main>
<?php
include ('../view/footer.php')?>
</html>

