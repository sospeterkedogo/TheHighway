<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {
        $record = ['name' => $_POST['name']];

        $categoryTable = new DataBaseTable($pdo, 'categories', 'id');
        $categoryTable->save($record);

        $output = 'Category added';
    }
    else {
        $output = '
            <form action="addcategory.php" method="POST">
            <label CLASS="formtitle">ADD CATGEGORY</label>
                <label>Category name:</label>
                <input type="text" name="name" />
                <input type="submit" value="Submit" name="submit" />
            </form>
        ';
    }
}
else { 
    $output = '<form action="index.php" method="POST">
        <label>Username</label>                                              
        <input type="text" name="username" /> 
        <label>Password</label>
        <input type="password" name="password" />
        <input type="submit" name="submit" value="submit" />
    </form> ';  
}

$title = 'Add Category';

require  '../../templates/layout.html.php';
?>

