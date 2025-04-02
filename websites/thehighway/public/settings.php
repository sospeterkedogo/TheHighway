<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {
    $output = '<h1>Settings</h1>';
} else {
    $output = '<p>You are not logged in, click <a href="userlogin.php">here</a> to go to the login page.</p>';
}

$title = 'Settings';

require  '../templates/userlayout.html.php';
?>