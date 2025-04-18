<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="profilenav">
        <a href="index.php"><img src="images/invertedlogo.png" alt="logo" class="logo" style="background-color: #000; "></a>
        <div class="headline">
            <h3 style="margin-bottom: 5px">My Profile Dashboard</h3>
            <p style="margin:0">Welcome to The Highway profile</p>
        </div>
        <p>Hello, <?= $_SESSION['username1'] ?? 'User'?></p>
    </div>
    <div class="panel" style="display: grid; grid-template-columns: 22% 78%; height: 85vh;">
        <div class="sidebar" style="height: 100%; overflow-y: hidden; background-color: #fff; ">
            <div class="profilepanel_nav ">
                <a href="dashboard.php"><i class="fa-solid fa-gauge"></i> My Dashboard</a>
                <a href="index.php"><i class="fa-solid fa-list"></i> Accounts</a>
                <a href="index.php"><i class="fa-solid fa-phone"></i> Mobile</a>
                <a href="orders.php"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
                <a href="index.php"><i class="fa-solid fa-wallet"></i> Payments</a>
                <a href="index.php"><i class="fa-solid fa-tools"></i> Settings</a>
                <a href="index.php#contact"><i class="fa-solid fa-question"></i> Support</a>
                
            </div>
            
        </div>
        <div class="main" style="height: 100%;">
            <?=$output?>
                
            </div>
    </div>
</body>
</html>