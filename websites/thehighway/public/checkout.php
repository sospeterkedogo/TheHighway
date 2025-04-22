<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {
    if (isset($_POST['checkout'])) {

    // 1. Get the user from session
    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $user = $userTable->find('username', $_SESSION['username1']);

    // 2. Save the order
    $record = [
        'user_id' => $user['id'],
        'total_amount' => $_SESSION['subtotal']
    ];
    $ordersTable = new DataBaseTable($pdo, 'orders', 'id');
    $ordersTable->save($record);

    $latestOrder = $ordersTable->findLatest('user_id', $user['id']); 

    $latestOrderId = $latestOrder['order_id'];

   

    // 3. Save the cart
    $record1 = [
        'user_id' => $user['id'],
        'order_id' => $latestOrderId
    ];
    $cartsTable = new DataBaseTable($pdo, 'carts', 'cart_id');
    $cartsTable->save($record1);

    $order_id = $cartsTable->find('user_id', $latestOrderId);

    // 4. Get the latest cart_id for this user (assuming it's the one just inserted)
    $cart = $cartsTable->findLatestByPk('user_id', $user['id']);
    $currentCartId = $cart['cart_id'];

    // 5. Save all cart items into cart_items table
    $cartItemsTable = new DataBaseTable($pdo, 'cart_items', 'cart_item_id');

    foreach ($_SESSION['cart'] as $item) {
        $record2 = [
            'cart_id' => $currentCartId,
            'product_id' => $item['id'],
            'quantity' => $item['quantity']
        ];
        $cartItemsTable->save($record2);
    }

    unset($_SESSION['cart']);
    $_SESSION['quantity'] = 0;
    $_SESSION['subtotal'] = 0;

    $output= loadTemplate('templates/order-confirmation.html.php', []);

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
        $_SESSION['subtotal'] = round($_SESSION['total'] + $tax,2);
       
        $templateVars = ['tax' => $tax];
        $output = loadTemplate('templates/confirmorder.html.php', $templateVars);

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

require  '../templates/checkout.html.php';
?>


