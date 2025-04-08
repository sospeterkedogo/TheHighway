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


	$output = loadTemplate('../../templates/adminindex.html.php', []);

}
else {
	$output = '
	<h3 style="text-align:center;margin: auto;">Please Provide Your Credentials To Log In</h3>	
		<form action="index.php" method="POST">
			<label class="formtitle">log in</label>
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
