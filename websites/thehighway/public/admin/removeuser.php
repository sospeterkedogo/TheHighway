<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {

    $employeeTable = new DataBaseTable($pdo, 'employees', 'id');
    $employees = $employeeTable->findAll();

    $output = '<h3>Users</h3>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Username</th>
            </tr>
    
    ';

    foreach($employees as $employee){
        $output .= '
        
        <tr>
            <td>' . $employee['id']. '</td>
            <td>' . $employee['username'] . '</td>
        </tr>
        ';
    }

    $output .= '</table>';

    if(isset($_POST['submit'])){
        $employeeTable = new DataBaseTable($pdo, 'employees', 'id');
        $employeeTable->delete('id', $_POST['id']);

	    $output .= '</br>User removed';
        header("Location: index.php");
    }
    else {
        $output .= '
            <form action="removeuser.php" method="POST">
                <label>Employee ID</label>
                <input type="text" name="id">
                <input type="submit" name="submit" value="Remove">
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
	</form>';  
}

$title = 'Remove Users';

require  '../../templates/layout.html.php';
?>

 
