<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {    

    $productTable = new DataBaseTable($pdo, 'products', 'productid');
    $stmt = $productTable->findAll();

    $output = '<h2>Products</h2>';
    $output .= '<table>';
    foreach ($stmt as $product) {
        $output .= '<tr>';
        $output .= '<td>' . $product['name'] . '</td>';
        $output .= '<td><a href="editproduct.php?id=' . $product['productid'] . '">Edit</a></td>';
        $output .= '<td><a href="deleteproduct.php?id=' . $product['productid'] . '">Delete</a></td>';
        $output .= '</td>';
    }
    $output .= '</table>';

}
else {
    $output = '<form action="index.php" method="POST">
        <label>Username</label>                                              
        <input type="text" name="username" /> 
        <label>Password</label>
        <input type="password" name="password" />
        <input type="submit" name="submit" value="submit" />
    </form>';  
}


$title = 'Products';

require  '../../templates/layout.html.php';
?>

