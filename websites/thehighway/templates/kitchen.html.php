<h3 id="kitchen" class="kitchen">Orders</h3>

<?php if (!empty($allorders) && count($allorders) > 0): ?>
<table>
    <tr>
        <th>Order Number</th>
        <th>Date</th>
        <th>Status</th>
        <th>Actions</th>
        <th>View</th>
    </tr>
    <?php
        foreach(array_reverse($allorders) as $order) {
            echo "
            <tr>
                <td>".$order['order_id']."</td>
                <td>".$order['created_at']."</td>
                <td>".$order['order_status']."</td>
                <td><a href='order.php?id=".$order['order_id']."'>view</a></td>
                <td>
                    <form action='kitchen.php' method='POST' style='background: none; box-shadow: none; padding: 0; margin: 0; width: 100%'>
                        <input type='hidden' name='order_id' value=".$order['order_id'].">
                        <button type='submit' name='submit'>Mark as Prepared</button>
                    </form>
                </td>
            </tr>
            "; 
        }
    ?>
</table>
<?php else: ?>
    <p style="text-align:center;">No pending orders at the moment!</p>
<?php endif; ?>

<div id="notification-container" class="notification-container"></div>
<audio id="notification-sound" src="sounds/notification.mp3" preload="auto"></audio>




