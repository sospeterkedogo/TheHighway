<?php 
session_start();

require '../../database.php';  

$output = '<h2>Edit category</h2>';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {
        $category = [
            'category_id' => $_POST['id'],
            'name' => $_POST['name'],
        ];

        $categoryTable = new DataBaseTable($pdo, 'categories', 'category_id');
        $categoryTable->save($category);
        
        $output .= 'Category updated';
    }
    else {
        $categoryTable = new DataBaseTable($pdo, 'categories', 'category_id');
        $category = $categoryTable->find('category_id', $_GET['id']);

        $output .= '<form action="editcategory.php?id='.$_GET['id'].'" method="POST">
            <input type="hidden" name="id" value="' .$category['category_id'] .'">
            <label>Category name:</label>
            <input type="text" name="name" value="'. $category['name'] .'" />
            <input type="submit" value="Submit" name="submit" />
        </form>';
         
    }
}
else { 
    $output .= '<form action="index.php" method="POST">
        <label>Username</label>                                              
        <input type="text" name="username" /> 
        <label>Password</label>
        <input type="password" name="password" />
        <input type="submit" name="submit" value="submit" />
    </form>';     
}

$title = 'Edit Category';

require  '../../templates/layout.html.php';
?>
