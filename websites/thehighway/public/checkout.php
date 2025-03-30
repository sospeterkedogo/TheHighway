<?php 
session_start();

require '../database.php';

if(isset($_POST['login'])) {
 
    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $user = $userTable->find('username', $_POST['username']);

	if (password_verify($_POST['password'], $user['password'])) {
		$_SESSION['loggedIN'] = true;
		$_SESSION['username1'] = $user['username'];
        $_SESSION['email'] = $user['email'];
	}

    header('Location: checkout.php');
} 

if (isset($_SESSION['loggedIN'])) {
    if (isset($_POST['checkout'])) {

        $record = [
            'card' => $_POST['card'],
            'date' => $_POST['date'],
            'cvv' => $_POST['cvv']
        ];

        $output = "
        <h3>✨Order Placed Successfully.✨</h3>
       
        <p>Click <a href='index.php'>here</a> to go back to home page or <a href='logout.php'>here</a> to log out.</p>
     
        ";

        unset($_SESSION['cart']);
        unset($_SESSION['quantity']);

        $msg = "
            <html>
                <head>
                    <title>Order Confirmation</title>
                </head>
                <body>
                    <p>Thank you for your order, <strong>".$_SESSION['username1']."</strong>!</p>
                    <p>Your Order is on the way.</p>
                    <h3>Order Details</h3>
                    <p><strong>Total:</strong>£".$_SESSION['total']."</p>
                    <p><strong>Items:</strong>£".$_POST['quantity']."</p>
                    <p><strong>Subtotal:</strong>£".$_POST['subtotal']."</p>
                </body>
            </html>
        ";

        $headers = "From: The Highway <thehighway@online.com>\r\n";
        $headers .= "Reply-To: thehighway@online.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers  .= 'MIME-Version: 1.0' . "\r\n";

        // send email
        if(mail("".$_SESSION['email']."", "The Highway: Order Successful!", $msg, $headers)) {
            $output .= "<p>Confirmation Email Sent!</p>";
        } else {
            $output .= "<p>Confirmation Email Send failed!</p>";
        }

    } 
    elseif (isset($_POST['back'])) {
        header("Location: index.php#menu");

    } 
    else {

        $tax = round($_SESSION['total'] * (12 / 100), 2);
        $subtotal = round($_SESSION['total'] + $tax,2);
       
        $output = '
        
        <div class="centered-div">

        <form >
        <label class="formtitle">ORDER SUMMARY</label>
                <label ><b>Order total</b>:    £'. $_SESSION['total'].'</label>
                <label ><b>Items</b>: '.$_SESSION['quantity'].'</label>

            <label><b>Shipping:     Free</b></label>
          

            <label><b>Estimated Tax</b>: £'.$tax.'</label>

            <label ><b>Subtotal</b>: £'.$subtotal.'</label>
    
        </form> 
        
        <form action="checkout.php" method="POST">
            <label class="formtitle">Checkout</label>

            <label>Card Number</label>
            <input type="text" name="card" />

            <label>Expiration Date</label>
            <input type="date" name="date" />

            <label>CVV</label>
            <input type="number" name="cvv" />
            <input type="hidden" name="quantity" value="'.$_SESSION['quantity'].'">
            <input type="hidden" name="subtotal" value="'.$subtotal.'">
            
            <input type="submit" value="PLACE ORDER AND PAY" name="checkout" style="margin-bottom: 3vh"/>
            <input type="submit" value="BACK" name="back" />
            
    </form>
        </form> 

        </div>
        ';

    }
}
else {
    $output = 
        '
        <div class="centered-div">
        <form action="checkout.php" method="POST">
            <label class="formtitle">Please Log in to Continue</label>
            <label>Username</label>                                              
            <input type="text" name="username" /> 
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="login" value="submit" />
            <a href="userregister.php">Or Register Here</a>
        </form></div>';   
}

$title = 'Checkout';

require  '../templates/userlayout.html.php';
?>


