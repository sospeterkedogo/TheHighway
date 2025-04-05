<?php 
session_start();

require '../database.php';

if (isset($_SESSION['loggedIN'])) {

    $pic = substr($_SESSION['username1'], 0, 1);
    $output = '

    <div class="centered-div" style="flex-direction: column; background: rgba(0,0,0,0.5); padding-top: 3vh;">

        <div class="profilepic">
            <p>'.$pic.'</p>
        </div>
    
        <p>Hello, '.$_SESSION['username1'].'</p>
        </div>

        <h3>Order History</h3>
    ';

    $ordersTable = new DataBaseTable($pdo, 'orders', 'id');
    $orders = $ordersTable->findAll('user_id', $_SESSION['uid']);

    if (count($orders) >= 1){
        foreach($orders as $order) {
            $output .= "
                <p> Order Reference: ".$order['order_id']." </p>
                <p> Order Status: ".$order['order_status']." </p>
                <p> Total: £".$order['total_amount']." </p>
                <p> Date: ".$order['created_at']." </p></br>
            "; 
        }
    } else {
        $output .= "No orders Yet";
    }

    
}
else {
    $output = 
        '
        <div class="centered-div">
        <form action="index.php" method="POST">
            <label class="formtitle">Please Log in to Continue</label>
            <label>Username</label>                                              
            <input type="text" name="username" /> 
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="submit" value="submit" />
            <a href="userregister.php">Or Register Here</a>
    </form>
        </form></div>';   
}

$title = 'Profile';

require  '../templates/userlayout.html.php';
?>


