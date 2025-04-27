<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

require '../database.php';
$order_id = $_GET['order_id'];



$ordersTable = new DataBaseTable($pdo, 'orders', 'id');
$order = $ordersTable->find('order_id', $_GET['order_id']);

$cartTable = new DataBaseTable($pdo, 'carts', 'cart_id');
$cart = $cartTable->find('order_id', $_GET['order_id']); 
$cartID = $cart['cart_id'];

$ordersTable = new DataBaseTable($pdo, 'orders', 'order_id');
$order = $ordersTable->find('order_id', $_GET['order_id']);

$usersTable = new DataBaseTable($pdo, 'users', 'id');
$user = $usersTable->find('id', $order['user_id']);

$cartItemsTable = new DataBaseTable($pdo, 'cart_items', 'cart_item_id');
$cartItems = $cartItemsTable->findAllFrom('cart_id', $cartID);

$productsTable = new DataBaseTable($pdo, 'products', 'productid');

foreach($cartItems as $cartItem) {
    $product = $productsTable->find('productid', $cartItem['product_id']);

    if ($product) {
        $items[] = [
            'name' => $product['name'],
            'quantity' => $cartItem['quantity']
        ];
    }
}

// Generate the PDF
function generateReceiptPDF($order, $items) {
    $html = '
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 14px;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            color: #4CAF50;
        }
        .order-info {
            margin-bottom: 20px;
        }
        .order-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }
    </style>

    <div class="header">
        <h2>Order Receipt</h2>
        <p>Order #'.$order['order_id'].'</p>
    </div>

    <div class="order-info">
        <p><strong>Date:</strong> '.$order['created_at'].'</p>
    </div>

    <table>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
        </tr>';
    
    foreach ($items as $item) {
        $html .= '<tr>
                    <td>'.htmlspecialchars($item['name']).'</td>
                    <td>'.$item['quantity'].'</td>
                  </tr>';
    }

    $html .= '</table>
              <p class="total">Total: $'.number_format($order['total_amount'], 2).'</p>';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $dompdf->output();
}


$pdf = generateReceiptPDF($order, $items);

// Output the PDF directly to the browser
header('Content-Type: application/pdf');
header("Content-Disposition: inline; filename=receipt_{$_GET['order_id']}.pdf");
echo $pdf;
exit;
