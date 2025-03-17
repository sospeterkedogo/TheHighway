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

	$output = '<h3 style="text-align: center">Welcome back. Please choose an option to begin</h3>';

	// Admin specific functionality to add and remove users
	if ($_SESSION['username'] === 'admin'){
		$output .= '
			<div class="centered-div">
				<a href="products.php">View Products</a>
				<a href="addproduct.php">Add Product</a>
				<a href="categories.php">View Categories</a>
				<a href="addcategory.php">Add Category</a>
				<a href="adduser.php">Add User</a>
				<a href="removeuser.php">Remove User</a>
				<a href="#">Communication</a>
				<a href="#">Reply</a>
			</div>
			<form action="index.php" method="POST" style="margin: 0">
			<input type="submit" name="logout" value="Logout" />
		</form>
		';
	}
}
else {
	$output = '
	<h3 style="text-align:center;margin: auto;">Please Provide Your Credentials To Log In</h3>	
	<div class="centered-div">
		<form action="index.php" method="POST">
			<label class="formtitle">log in</label>
			<label>Username</label>                                              
			<input type="text" name="username" /> 
			<label>Password</label>
			<input type="password" name="password" />
			<input type="submit" name="submit" value="submit" />
		</form>
	</div>
	';
}
	
$title = 'Home';

require  '../../templates/layout.html.php';
?>
