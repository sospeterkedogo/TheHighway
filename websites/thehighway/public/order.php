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

$productsWithQuantities = [];

foreach($cartItems as $cartItem) {
    if (!empty($cartItem['product_id'])) {
        // Normal product
        $product = $productsTable->find('productid', $cartItem['product_id']);
        
        if ($product) {
            $productsWithQuantities[] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $cartItem['quantity']
            ];
        }
    } 
    elseif (!empty($cartItem['custom_name'])) {
        // Custom meal
        $productsWithQuantities[] = [
            'name' => $cartItem['custom_name'],
            'price' => $cartItem['custom_price'],
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
    <h3>Order #<?=$_GET['id']?></h3>
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
            $total = $item["price"] * $item["quantity"];
        
            echo '
            <tr>
              <td>'.$item["name"].'</td>
              <td>£ '.number_format($item["price"], 2).' </td>
              <td>'.$item["quantity"].'</td>
              <td>£ '.number_format($total, 2).'</td>
            </tr>
            ';
        }
        ?>
      </table>

      <button onclick="history.back()">⬅️ Go Back</button>

</body>
</html>

<style>
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }

  /* Body styles */
  body {
      font-family: Arial, sans-serif;
      background-color: #f4f7fc;
      color: #333;
      line-height: 1.6;
      padding: 20px;
  }

  /* Title style */
  h3 {
      font-size: 2em;
      color: #333;
      margin-bottom: 20px;
  }

  /* Paragraph style for customer and order status */
  p {
      font-size: 1.2em;
      margin-bottom: 10px;
      color: #555;
  }

  /* Table styling */
  table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  th, td {
      padding: 12px 15px;
      text-align: left;
  }

  th {
      background-color: #4CAF50;
      color: white;
      font-size: 1.1em;
  }

  td {
      background-color: #f9f9f9;
  }

  tr:nth-child(even) td {
      background-color: #f1f1f1;
  }

  tr:hover td {
      background-color: #eaeaea;
  }

  /* Button styles */
  button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 1.1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 20px;
      display: block;
      text-align: center;
  }

  button:hover {
      background-color: #0056b3;
  }

  /* Style for responsive design */
  @media (max-width: 768px) {
      table {
          width: 100%;
          font-size: 0.9em;
      }

      th, td {
          padding: 8px 10px;
      }

      button {
          font-size: 1em;
          padding: 8px 16px;
      }
  }

</style>