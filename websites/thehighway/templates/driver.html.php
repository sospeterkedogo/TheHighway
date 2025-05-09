<div class="columns">
    <div class="column">
        <h2>Orders Ready for Delivery</h2>
        <?php if (count($readyOrders) > 0): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Location</th>
                    <th>Total</th>
                    <th>Completed At</th>
                    <th>Action</th>
                </tr>
                <?php foreach (array_reverse($readyOrders) as $order): 
                    
                    $user = $usersTable->find('id', $order['user_id']);
                    $address = $addressTable->find('user_id', $order['user_id']);


                    ?>

                    
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?=$user['firstname']?></td>
                        <td><?=$user['lastname']?></td>
                        <td><?=$address['address_line1'], ' ',$address['address_line2'], ', ',$address['city'], ', ',$address['postcode'], ', ',$address['country']?></td>
                        <td>£<?= $order['total_amount'] ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td>
                            <form method="POST" style="background: none; padding: 0; margin: 0; box-shadow: none;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <button type="submit" name="claim">Claim Order</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No orders ready for delivery.</p>
        <?php endif; ?>
    </div>

    <div class="column">
        <h2>Orders Out for Delivery</h2>
        <?php if (count($outForDeliveryOrders) > 0): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Location</th>
                    <th>Total</th>
                    <th>Completed At</th>
                    <th>Action</th>
                </tr>
                <?php foreach (array_reverse($outForDeliveryOrders) as $order): 
                    $user = $usersTable->find('id', $order['user_id']);
                    $address = $addressTable->find('user_id', $order['user_id']);
                    ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?=$user['firstname']?></td>
                        <td><?=$user['lastname']?></td>
                        <td><?=$address['address_line1'], ' ',$address['address_line2'], ', ',$address['city'], ', ',$address['postcode'], ' ',$address['country']?></td>
                        <td>£<?= $order['total_amount'] ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td>
                            <form method="POST" style="background: none; padding: 0; margin: 0; box-shadow: none;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <button type="submit" name="delivered">Mark Delivered</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No orders out for delivery.</p>
        <?php endif; ?>
    </div>
</div>
