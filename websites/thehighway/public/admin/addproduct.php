<?php 
session_start();
require '../../database.php';

if (isset($_SESSION['loggedin'])) {

    if (isset($_POST['submit'])) {
        // Handle file upload
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../images/"; // Store images in ../images/
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowedTypes = ["jpg", "jpeg", "png", "gif"];

            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $imagePath = "../images/" . $fileName; // Store relative path
                } else {
                    echo "Error uploading the file.";
                    exit();
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.";
                exit();
            }
        }

        // Save product details in the database
        $record = [
            'description' => $_POST['description'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'category_id' => $_POST['category_id'],
            'image' => $imagePath // Store image path in the database
        ];

        $productTable = new DataBaseTable($pdo, 'products', 'productid');
        $productTable->save($record);

        $output = 'Product added';
    } else {
        $productTable = new DataBaseTable($pdo, 'products', 'productid');
        $products = $productTable->findAll();

        $categoriesTable = new DataBaseTable($pdo, 'categories', 'category_id');
        $categories = $categoriesTable->findAll();
       
        $output = '
        <h2>Add Product</h2>
        
        <form action="addproduct.php" method="POST" enctype="multipart/form-data">
            <label>Category</label>
            <select name="category_id">';

            foreach ($categories as $category) {
                $output .= '<option value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
            }

            $output .= '</select>
            <label>Product name:</label>
            <input type="text" name="name" required />
            <label>Price:</label>
            <input type="text" name="price" required />
            <label>Product description:</label>
            <textarea name="description" required></textarea>
            <label>Upload Image:</label>
            <input type="file" name="image" accept="image/*" required />
            <input type="submit" value="Submit" name="submit" />
        </form>';
    }
} else {
    $output = '
        <form action="index.php" method="POST">
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
