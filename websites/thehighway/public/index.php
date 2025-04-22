<?php 
session_start();


if (!isset($pdo)) {
    require '../database.php';
}

$productsTable = new DataBaseTable($pdo, 'products', 'productid');

// Add item to cart
if (isset($_POST['addtocart'])) {
    $id = $_POST['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
        $_SESSION['quantity'] += 1;
    } else {
        $session_array = array(
            'id' => $id,
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'quantity' => 1
        );

        $_SESSION['cart'][$id] = $session_array;
        $_SESSION['quantity'] += 1;
    }

    // Reduce product stock in database
    $product = $productsTable->find('productid', $id);
    $newquantity = max(0, $product['quantity'] - 1); // Ensure quantity is never negative

    $record = [
        'productid' => $id,
        'quantity' => $newquantity
    ];
    $productsTable->save($record, $id);
}

// Increase item quantity in cart
if (isset($_POST['plus'])) {
    $key = $_POST['item_key'];

    // Get product details from database
    $product = $productsTable->find('productid', $key);

    if ($product['quantity'] > 0) { // Ensure stock is available before increasing
        $_SESSION['cart'][$key]['quantity']++;

        // Reduce stock in database
        $newquantity = $product['quantity'] - 1;
        $productsTable->save(['productid' => $key, 'quantity' => $newquantity], $key);
    }
    $_SESSION['quantity']++;
}

// Decrease item quantity in cart
if (isset($_POST['minus'])) {
    $key = $_POST['item_key'];

    if ($_SESSION['cart'][$key]['quantity'] > 1) {
        $_SESSION['cart'][$key]['quantity']--;

        // Increase stock in database
        $product = $productsTable->find('productid', $key);
        $newquantity = $product['quantity'] + 1;
        $productsTable->save(['productid' => $key, 'quantity' => $newquantity], $key);
    } else {
        // Remove item from cart
        unset($_SESSION['cart'][$key]);

        // Increase stock in database when item is fully removed
        $product = $productsTable->find('productid', $key);
        $newquantity = $product['quantity'] + 1;
        $productsTable->save(['productid' => $key, 'quantity' => $newquantity], $key);
    }
    $_SESSION['quantity']--;
}

if (isset($_POST['send'])){
    // Save comm details in the database
    $record = [
        'username' => $_POST['username'],
        'contact' => $_POST['contact'],
        'subject' => $_POST['subject'],
        'message' => $_POST['message']
    ];

    $commsTable = new DataBaseTable($pdo, 'communication', 'id');
    $commsTable->save($record);
}

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
    <script src="//code.tidio.co/xu1xmcvxdsdkp2far3ibkvn3vl7uewut.js" async></script>
</head>

