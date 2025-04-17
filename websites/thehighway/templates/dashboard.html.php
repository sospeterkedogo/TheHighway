<div style="background-color:rgba(0, 0, 0, 0.41); border-radius: 20px; height: 80vh; width: 74vw; display: grid;grid-template-columns: 48% 48%; gap: 30px; padding: 30px" >
    <div style="grid-column: 1; grid-row: 1 / span 2; background-color: #fff;border-radius: 20px;">
        <div class="profilepic">
            <p><?=$pic?></p>
        </div>
        <p>Username: <?=$_SESSION['username1']?></p>
        <p>Phone: +44 123 456 7890</p>
        <p>Email: k@gmail.com</p>
        <input type="submit" value="Save">
        <a href="logout.php" style="border: 1px solid #000;">Logout</a>
    </div>
    <div style="grid-column: 2; grid-row: 2 / 1; background-color: #fff; border-radius: 20px;">
        <h3>My Accounts</h3>
        <p>Active Account: 4329 2308 2482 2323</p>
        <input type="submit" value="Close Account">
    </div>
    <div style="grid-column: 2; grid-row: 2 / 2; background-color: #fff; border-radius: 20px;">
        <h3>My Bills</h3>
        <p>phone</p>
        <p>Internet</p>
        <p>Current Acc</p>
    </div>
    
</div>



