<?php 
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {

        $record = [
            'response' => $_POST['response'],
            'status' => 'completed',
            'id' => $_GET['id']
        ];

        $communicationTable = new DataBaseTable($pdo, 'communication', 'id');
        $communicationTable->save($record);

        $output = 'Message Sent';
    }
    else { 

        $communicationTable = new DataBaseTable($pdo, 'communication', 'id');

        $message = $communicationTable->find('id', $_GET['id']);
        $output = '
        <h2>Reply</h2>

        <table>
        <tr>
        <th>Name</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Date</th>
        </tr>

        <tr>
        <td>'.$message['username'].'</td>
        <td>'.$message['subject'].'</td>
        <td>'.$message['message'].'</td>
        <td>'.$message['date'].'</td>
        </tr>

        </table>
        
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