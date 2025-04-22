<?php
require '../database.php';

header('Content-Type: application/json');

// return orders that are 'pending'
$ordersTable = new DataBaseTable($pdo, 'orders', 'order_id');
$newOrders = $ordersTable->findAllFrom('order_status', 'pending');

if (!empty($pendingOrders)) {
    echo json_encode($pendingOrders);
}
?>
