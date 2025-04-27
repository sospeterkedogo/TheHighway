<div class="container" >
<div class="main-area">
  <form action="checkout.php" method="POST" class="checkout-form" style="all:unset">
    <!-- SHIPPING -->
    <label class="section-label" >
      SHIPPING ADDRESS 
      <i id="drop1" class="fa-solid fa-angle-down toggle-icon dropbtn checkout-page"></i>
    </label>
    <?php if (empty($address)): ?>
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

        <label>Phone Number</label>
        <input type="text" name="phone" />

        <label>Email</label>
        <input type="text" name="email" placeholder="To receive order confirmation" />
      </div>
    <?php else: ?>
  <div class="dropdown hidden" id="1">
    <p><?= htmlspecialchars($address['address_line1']) ?></p>
    <?php if (!empty($address['address_line2'])): ?>
      <p><?= htmlspecialchars($address['address_line2']) ?></p>
    <?php endif; ?>
    <p><?= htmlspecialchars($address['city']) ?>, <?= htmlspecialchars($address['postcode']) ?></p>
    <p><?= htmlspecialchars($address['country']) ?></p>
    <a href="#">Change?</a>
  </div>
<?php endif; ?>
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
      <table>
        <tr>
          <th>Item(s)</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
        <?php
          $totalCart = 0;
          foreach ($_SESSION['cart'] as $item) {
              if (!isset($item["price"], $item["quantity"])) continue; // skip any weird broken items
              
              $total = $item["price"] * $item["quantity"];
              $totalCart += $total;
          
              echo '
              <tr>
                <td>'.htmlspecialchars($item["name"]).'</td>
                <td>£ '.number_format($item["price"], 2).' </td>
                <td>'.$item["quantity"].'</td>
                <td>£ '.number_format($total, 2).'</td>
              </tr>
              ';
          }
        ?>
      </table>
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