<?php
session_start();
require '../database.php';

/* 

// Assuming drivers are logged in and stored in session
$driverUsername = $_SESSION['username1'] ?? null;


if (!$driverUsername) {
    echo "Please log in as a driver.";
    exit();
}
    

// Fetch the driver from DB
$driversTable = new DataBaseTable($pdo, 'employees', 'id');
$driver = $driversTable->find('username', $driverUsername);

if (!$driver) {
    echo "Driver not found.";
    exit();
}
*/

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
$title = 'Driver page';
require '../templates/layout.html.php';
?>
