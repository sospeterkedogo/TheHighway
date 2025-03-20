<?php 
session_start();

if (isset($_POST['addtocart'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
        $_SESSION['quantity'] += 1;

    } else {
        $session_array = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'quantity' => 1
        );

        $_SESSION['cart'][$id] = $session_array;
        $_SESSION['quantity'] += 1;
    }
}
//unset($_SESSION['cart']);
//unset($_SESSION['quantity']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Highway</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
    <script src="javasript.js"></script>
</head>
<body>
    <section class="hero">
        <nav>
            <img src="images/logo.png" alt="logo" class="logo">
            <ul id="nav">
                <li><a href="./index.php">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <?php if(isset($_SESSION['loggedIN']) && $_SESSION['loggedIN'] === true): ?>
                <li><a href="logout.php">Log Out</a></li>
                <?php else: ?>
                <li><a href="userregister.php">Register</a></li>
                <li><a href="userlogin.php">Login</a></li>
                <?php endif; ?>
            </ul>
            <a href="profile.php"><i class="fa-regular fa-user" style="color:#fff"></i></a>
            
            <div class="cart" id="cart">
                <i class="fa-solid fa-cart-shopping" ></i>
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
        
        <div class="main-header">
            <div class="header">
                <h1>The Highway</h1>
                <p class="headerdescription">Take your tastebuds to the next level with our delicious meals prepared by world-class chefs.</p>
                <button><a href="#menu" class="order">Order now</a></button>
            </div>
        </div>
    </section>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup" id="popup">
            <span class="close" id="closePopup">&times;</span>
            <div class="popup-content">
                <h3>Your Cart</h3>
                <div class="listCart">

                    <?php 
                        if (!empty($_SESSION['cart'])) {
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $value) {
                                echo '
                                <div class="item">
                                    <div class="image">
                                        <img src="images/'.$value['image'].'" alt="" style="width: 50px">
                                    </div>
                                    <div class="name">
                                        '.$value['name'].'
                                    </div>
                                    <div class="totalPrice">
                                        £'.$value['price'].'
                                    </div>
                                    <div class="quantity">
                                        <span class="minus"><</span>
                                        <span>'.$value['quantity'].'</span>
                                        <span class="minus">></span>
                                    </div>
                                </div>

                                ';
                                $total = $total + $value['price'] * $value['quantity'];
                                $_SESSION['total'] = $total;
                            }
                        } else {
                            echo '<p>No items in your cart yet.</p>';
                            $total = 0;
                            $_SESSION['total'] = $total;
                        }
                    echo '</div>
                        <div>
                        <p>Total: £'.$total.'</p>';
                    ?>
                </div>
                <button onclick="location.href='checkout.php'">Continue to Checkout</button>
            </div>
        </div>
    </div>

    <div class="menu-nav" id="menu">
        <h2>Menu.</h2>
        <ul id="menuitems">
            <?php 
                if (!isset($pdo)) {
                    require '../database.php';
                }

                $categoryTable = new DataBaseTable($pdo, 'categories', 'category_id');
                $stmt = $categoryTable->findAll();

                echo '<li>
                        <a href="index.php#menu">All</a>
                    </li>';

                foreach ($stmt as $category) {
                    echo '<li>
                            <a href="index.php?category_id=' . $category['category_id'] . '#menu' .'">' . $category['name'] . '</a>
                        </li>';
                }
            ?>
        </ul>
    </div>


    <section class="menu">
        <div class="menu-items">
            <?php 
                if (!isset($pdo)) {
                    require '../database.php';
                }

                $productsTable = new DataBaseTable($pdo, 'products', 'productid');

                // Check if a category has been selected
                if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
                    $category_id = $_GET['category_id'];
                    $products = $productsTable->findAllFrom('category_id', $category_id);
                    

                } else {
                    // If no category selected, show all products
                    $products = $productsTable->findAll();
                }

                foreach ($products as $product) {
                    
                    $randomrating = rand(1, 5);
                    

                    echo '
                        <div class="menu-item">
                            <form method="POST" action="index.php?id='. $product['productid'] .'#menu" style="all: revert">
                                <div class="image">
                                    <img src="images/' . $product['image'] . '" alt="menu-item">
                                </div>
                                <i class="fa-solid fa-circle-info iteminfo" onclick="showDescription(event, \'' . htmlspecialchars($product['description'], ENT_QUOTES) . '\')"></i>
                                <div class="description">
                                    <h3>' . $product['name'] . '</h3>
                                    <p>£' . $product['price'] . '</p>
                                </div>
                                
                                <input type="hidden" name="name" value="'. $product['name'] .'">


                                <div class="stars">';

                                for ($i = 1; $i <= 5; $i++){
                                    $starclass = $i <= $randomrating ? 'fa-star checked' : 'fa-star';
                                    echo '<span class="fa ' . $starclass . '"></span>';
                                }
                            echo '</div>    
                                
                                <input type="hidden" name="price" value="'. $product['price'] .'">
                                <input type="hidden" name="image" value="'. $product['image'] .'">
                                <input type="submit" name="addtocart" value="Add To Cart">
                            </form>
                        </div>
                    ';
                }
            echo '
                <div id="floating-description" class="floating-description" style="display: none;">
                    <span class="close-btn" onclick="hideDescription()">✖</span>
                    <p id="desc-content"></p>
                </div>';
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
            <a href="#">Terms of use</a> | 
            <a href="#">Terms and Conditions</a> | 
            <a href="#">Privacy policy</a> | 
            <a href="#">Copyright and legal</a> | 
            <a href="#">Marketing Preferences</a> | 
            <a href="#">Cookie policy</a> <br> 
            &copy; 2025 The Highway UK Limited
        </div>
    </footer>
</body>
</html>
