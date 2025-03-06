<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {

	$productTable = new DataBaseTable($pdo, 'products', $_GET['id']);
	$productTable->delete('productid', $_GET['id']);

	$output = 'Product deleted';
}
else {
	$output = '<form action="index.php" method="POST">
		<label>Username</label>                                              
		<input type="text" name="username" /> 
		<label>Password</label>
		<input type="password" name="password" />
		<input type="submit" name="submit" value="submit" />
	</form>';  
}

$title = 'Delete Product';

require  '../../templates/layout.html.php';
?>

 
