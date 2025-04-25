<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
</head>
<body class="register">
<section class="hero">
    <nav>
        <img src="images/logo.png" alt="logo" class="logo">
        <ul id="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#menu">Menu</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <?php if(isset($_SESSION['loggedIN']) && $_SESSION['loggedIN'] === true): ?>
                <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="userregister.php">Register</a></li>
                <li><a href="userlogin.php">Login</a></li>
            <?php endif; ?>
        </ul>
        <a href="profile.php"><i class="fa-regular fa-user" style="color:#fff"></i></a>
        
        <div class="cart" id="cart">
            <i class="fa-solid fa-cart-shopping"></i>
            <span><?php
                if(isset($_SESSION['quantity'])) {
                    echo $_SESSION['quantity'];
                } else {
                    $_SESSION['quantity'] = 0;
                    echo $_SESSION['quantity'];
                }
            ?></span>
        </div>
        
        <i class="fa-solid fa-bars menuicon" id="navbtn"></i>
    </nav>
        <?=$output?>
    </section>
    <footer>
        <div class="main-footer">
            <div>
                <h1>About Us</h1>
                <a href="#">Our vision, purpose and values</a>
                <a href="#">Blog</a>
                <a href="#">Contacts</a>
                <a href="#">Allergens and nutrition</a>
                <a href="#">Working for us</a>
                <a href="#">FAQs</a>
            </div>

            <div>
                <h1>Follow us</h1>
                <ul>
                    <li><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                </ul>
                <img src="images/logo.png" alt="logo" class="logo">
            </div>

            <div>
                <h1>Explore</h1>
                <a href="#menu">Menu</a>
                <a href="#">News</a>
            </div>
        </div>
        <div class="otherlinks">
            <a href="#">Student discount</a> | 
            <a href="#">The Highway's Deals</a> | 
            <a href="#">Terms of use </a> | 
            <a href="#">Terms and Conditions</a> | 
            <a href="#">Privacy policy</a> | 
            <a href="#">Copyright and legal</a> | 
            <a href="#">Marketing Prefrences</a> | 
            <a href="#">Cookie policy</a> </br> 
            &copy; 2025 The Highway UK Limited
        </div>
    </footer>
</body>
</html>