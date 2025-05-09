<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {
    if (isset($_POST['checkout'])) {

    // 1. Get the user from session
    $userTable = new DataBaseTable($pdo, 'users', 'id');
    $user = $userTable->find('username', $_SESSION['username1']);

    $addressTable = new DataBaseTable($pdo, 'addresses', 'id');

    // save the address if its not on db
    if (empty($user['address'])){
        $record = [
            'user_id' => $user['id'],
            'address_line1' => $_POST['street'],
            'address_line2' => $_POST['apt'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'postcode' => $_POST['postcode']
        ];

        $addressTable->save($record);

        $useraddress = $addressTable->find('user_id', $user['id']);
        $useraddressID = $useraddress['id'];

        $record1 = [
            'id' => $user['id'],
            'address' => $useraddressID
        ];
        $userTable->save($record1);
    }

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

    // 4. Get the latest cart_id for this user
    $cart = $cartsTable->findLatestByPk('user_id', $user['id']);
    $currentCartId = $cart['cart_id'];

    // 5. Save all cart items into cart_items table
    $cartItemsTable = new DataBaseTable($pdo, 'cart_items', 'cart_item_id');

    foreach ($_SESSION['cart'] as $item) {
        $record2 = [
            'cart_id' => $currentCartId,
            'quantity' => $item['quantity']
        ];
    
        if (strpos($item['id'], 'custom_') === 0) {
            // It's a custom meal
            $record2['custom_name'] = $item['name'];
            $record2['custom_price'] = $item['price'] / $item['quantity']; // Price per meal
        } else {
            // It's a normal product
            $record2['product_id'] = $item['id'];
        }
        $cartItemsTable->save($record2);
    }

    // 6. Save payment in payment in the payments table
    $paymentsTable = new DataBaseTable($pdo,'payments', 'payment_id');
    $record3 = [
        'order_id' => $latestOrderId,
        'payment_status' => 'Completed',
        'amount' => $_POST['subtotal']
    ];
    $paymentsTable->save($record3);

    // 7. Save the transaction into transactions table
    $transactionsTable = new DataBaseTable($pdo, 'transactions', 'transaction_id');
    $latestPayment = $paymentsTable->findLatestByPk('order_id', $latestOrderId);
    $latestPaymentId = $latestPayment['payment_id'];
    $record4 = [
        'payment_id' => $latestPaymentId,
        'status' => 'Success'
    ];
    $transactionsTable->save($record4);


    unset($_SESSION['cart']);
    $_SESSION['quantity'] = 0;
    $_SESSION['subtotal'] = 0;

    
    $output= loadTemplate('templates/order-confirmation.html.php', []);
    $output .= '<a href="send_receipt_email.php?order_id='.$latestOrderId.'" target="_blank">View Receipt</a>';
    

    } 
    elseif (isset($_POST['back'])) {
        header("Location: index.php#menu");

    } 
    else {

        $tax = round($_SESSION['total'] * (12 / 100), 2);
        $_SESSION['subtotal'] = round($_SESSION['total'] + $tax,2);

        $userTable = new DataBaseTable($pdo, 'users', 'id');
        $user = $userTable->find('username', $_SESSION['username1']);

        $addressTable = new DataBaseTable($pdo, 'addresses', 'id');
        $userAddress = $addressTable->find('user_id', $user['id']);

        $templateVars = [
            'address' => $userAddress,
            'user' => $user,
            'tax' => $tax
        ];

        $output = loadTemplate('templates/confirmorder.html.php', $templateVars);

    }
    
}
else {
    $output = 
        '
        <div class="centered-div">
        Click <a href="userlogin.php" style="color: #000;">Here</a> to To Log in</div>';   
}

$title = 'Checkout';

require  '../templates/checkout.html.php';
?>


