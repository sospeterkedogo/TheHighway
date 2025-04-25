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
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname']
    ];

    // get the user info and create an account
    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $userTable->save($record);

    $user = $userTable->find('username', $_POST['username']);

    $record1 = [
        'user_id' => $user['id'],
        'username' => $user['username'], 
        'password' => $user['password']
    ];


    $userAccountsTable = new DataBaseTable($pdo, 'useraccounts', 'account_id');
    $userAccountsTable->save($record1);
    

    // Auto Login After Sign-up
    $_SESSION['loggedIN'] = true;
	$_SESSION['username1'] = $_POST['username'];
    $_SESSION['email'] = $user['email'];

    header('Location: index.php');

    
}

$output = '   
    <form action="userregister.php" method="POST">
        <label class="formtitle">Register</label>

        <label>Username</label>
        <input type="text" name="username" required />

        <label>Firstname</label>
        <input type="text" name="firstname" required />

        <label>Lastname</label>
        <input type="text" name="lastname" required />

        <label>Email</label>
        <input type="email" name="email" required />

        <label>Password</label>
        <input type="password" name="password" required />

        <label>Confirm Password</label>
        <input type="password" name="confirm_password"/>
        <div id="password-feedback"></div>

        <input type="submit" value="Sign Up" name="signup" />

        <a href="userlogin.php">Or login here</a>
    </form>

    
';

$title = 'The Highway Sign up page';

require '../templates/userlayout.html.php';
?>