<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedin'])) {
    $output = 'Profile Picture </br> Name </br> Order History';
}
else {
    $output = 
        '<form action="index.php" method="POST">
            <label>Username</label>                                              
            <input type="text" name="username" /> 
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>';   
}

$title = 'Profile';

require  '../templates/userlayout.html.php';
?>


