<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {

    $pic = substr($_SESSION['username1'], 0, 1);

    $templateVars = ['pic' => $pic];
    $output = loadTemplate('templates/dashboard.html.php', $templateVars);
}
else {
    $output = 
        '<p>Click <a href="login.php">here</a> to login</p>';   
}

$title = 'Profile';

require  '../templates/profilelayout.html.php';
?>


