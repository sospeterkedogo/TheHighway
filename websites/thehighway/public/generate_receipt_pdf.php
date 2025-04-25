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
    $html = "<h2>Order Receipt - #{$order['order_id']}</h2>";
    $html .= "<p>Date: {$order['created_at']}</p><hr>";

    foreach ($items as $item) {
        $html .= "<p>{$item['name']} x {$item['quantity']} </p>";
    }

    $html .= "<hr><p><strong>Total:</strong> \$" . number_format($order['total_amount'], 2) . "</p>";

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
