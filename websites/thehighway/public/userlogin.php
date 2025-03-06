<?php 
session_start();
require '../database.php';

$output = '    
            <h3>Log in or Sign Up</h3>
            <form action="userlogin.php" method="POST">
                <label>Username</label>
                <input type="text" name="username" />
                <label>Password</label>
                <input type="text" name="password" />
                <input type="submit" value="Login" name="login" />
            </form>

            </br>

            <form action="userlogin.php" method="POST">
                <label>Username</label>
                <input type="text" name="username" />
                <label>Password</label>
                <input type="text" name="password" />
                <label>Email</label>
                <input type="email" name="email" />
                <input type="submit" value="Sign Up" name="signup" />
            </form>';

if(isset($_POST['login'])) {
 
    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $user = $userTable->find('username', $_POST['username']);

	if (password_verify($_POST['password'], $user['password'])) {
		$_SESSION['loggedIN'] = true;
		$_SESSION['username1'] = $user['username'];
        $_SESSION['email'] = $user['email'];
	}

    header('Location: index.php');
} 
elseif(isset($_POST['signup'])) {
    $record = [
        'username' => $_POST['username'], 
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]; 

    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $userTable->save($record);

    $output = '    
            <h3>Please Log in</h3>
            <form action="userlogin.php" method="POST">
                <label>Username</label>
                <input type="text" name="username" />
                <label>Password</label>
                <input type="text" name="password" />
                <input type="submit" value="Login" name="login" />
            </form>';
}

$title = 'Northampton News Login page';

require '../templates/userlayout.html.php';
?>