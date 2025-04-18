<?php 
session_start();
require '../database.php';

$output = '   
            
        <form action="userlogin.php" method="POST">
            <label class="formtitle">log in</label>
            <label>Username</label>
            <input type="text" name="username" />
            <label>Password</label>
            <input type="password" name="password" />
            <a href="#">forgot password?</a>
            <input type="submit" value="Login" name="login" />
        </form>
            
            ';

if(isset($_POST['login'])) {
 
    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $user = $userTable->find('username', $_POST['username']);

	if (password_verify($_POST['password'], $user['password'])) {
		$_SESSION['loggedIN'] = true;
		$_SESSION['username1'] = $user['username'];
        $_SESSION['uid'] = $user['id'];
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

$title = 'The Highway Login page';

require '../templates/userlayout.html.php';
?>