<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {

        $record = [
            'firstname' => $_POST['firstname'],
            'contact' => $_POST['contact'],
            'email' => $_POST['email'],
            'card' => $_POST['card'],
            'date' => $_POST['date'],
            'cvv' => $_POST['cvv']
        ];

    }
    else {
       
        $output = '
        <h2>Checkout</h2>
        
        <form action="checkout.php" method="POST">
            <label>Firstname</label>
            <input type="text" name="name" />

            <label>Contact</label>
            <input type="text" name="contact" />

            <label>Email</label>
            <input type="email" name="email" />

            <label>Card Number</label>
            <input type="text" name="card" />

            <label>Expiration Date</label>
            <input type="date" name="date" />

            <label>CVV</label>
            <input type="number" name="cvv" />
            
            <input type="submit" value="PLACE ORDER AND PAY" name="submit" />
            <input type="submit" value="BACK" name="back" />
        </form> 
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