<body class="home-page">
    <section class="hero" id="hero">
        <nav>
            <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
            <ul id="nav">
                <li><a href="#menu">Menu</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <?php if(isset($_SESSION['loggedIN']) && $_SESSION['loggedIN'] === true): ?>
            <a href="dashboard.php"><i class="fa-regular fa-user" style="color:#fff; font-size: 1em;"> <?= $_SESSION['username1']?></i></a>
            <?php else: ?>
            <div class="signon">
            <a href="userregister.php">Register</a> 
            <a href="userlogin.php">Login</a>
            </div>
            
            <?php endif; ?>
            
            
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
            
            <i class="fa-solid fa-bars menuicon" id="navbtn" ></i>
        </nav>
        <!-- 
        <div id="animated-text-strip">
            <span class="marquee">Order Now and get 20% off your first order!!!&nbsp;</span>
            <span class="marquee">Order Now and get 20% off your first order!!!&nbsp;</span>
            <span class="marquee">Order Now and get 20% off your first order!!!&nbsp;</span>
        </div>
        -->
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
                                        <form method = "POST" action="/#menu" style="all:unset;">
                                            <input type="hidden" name="item_key" value="'.$key.'">
                                            <input type="submit" name="minus" value="<" style="all:unset; cursor: pointer;">
                                        </form>
                                        <span>'.$value['quantity'].'</span>
                                        <form method = "POST" action="/#menu" style="all:unset;">
                                            <input type="hidden" name="item_key" value="'.$key.'">
                                            <input type="submit" name="plus" value=">" style="all:unset; cursor: pointer;">
                                        </form>
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

    <section class="deals">
        
        <div class="deal-items">
            <div class="deal-item">
                <img src="images/deal1.jpg" alt="Deal 1">
                <h2>Today's Deals</h2>
            </div>
            <div class="deal-item">
                <img src="images/deal2.jpg" alt="Deal 2">
                <h2>Top Offers</h2>
            </div>
            <div class="deal-item">
                <img src="images/deal3.jpg" alt="Deal 3">
                <h2>Popular Categories</h2>
            </div>
            <div class="deal-item">
                <img src="images/deal4.jpg" alt="Deal 4">
                <h2>Best Seller</h2>
            </div>
            
    </section>

    <section class="best-sellers">
        <h2>Best Sellers</h2>
        <div class="best-seller-items">
            <div class="best-seller-item">
                <img src="images/bestseller.png" alt="Best Seller 1" class="bestseller-tag">
                <img src="images/best-seller1.jpg" alt="Best Seller 1">
                <h3>Margherita Cheese Pizza</h3>
            </div>
            <div class="best-seller-item">
                <img src="images/bestseller.png" alt="Best Seller 1" class="bestseller-tag">
                <img src="images/best-seller2.jpg" alt="Best Seller 2">
                <h3>Buffalo Chicken Burger</h3>
            </div>
            <div class="best-seller-item">
                <img src="images/bestseller.png" alt="Best Seller 1" class="bestseller-tag">
                <img src="images/best-seller3.jpg" alt="Best Seller 3">
                <h3>Tiramisu Dessert</h3> 
            </div>
        </div>
    </section>

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
                        <a href="/#menu">All</a>
                    </li>';

                foreach ($stmt as $category) {
                    echo '<li>
                            <a href="/?category_id=' . $category['category_id'] . '#menu' .'">' . $category['name'] . '</a>
                        </li>';
                }
            ?>
        </ul>
    </div>
    <div class="search-bar">
            <input type="text" placeholder="Search for a product">
            <button>Search</button>
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

                    $quantity = $product['quantity'];
                    $noneleftclass = ($quantity == 0) ? 'none-left' : 'none-left-hidden';
                    
                    
                    echo '
                        <div class="menu-item" id="menu-item">
                        <div class="'.$noneleftclass.'"><h3 style="text-align:center;color:#fff;padding-top:50%">None left</h3></div>
                            <form method="POST" action="index.php?#menu-item" style="all: revert">
                                <div class="image">
                                    <img src="images/' . $product['image'] . '" alt="menu-item">
                                </div>
                                    <i class="fa-solid fa-circle-info iteminfo"
                                    onclick="showDescription(event, \'' . htmlspecialchars($product['description'], ENT_QUOTES) . '\')">
                                    </i>
                                <div class="description">
                                    <h3>' . $product['name'] . '</h3>
                                    <p>£' . $product['price'] . '</p>
                                </div>
                                
                                <input type="hidden" name="name" value="'. $product['name'] .'">


                                <div class="stars">';

                                for ($i = 1; $i <= 5; $i++){
                                    $starclass = $i <= $product['rating'] ? 'fa-star checked' : 'fa-star';
                                    echo '<span class="fa ' . $starclass . '"></span>';
                                }
                            echo '</div>    
                                <input type="hidden" name="productquantity" value="'. $product['quantity'] .'">
                                <input type="hidden" name="price" value="'. $product['price'] .'">
                                <input type="hidden" name="image" value="'. $product['image'] .'">
                                <input type="hidden" name="id" value="'. $product['productid'] .'">
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

    <section id="about" style="color:#fff;background-color:darkblue;padding: 25vh 10vw;">
        <h1>About Us</h1>
        <h2>Our passion for culinary excellence drives us to create dishes that not only delight the palate but also tell a story.</h2>
        <p>Whether you're here for a casual lunch or a special dinner, our commitment to exceptional service and unforgettable flavors ensures a memorable experience every time you visit.</p>
        
        
        
    </section>

    <section id="contact">
        <h2>Contact Us</h2>
        <p>Fill in the form below with your details and message and a member of our team will get in touch as soon as possible</p>
        <div class="centered-div">
        <div>
            <i class="fa-solid fa-map-location-dot"></i>
            <h3>Address</h3>
            <p>123 Sugar Street</p>
            <i class="fa-solid fa-phone"></i>
            <h3>Phone</h3>
            <p>+44 123 456 7890</p>
            <i class="fa-solid fa-envelope"></i>
            <h3>Email</h3>
            <p>thehighway@gmail.com</p>
            
        </div>
        <form action="index.php?#contact" method="post" style="margin: 0" >
            <label class="formtitle">Send Message</label>
            <input type="text" placeholder="Full Name" name="username">
            <input type="text" placeholder="Email" name="contact">
            <input type="text" placeholder="Subject" name="subject">
            <textarea placeholder="Type Your message" name="message"></textarea>
            <input type="submit" value="Send" name="send">
        </form>
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
