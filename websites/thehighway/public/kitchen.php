<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {
	if (isset($_POST['logout'])) { 	
		header('Location: logout.php');
	}

	$orders = new DataBaseTable($pdo, 'orders', 'order_id');

    ## change order status to ready for delivery 
    if (isset($_POST['submit'])){

        $record = [
            'order_id' => $_POST['order_id'],
            'order_status' => 'ready for pick up'
        ];

        $orders->save($record);
    }

	$allorders = $orders->findAllFrom('order_status', 'pending');

    

    if (count($allorders) > 0){
        $totalAmount = 0;
        foreach($allorders as $order){
            $totalAmount += $order['total_amount'];
        }
    
        $templateVars = [
                        'allorders' => $allorders,
                        'total' => $totalAmount
                        ];
        
        $output = loadTemplate('templates/kitchen.html.php', $templateVars);
    } else {
        // No orders: show a fallback message
        $output = '<h3 style="text-align:center; margin-top: 2em;" id="kitchen" class="kitchen">No pending orders at the moment.</h3>';
    }

}
else {
	$output = '
	<h3 style="text-align:center;margin: auto;">Please Provide Your Credentials To Log In</h3>	
		<form action="index.php" method="POST">
			<label class="formtitle">log in</label>
			<label>Username</label>                                              
			<input type="text" name="username" /> 
			<label>Password</label>
			<input type="password" name="password" />
			<input type="submit" name="submit" value="submit" />
		</form>
	';
}
	
$title = 'The Highway Kitchen';

require  '../templates/layout.html.php';
?>
