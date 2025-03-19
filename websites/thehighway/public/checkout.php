<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {
    if (isset($_POST['submit'])) {

        $record = [
            'card' => $_POST['card'],
            'date' => $_POST['date'],
            'cvv' => $_POST['cvv']
        ];

        $output = "
        <h3>✨Order Placed Successfully.✨</h3>
       
        <p>Click <a href='index.php'>here</a> to go back to home page or <a href='logout.php'>here</a> to log out.</p>
     
        ";

    } 
    elseif (isset($_POST['back'])) {
        header("Location: index.php#menu");

    } 
    else {
       
        $output = '
        <div class="centered-div">
        
        <form action="checkout.php" method="POST">
            <label class="formtitle">Checkout</label>

            <label>Card Number</label>
            <input type="text" name="card" />

            <label>Expiration Date</label>
            <input type="date" name="date" />

            <label>CVV</label>
            <input type="number" name="cvv" />
            
            <input type="submit" value="PLACE ORDER AND PAY" name="submit" style="margin-bottom: 3vh"/>
            <input type="submit" value="BACK" name="back" />
        </form> 

        </div>
        ';

    }
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

$title = 'Checkout';

require  '../templates/userlayout.html.php';
?>


