<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {

    $pic = substr($_SESSION['username1'], 0, 1);
    $output = '

    <div class="centered-div" style="flex-direction: column; background: rgba(0,0,0,0.5); padding-top: 3vh;">

        <div class="profilepic">
            <p>'.$pic.'</p>
        </div>
    
        <p>Hello, '.$_SESSION['username1'].'</p>
        <p>Order History: None Yet</p>

        <a href="index.php">Click here to go to home page</a>

    </div>
    ';
}
else {
    $output = 
        '
        <div class="centered-div">
        <form action="index.php" method="POST">
            <label class="formtitle">Please Log in to Continue</label>
            <label>Username</label>                                              
            <input type="text" name="username" /> 
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form></div>';   
}

$title = 'Profile';

require  '../templates/userlayout.html.php';
?>


