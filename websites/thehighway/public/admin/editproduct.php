<?php 
session_start();

require '../../database.php';

$output = '<h2>Edit Product</h2>';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {

        $record = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'category_id' => $_POST['categoryId'],
            'productid' => $_POST['id']
        ];

        $productsTable = new DataBaseTable($pdo, 'products', 'productid');
        $productsTable->save($record);

        $output .= 'Product Edited';
    }
    else {
        $productsTable = new DataBaseTable($pdo, 'products', 'productid');
        $product = $productsTable->find('productid', $_GET['id']);

        $categoriesTable = new DataBaseTable($pdo, 'categories', 'category_id');
        $categories = $categoriesTable->findAll();

        $output .= '
                <form action="editproduct.php?id="'.$_GET['id'].'" method="POST">
                    <label>Category</label>
                    <select name="categoryId"> 
                    ' ;
                    foreach($categories as $category){
                        $output .= '<option value = "'.$category['category_id'].'" ';

                        if ($product['category_id'] == $category['category_id']) {
                            $output .= 'selected="selected"';
                        }

                        $output.= '>' .$category['name']. '</option>';
                    }
                    $output .= '</select>';
                    $output .= '
                    <label>Product name:</label>
                    <input type="hidden" name="id" value="' .$product['productid'] .'">
                    <input type="text" name="name" value=" ' . $product['name'] . '" />
                    <label>Product description:</label>
                    <textarea name="description">' . $product['description'] . '</textarea>
                    <input type="submit" value="Submit" name="submit" />
                </form>';
    }
}
else {
    $output = '
            <form action="index.php" method="POST">
                <label>Username</label>                                              
                <input type="text" name="username" /> 
                <label>Password</label>
                <input type="password" name="password" />
                <input type="submit" name="submit" value="submit" />
            </form>';
}
$title = 'Edit Products';

require  '../../templates/layout.html.php';
?>

