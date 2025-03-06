<?php 
session_start();

require '../../database.php';

// List of available users and their passwords for tests-> admin: letmein, sos: mypass

if (isset($_POST['submit'])) {

	$employeeTable = new DataBaseTable($pdo, 'employees', 'id');
	$user = $employeeTable->find('username', $_POST['username']);

	// verify username and password
	if (password_verify($_POST['password'], $user['password'])) {
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $user['username'];
	}
}

if (isset($_SESSION['loggedin'])) {
	if (isset($_POST['logout'])) { 
		unset($_SESSION['loggedin']);
		unset($_SESSION['username']);	
		
		header('Location: index.php');
	}

	$output = 'Welcome back. Please choose an option to begin
	
		<form action="index.php" method="POST">
			<input type="submit" name="logout" value="Logout" />
		</form>
	';

	// Admin specific functionality to add and remove users
	if ($_SESSION['username'] === 'admin'){
		$output .= '
			<a href="products.php">View Products</a></br>
			<a href="addproduct.php">Add Product</a></br>
			<a href="categories.php">View Categories</a></br>
			<a href="addcategory.php">Add Category</a></br>
			<a href="adduser.php">Add User</a></br>
			<a href="removeuser.php">Remove User</a></br>
			<a href="#">Communication</a></br>
			<a href="#">Reply</a>
		';
	}
}
else {
	$output = '
	<h3>Please Provide Your Credentials To Log In</h3>	
	<form action="index.php" method="POST">
		<label>Username</label>                                              
		<input type="text" name="username" /> 
		<label>Password</label>
		<input type="password" name="password" />
		<input type="submit" name="submit" value="submit" />
	</form>
	';
}
	
$title = 'Home';

require  '../../templates/layout.html.php';
?>
