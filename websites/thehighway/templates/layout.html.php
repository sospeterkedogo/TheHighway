<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../javasript.js"></script>

</head>
<body >
    <section class="hero">
    <div class="panel" style="display: grid; grid-template-columns: 22% 78%;">
    <div class="sidebar" style="height:100vh; background-color: #02142A; color:#fff;">
    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
        <div style="display:flex;align-items:center; height: 18vh; background-color: #214162; padding: 20px;">
            <div style="background-color: orange; width: 13vh; height: 13vh; border-radius: 50%; text-align: center; text-transform: uppercase; font-size: 3em; padding-top: 0.2em;"><?= isset($_SESSION['username']) ? substr($_SESSION['username'], 0, 1) : 'U'; ?></div>

            <div style="padding-left: 0.5em;">
                <h3><?= $_SESSION['username'] ?? 'User'?></h3>
                <p style="margin: 0; color: <?= isset($_SESSION['username']) ? '#1ea87b' : 'red'; ?>">
                    <?= isset($_SESSION['username']) ? 'Online' : 'Offline'; ?>
                </p>
                
            </div>
        </div>
            <?php endif; ?>
        <div class="panel_nav">
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
            <a href="index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="products.php"><i class="fa-solid fa-list"></i> View Products</a>
            <a href="addproduct.php"><i class="fa-solid fa-plus"></i> Add Product</a>
            <a href="categories.php"><i class="fa-solid fa-table-cells"></i> View Categories</a>
            <a href="addcategory.php"><i class="fa-solid fa-plus"></i> Add Category</a>
            <a href="adduser.php"><i class="fa-solid fa-user-plus"></i> Add User</a>
            <a href="removeuser.php"><i class="fa-solid fa-user-minus"></i> Remove User</a>
            <a href="index.php"><i class="fa-solid fa-gear"></i> Settings</a>
            <?php elseif (isset($_SESSION['username3']) || isset($_SESSION['username4'])): ?>
                <a href="orders.php"><i class="fa-solid fa-box"></i> All Orders</a>
            <form action="" method="POST" style="margin: auto; background: none; box-shadow: none; max-width: 100%;">
                <input type="submit" name="loggingout" value="Log Out">
            </form>
            <?php endif; ?>
        </div>
            
            
        </div>

        <div class="main"style="height:100vh; background-color: #fff; color:#000;">
            <nav style="background-color: #02142A; height: 12vh; color: #fff" >
                <a href="/admin/index.php"><i class="fa-solid fa-house" style="color:#fff"></i></a>
                <i class="fa-solid fa-user-tie"  style="color:#fff; font-size: 1em;"> <?php if(isset($_SESSION['username'])) echo $_SESSION['username']?></i>
            </nav>
            <?=$output?>
        </div>

        
    </div>

        
    </section>
</body>
</html>