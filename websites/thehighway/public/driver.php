<?php
session_start();
require '../database.php';

if (isset($_POST['login'])) {
	$employeeTable = new DataBaseTable($pdo, 'users', 'id');
	$user = $employeeTable->find('username', $_POST['username3']);

	// verify username and password
	if (password_verify($_POST['password'], $user['password'])) {
		$_SESSION['log'] = true;
		$_SESSION['username3'] = $user['username'];
	}
}

if (isset($_SESSION['log'])) {
    if (isset($_POST['loggingout'])) {
        unset($_SESSION['log']);
        unset($_SESSION['username3']);
        header("Location: driver.php");
    }

    // Load orders marked as 'completed' (ready for delivery)
    $ordersTable = new DataBaseTable($pdo, 'orders', 'order_id');
    $readyOrders = $ordersTable->findAllFrom('order_status', 'ready for pick up');
    $outForDeliveryOrders = $ordersTable->findAllFrom('order_status', 'out for delivery');
    $usersTable = new DataBaseTable($pdo, 'users', 'id');
    $addressTable = new DataBaseTable($pdo, 'addresses', 'id');


    if (isset($_POST['claim']) && isset($_POST['order_id'])) {
        $orderId = $_POST['order_id'];

        $record = [
            'order_id' => $orderId,
            'order_status' => 'out for delivery',
            'driver_id' => 1
        ];

        $ordersTable->save($record);

        header('Location: driver.php');
        exit();
    }

    // 📦 DELIVER order
    if (isset($_POST['delivered']) && isset($_POST['order_id'])) {
        $orderId = $_POST['order_id'];
        $record = [
            'order_id' => $orderId,
            'order_status' => 'completed'
        ];
        $ordersTable->save($record);

        // save to shippings table
        $order = $ordersTable->find('order_id', $_POST['order_id']);
        $user = $usersTable->find('id', $order['user_id']);
        $address = $addressTable->find('user_id', $order['user_id']);
        $shippingsTable = new DataBaseTable($pdo, 'shippings', 'shipping_id');
        $fullAddress = 
        $address['address_line1'] . ' ' .
        $address['address_line2'] . ', ' .
        $address['city'] . ', ' .
        $address['postcode'] . ' ' .
        $address['country'];

        $record = [
            'order_id' => $orderId,
            'address' => $fullAddress,
            'tracking_number' => $orderId
        ];
        $shippingsTable->save($record);
        
        
        header('Location: driver.php');
        exit();

        
    }

    $templateVars = [
        'readyOrders' => $readyOrders,
        'outForDeliveryOrders' => $outForDeliveryOrders,
        'usersTable' => $usersTable,
        'addressTable' => $addressTable
    ];

    $output = loadTemplate('templates/driver.html.php', $templateVars);
}
else {
	$output = '
	<h3 style="text-align:center;margin: auto;">Please Provide Your Credentials To Log In</h3>	
		<form action="driver.php" method="POST">
			<label class="formtitle">log in</label>
			<label>Username</label>                                              
			<input type="text" name="username3" /> 
			<label>Password</label>
			<input type="password" name="password" />
			<input type="submit" name="login" value="submit" />
		</form>
	';
}

$title = 'Driver page';
require '../templates/layout.html.php';
?>
