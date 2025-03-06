<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {

	$categoryTable = new DataBaseTable($pdo, 'categories', $_GET['id']);
	$categoryTable->delete('category_id', $_GET['id']);

	$output = 'Category deleted';
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

$title = 'Delete Category';

require  '../../templates/layout.html.php';
?>

