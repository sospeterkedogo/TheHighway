<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {

        $record = [
            'description' => $_POST['description'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'category_id' => $_POST['category_id']
        ];

        $productTable = new DataBaseTable($pdo, 'products', 'productid');
        $productTable->save($record);

        $output = 'Product added';
    }
    else {
        $productTable = new DataBaseTable($pdo, 'products', 'productid');
        $products = $productTable->findAll();

        $categoriesTable = new DataBaseTable($pdo, 'categories', 'category_id');
        $categories = $categoriesTable->findAll();
       
        $output = '
        <h2>Add Product</h2>
        
        <form action="addproduct.php" method="POST">
            <label>Category</label>
       
            <select name="category_id"> 
            ' ;
            foreach($categories as $category){
                $output .= '<option value = "'.$category['category_id'].'" ';

                $output.= '>' .$category['name']. '</option>';
            }
            $output .= '</select>';
            $output .= '


            <label>Product name:</label>
            <input type="text" name="name" />
            <label>Price:</label>
            <input type="text" name="price" />
            <label>Product description:</label>
            <textarea name="description"></textarea>
            <input type="submit" value="Submit" name="submit" />
        </form> 
        ';

    }
}
else {
    $output = 
        '<form action="index.php" method="POST">
            <label>Username</label>                                              
            <input type="text" name="username" /> 
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>';   
}

$title = 'Add Products';

require  '../../templates/layout.html.php';
?>


