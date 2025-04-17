<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {

    $ordersTable = new DataBaseTable($pdo, 'orders', 'id');
    $orders = $ordersTable->findAll('user_id', $_SESSION['uid']);


    $templateVars = ['orders' => $orders];
    $output = loadTemplate('templates/orders.html.php', $templateVars);

    $title = 'Profile';

    require  '../templates/profilelayout.html.php';
}
?>