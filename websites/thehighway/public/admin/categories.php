<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {  
             
    $categoryTable = new DataBaseTable($pdo, 'categories', 'id');
    $stmt = $categoryTable->findAll();

    $output = '<h2>Categories</h2>';
    
    $output .= '<table>';
    $output .= '<tr><th>Name</th><th>Functions</th></tr>';
    foreach ($stmt as $category) {
        $output.= '<tr>';
        $output.= '<td>' . $category['name'] . '</td>';
        $output .= '<td><a href="editcategory.php?id=' . $category['category_id'] . '">Edit</a></td>';
        $output .= '<td><a href="deletecategory.php?id=' . $category['category_id'] . '">Delete</a></td>';
        $output .= '</td></tr>';
    }
    $output.= '</table>';
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

$title = 'Categories';

require  '../../templates/layout.html.php';

?>
