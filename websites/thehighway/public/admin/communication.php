<?php
session_start();

require '../../database.php';

if (isset($_SESSION['loggedin'])) {

    $commTable = new DataBaseTable($pdo, 'communication', 'id');
    $message = $commTable->findAll('table', 'communication');

    $output = '<h2>Communication</h2>';

    $output .= '<table>';
    foreach ($message as $article) {
        $output .= '<tr>';
        $output .= '<td>' . $article['name'] . '</td>';
        $output .= '<td>' . $article['telephone'] . '</td>';
        $output .= '<td>' . $article['email'] . '</td>';
        $output .= '<td>' . $article['message'] . '</td>';
        if(isset($article['response'])){
            $output .= '<td><i>Replied</i></td>'; 
        } else {
            $output .= '<td><a href="reply.php?id='. $article['id'] .' ">Reply</a></td>';
        }
        $output .= '</tr>';
    }
    $output .= '</table>';
} 
else {
	$output = '
	<h3>Provide Your Credentials To Log In</h3>	
	<form action="index.php" method="POST">
		<label>Username</label>                                              
		<input type="text" name="username" /> 
		<label>Password</label>
		<input type="password" name="password" />
		<input type="submit" name="submit" value="submit" />
	</form>
	';
}

$title = 'Communication';

require  '../../templates/layout.html.php';

?>  