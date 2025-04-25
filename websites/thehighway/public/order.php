<?php 
session_start();

require '../database.php';

$cartTable = new DataBaseTable($pdo, 'carts', 'cart_id');
$cart = $cartTable->find('order_id', $_GET['id']); 
$cartID = $cart['cart_id'];

$ordersTable = new DataBaseTable($pdo, 'orders', 'order_id');
$order = $ordersTable->find('order_id', $_GET['id']);

$usersTable = new DataBaseTable($pdo, 'users', 'id');
$user = $usersTable->find('id', $order['user_id']);

$cartItemsTable = new DataBaseTable($pdo, 'cart_items', 'cart_item_id');
$cartItems = $cartItemsTable->findAllFrom('cart_id', $cartID);

$productsTable = new DataBaseTable($pdo, 'products', 'productid');

$products = [];

foreach($cartItems as $cartItem) {
    $product = $productsTable->find('productid', $cartItem['product_id']);

    if ($product) {
        $productsWithQuantities[] = [
            'product' => $product,
            'quantity' => $cartItem['quantity']
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order<?=$_GET['id']?></title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h3>Order <?=$_GET['id']?></h3>
    <p>Status: <?=$order['order_status']?></p>
    <p>Customer: <?= $user['username'] ?></p>
      <table>
        <tr>
          <th>Item(s)</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
        <?php
          foreach ($productsWithQuantities as $item){
            $total = $item["product"]["price"] * $item["quantity"];

            echo '
            <tr>
              <td>'.$item["product"]["name"].'</td>
              <td>£ '.$item["product"]["price"].' </td>
              <td>'.$item["quantity"].'</td>
              <td>£ '.$total.'</td>
            </tr>
            ';
          }
        ?>
      </table>

</body>
</html>