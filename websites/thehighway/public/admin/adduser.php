<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {
    if(isset($_POST['submit'])){
        
        $record = [
            'username' => $_POST['username'], 
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]; 

        $employeeTable = new DataBaseTable($pdo, 'employees', 'id');
        $employeeTable->save($record);
    }

    $output = '  
            <div class="centered-div">
            
                <form action="adduser.php" method="POST">
                    <label class="formtitle">ADD USER</label> 
                    <label>Username</label>                                              
                    <input type="text" name="username" /> 
                    <label>Password</label>
                    <input type="password" name="password" />
                    <input type="submit" name="submit" value="Add" />  
                </form> 
            </div>
        '; 
}

$title = 'Add User';

require  '../../templates/layout.html.php';
?>