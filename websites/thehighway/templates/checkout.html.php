<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://kit.fontawesome.com/5b8fb5fe8f.js" crossorigin="anonymous"></script>
    <script src="../javasript.js"></script>
    <style>
        input[type=text],
        input[type=date],
        input[type=number]  {
            border: 1px solid #000;
            margin-bottom: 1.6vh;
        }
        hr {
            margin-bottom: 1.5vh;
        }
    </style>
</head>
<body style="background-color: #f2f2f2;" class="checkout-page">
<div class="top-nav" style="height:15vh; display: flex; align-items: center; justify-content: space-between; margin: 0 5px;">

<a href="index.php"><img src="images/invertedlogo.png" alt="logo" class="logo" style="background-color: #000; width: 13vw"></a>
<div class="progress-steps">
    <div class="steps-line">
        <span class="step">1</span>
        <span class="line"></span>
        <span class="step">2</span>
        <span class="line"></span>
        <span class="step">3</span>
    </div>
    <div class="steps-labels">
        <span>Shipping</span>
        <span>Payment</span>
        <span>Review & Submit</span>
    </div>
</div>

<p>Secure Checkout <i class="fa fa-padlock"></i></p>
</div>

<div class="content" >
<div class="container" >
<div class="main-area">
  <form action="checkout.php" method="POST" class="checkout-form" style="all:unset">
    <!-- SHIPPING -->
    <label class="section-label">
      SHIPPING ADDRESS 
      <i id="drop1" class="fa-solid fa-angle-down toggle-icon"></i>
    </label>
    <div class="dropdown hidden" id="1">
      <label>Country</label>
      <input type="text" name="country" placeholder="United Kingdom" />

      <label>First Name</label>
      <input type="text" name="fname" />

      <label>Last Name</label>
      <input type="text" name="lname" />

      <label>Address 1</label>
      <input type="text" name="street" placeholder="Street Address" />

      <label>Address 2</label>
      <input type="text" name="apt" placeholder="Apartment, Suite, Unit, Floor" />

      <label>Post Code</label>
      <input type="text" name="postcode" placeholder="NN1 1AQ" />

      <label>City</label>
      <input type="text" name="city" />

      <label>State</label>
      <input type="text" name="state" />

      <label>Phone Number</label>
      <input type="text" name="phone" />

      <label>Email</label>
      <input type="text" name="email" placeholder="To receive order confirmation" />
    </div>

    <hr />

    <!-- PAYMENT -->
    <label class="section-label">
      PAYMENT
      <i id="drop2" class="fa-solid fa-angle-down toggle-icon"></i>
    </label>
    <div class="dropdown hidden" id="2">
      <label>Card Number</label>
      <input type="text" name="card" />

      <label>Expiration Date</label>
      <input type="date" name="date" />

      <label>CVV</label>
      <input type="number" name="cvv" />

      <input type="hidden" name="quantity" value="<?= $_SESSION['quantity'] ?>">
      <input type="hidden" name="subtotal" value="<?= $_SESSION['subtotal'] ?>">
    </div>

    <hr />

    <!-- REVIEW -->
    <label class="section-label">
      REVIEW & SUBMIT
      <i id="drop3" class="fa-solid fa-angle-down toggle-icon"></i>
    </label>
    <div class="dropdown hidden" id="3">
      <label>Items: <?= $_SESSION['quantity'] ?></label>
      <input type="submit" value="PLACE ORDER AND PAY" name="checkout" class="submit-btn" />
      <input type="submit" value="BACK" name="back" class="back-btn" />
    </div>
  </form>
</div>


            <div class="aside order-summary">
                <h3>Order Summary</h3>
                <div class="summary-line">
                    <span>Order total:</span>
                    <span>£<?= $_SESSION['total']?></span>
                </div>
                <div class="summary-line">
                    <span>Items:</span>
                    <span><?= $_SESSION['quantity']?></span>
                </div>
                <div class="summary-line">
                    <span>Shipping:</span>
                    <span><b>Free</b></span>
                </div>
                <div class="summary-line">
                    <span>Estimated Tax:</span>
                    <span>£<?= $tax ?></span>
                </div>
                <hr>
                <div class="summary-line">
                    <span><b>Subtotal:</b></span>
                    <span><b>£<?= $_SESSION['subtotal']?></b></span>
                </div>
            </div>
        </div>
        </div>
</body>
</html>

        
