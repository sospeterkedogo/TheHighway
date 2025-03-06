<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {

        $record = [
            'response' => $_POST['response'],
            'id' => $_GET['id']
        ];

        $communicationTable = new DataBaseTable($pdo, 'communication', 'id');
        $communicationTable->save($record);

        $output = 'Message Sent';
    }
    else { 
        $output = '
        <h2>Reply</h2>
        
        <form action="reply.php?id='. $_GET['id'] .' " method="POST">
            <label>Message:</label>
            <textarea name="response"></textarea>
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
    </form>';  
}

$title = 'Reply';

require  '../../templates/layout.html.php';
?>