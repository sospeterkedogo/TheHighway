<h3>Order History</h3>

<?php
if (count($orders) >= 1){
    echo "<table>
            
            <tr>
            <th>Order Reference</th>
            <th>Order Status</th>
            <th>Total</th>
            <th>Date</th>
            <th>View Order</th>
            </tr>";
        foreach(array_reverse($orders) as $order) {
            echo "
            <tr>
            <td>".$order['order_id']."</td>
            <td> ".$order['order_status']."</td>
            <td>£".$order['total_amount']."</td>
            <td>".$order['created_at']."</td>
            <td><a href='order.php?id=".$order['order_id']."'>view</a></td>
            </tr>
            "; 
        }
        echo "</table>";
    } else {
        echo "No orders Yet";
    }
?>