<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'generate_receipt_pdf.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../database.php';

$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    die("Order ID missing.");
}

// Get order details
$ordersTable = new DataBaseTable($pdo, 'orders', 'order_id');
$order = $ordersTable->find('order_id', $order_id);

$cartTable = new DataBaseTable($pdo, 'carts', 'cart_id');
$cart = $cartTable->find('order_id', $order_id);
$cartID = $cart['cart_id'] ?? null;

$usersTable = new DataBaseTable($pdo, 'users', 'id');
$user = $usersTable->find('id', $order['user_id']);

$cartItemsTable = new DataBaseTable($pdo, 'cart_items', 'cart_item_id');
$cartItems = $cartItemsTable->findAllFrom('cart_id', $cartID);

$productsTable = new DataBaseTable($pdo, 'products', 'productid');
$productsWithQuantities = [];

foreach ($cartItems as $cartItem) {
    $product = $productsTable->find('productid', $cartItem['product_id']);
    if ($product) {
        $productsWithQuantities[] = [
            'product' => $product,
            'quantity' => $cartItem['quantity']
        ];
    }
}

// Generate PDF (binary)
$pdf = generateReceiptPDF($order, $productsWithQuantities);

// Email setup
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'maildev'; // or smtp.gmail.com
    $mail->Port = 1025;
    $mail->setFrom('noreply@restaurant.com', 'Restaurant');
    $mail->addAddress($user['email']);
    $mail->Subject = 'Your Receipt for Order #' . $order_id;
    $mail->Body = 'Please find your receipt attached.';
    $mail->addStringAttachment($pdf, "receipt-{$order_id}.pdf");

    $mail->send();

    $output = loadTemplate('templates/order-confirmation.html.php', []);
    $output .= "<p>✅ Confirmation Email Sent</p>";
    $output .= '<p><a href="generate-receipt.php?order_id=' . $order_id . '" target="_blank">🧾 View Receipt</a></p>';
} catch (Exception $e) {
    $output = "Mailer Error: {$mail->ErrorInfo}";
}

require '../templates/checkout.html.php';

