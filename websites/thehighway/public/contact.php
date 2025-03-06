<?php 
	require '../database.php';
	if (isset($_POST['submit'])) {

        $record = [
            'name' => $_POST['name'],
            'telephone' => $_POST['telephone'],
            'email' => $_POST['email'],
            'message' => $_POST['message']
        ];

		$communicationTable = new DataBaseTable($pdo, 'communication', 'id');
		$communicationTable->save($record);

		$output = 'Message Sent. </br>Thank you for your message, 
		a member of out team will get back to you in a few weeks.';
	}
	else {	
		$output = '
		<h2>Contact Us</h2>

		Welcome to Northampton News. All the local news and events.

		<p>Email enquiries@northamptonnews.com</p>
		<p>Telephone 01604 112 112</p>
		
		<form action="contact.php" method="POST">
			<label>Name:</label>
			<input type="text" name="name" />
			<label>Telephone:</label>
			<input type="text" name="telephone" />
			<label>Email:</label>
			<input type="email" name="email" />
			<label>Message:</label>
			<textarea name="message"></textarea>
			<input type="submit" value="Submit" name="submit" />
		</form> 
		';	
	}

	$title = 'Contact';
	require  '../templates/userlayout.html.php';
 ?>
