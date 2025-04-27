<?php 
session_start();
if (!isset($pdo)) {
    require '../database.php';
}
$articlesTable = new DataBaseTable($pdo, 'articles', 'id');
$articles = $articlesTable->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - The Highway</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
    <script src="javasript.js"></script>
    <script src="//code.tidio.co/xu1xmcvxdsdkp2far3ibkvn3vl7uewut.js" async></script>
</head>
<body>
    <section class="hero" id="hero">
        <nav>
            <img src="images/logo.png" alt="logo" class="logo">
            <ul id="nav">
                <li><a href="index.php#menu">Menu</a></li>
                <li><a href="index.php#about">About Us</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>
            <?php if(isset($_SESSION['loggedIN']) && $_SESSION['loggedIN'] === true): ?>
            <a href="profile.php"><i class="fa-regular fa-user" style="color:#fff;"> Hello, <?= $_SESSION['username1']?></i></a>
            <?php else: ?>
            <div class="signon">
                <a href="userregister.php">Register</a> 
                <a href="userlogin.php">Login</a>
            </div>
            <?php endif; ?>
            <div class="cart" id="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <span><?= $_SESSION['quantity'] ?? 0; ?></span>
            </div>
            <i class="fa-solid fa-bars menuicon" id="navbtn"></i>
        </nav>
        
        <div class="main-header">
            <div class="header">
                <h1>Blog</h1>
                <p class="headerdescription">Read our latest news and updates.</p>
            </div>
        </div>
    </section>

    <section class="blog-articles" style="padding:2rem;">
        <h2 style="text-align:center; margin-bottom:2rem;">Blog Articles</h2>
        <div class="articles" style="max-width:800px; margin:0 auto;">
            <?php foreach ($articles as $article): ?>
                <div class="article" style="margin-bottom:2rem;">
                    <h3><?= htmlspecialchars($article['title']); ?></h3>
                    <p><small><?= date('F j, Y', strtotime($article['created_at'])); ?></small></p>
                    <p><?= nl2br(htmlspecialchars($article['content'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <div class="main-footer">
            <div>
                <h1>About Us</h1>
                <a href="#">Our vision, purpose and values</a>
                <a href="blog.php">Blog</a>
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
            <a href="#">Terms of use</a> | 
            <a href="#">Terms and Conditions</a> | 
            <a href="#">Privacy policy</a> | 
            <a href="#">Copyright and legal</a> | 
            <a href="#">Marketing Preferences</a> | 
            <a href="#">Cookie policy</a><br>
            &copy; 2025 The Highway UK Limited
        </div>
    </footer>
</body>
</html>