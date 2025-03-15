<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Highway</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
    <script src="javasript.js"></script>
</head>
<body>
    <section class="hero">
        <nav>
            <img src="images/logo.png" alt="logo" class="logo">
            <ul id="nav">
                <li><a href="#">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="userlogin.php">Register</a></li>
                <li><a href="userlogin.php">Login</a></li>
            </ul>
            <i class="fa-solid fa-cart-shopping cart" id="cart"> £0.00</i>
            <i class="fa-solid fa-bars menuicon" onclick="toggleNav()"></i>
        </nav>
        
        <div class="main-header">
            <div class="header">
                <h1>The Highway</h1>
                <p>Take your tastebuds to the next level with delicious meals prepared by world class chefs.</p>
                <button><a href="#menu" class="order">Order now</a></button>
            </div>
        </div>
    </section>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup" id="popup">
            <span class="close" id="closePopup">&times;</span>
            <div class="popup-content">
                <h3>Your Cart</h3>
                <img src="" alt="item image">
                <p>Item Name</p>
                <p>price</p>
                <select name="quantity" id="quantity">
                    <option value="q">1</option>
                </select>
                <p>Subtotal {price}</p>
                <button onclick="location.href='checkout.php'">Continue to Checkout</button>
            </div>
        </div>
    </div>
        

    <div class="menu-nav" id="menu">
        <h2>Menu.</h2>
        <ul id="menuitems">

            <?php 
                if(!isset($pdo)){
                    require '../database.php';
                }
                    $categoryTable = new DataBaseTable($pdo, 'categories', 'category_id');
                    $stmt = $categoryTable->findAll();

                    echo '<li onclick="selectMenuItem(1)" class="selected">
                            <a href="#menu">All</a>
                        </li>';

                    
                    foreach ($stmt as $category) {
                        echo '<li onclick="selectMenuItem(i)">
                                <a href="listproducts.php?id='. $category['category_id'] .'">' . $category['name'] . '</a>
                            </li>';
                    }
            ?>
					
        </ul>
    </div>
    
    <section class="menu">
        <div class="menu-items">
            <?php 
                if(!isset($pdo)){
                    require '../database.php';
                }
                    // list all products
                    $productsTable = new DataBaseTable($pdo, 'products', 'productid');
                    $products = $productsTable->findAll();
                    
                    foreach ($products as $product) {
                        echo '
                            <div class="menu-item">
                                <div class="image">
                                    <img src="images/randombanner.php" alt="menu-item">
                                </div>
                                <i class="fa-solid fa-circle-info iteminfo"></i>
                                <div class="description">
                                    <h3>'. $product['name'] .'</h3>
                                    <p>£'. $product['price'] .'</p>
                                </div>
                                
                                <i class="fa-solid fa-plus addtocart"></i>
                            </div>
                        ';
                    }
            ?>
            
        </div>
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