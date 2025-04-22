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
<body style="background-color: #f2f2f2;">
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
  <?=$output?>
</div>
</body>
</html>

        
