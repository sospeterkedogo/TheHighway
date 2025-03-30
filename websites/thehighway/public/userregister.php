<?php 
session_start();
require '../database.php';

if(isset($_POST['signup'])) {

    if($_POST['password'] != $_POST['confirm_password']){
        die("Passwords do not match!");
    }

    $record = [
        'username' => $_POST['username'], 
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]; 

    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $userTable->save($record);

    // Auto Login After Sign-up
    $_SESSION['loggedIN'] = true;
	$_SESSION['username1'] = $_POST['username'];
    $_SESSION['email'] = $user['email'];

    header('Location: index.php');

    
}

$output = '   
    <div class="centered-div">

    <form action="userregister.php" method="POST">
        <label class="formtitle">Register</label>

        <label>Username</label>
        <input type="text" name="username" />

        <label>Email</label>
        <input type="email" name="email" />

        <label>Password</label>
        <input type="password" name="password" />

        <label>Confirm Password</label>
        <input type="password" name="confirm_password"/>

        <input type="submit" value="Sign Up" name="signup" />

        <a href="userlogin.php">Or login here</a>
    </form>

    </div>
';

$title = 'The Highway Sign up page';

require '../templates/userlayout.html.php';
?>