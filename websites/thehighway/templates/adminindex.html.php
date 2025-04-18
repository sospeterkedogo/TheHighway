<div class="dashboard">
    <div class="card card-sales">
        <h3>Monthly Sales</h3>
        <p>£<?=$total?></p>
        <p>Incr / Decr</p>
    </div>
    <div class="card card-orders">
    <h3>Total orders</h3>
        <p><?=$allorders?></p>
        <p>Incr / Decr</p>
    </div>
    <div class="card card-visitors">
    <h3>Users</h3>
        <p><?=$allusers?> registered Users</p>
        <p>Incr / Decr</p>
    </div>
    <div class="card card-stats">
        <h3>Sales Statitics</h3>
        <canvas id="myChart" style="width:100%; max-width: 700px;"></canvas>
    </div>
    <div class="card card-traffic">
        <h3>Inventory</h3>
        <canvas id="inventory" style="width: 100%; max-width: 500px;"></canvas>
    </div>
    <div class="card card-tickets">
        <h3>Emails</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Last Update</th>
                <th>Response</th>
            </tr>
            <?php 
                foreach($messages as $message){
                    echo "<tr>
                    <td>".$message['username']."<td>
                    <td>".$message['subject']."<td>
                    <td>".$message['status']."<td>
                    <td>".$message['date']."<td>
                    ";
                    if(isset($message['response'])){
                        echo '<td><i>Replied</i></td>'; 
                    } else {
                        echo '<td><a href="reply.php?id='. $message['id'] .' ">Reply</a></td>';
                    }
                    "
                    <tr>";
                }
            ?>
        </table>
    </div>
</div>

<form action="index.php" method="POST" style="margin: auto; background: none;border: none;box-shadow: none;      max-width:80%">
                    <input type="submit" name="logout" value="Logout" />
</form>
