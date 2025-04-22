<div class="centered-div">
<div class="order-confirmation" style="border: 1px solid red; padding: 4rem;">
    <h3 style="margin-bottom: 1.5rem;">✨Order Placed Successfully.✨</h3>
    <p >Thank you for your order, <?= htmlspecialchars($_SESSION['username1']) ?>!</p>
    <p style="margin-bottom: 1.5rem;">Your order has been processed successfully.</p>
    <div class="confirmation-actions">
        <form action="index.php" method="GET" style="display: inline; background: none; box-shadow: none;">
            <button type="submit" class="btn">Return to Home</button>
        </form>
        <form action="orders.php" method="POST" style="display: inline; background: none; box-shadow: none;">
            <button type="submit" class="btn">Track Order</button>
        </form>
        <form action="logout.php" method="POST" style="display: inline; background: none; box-shadow: none;">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</div>
</div>
 