<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Creadt Card Template</title>
</head>

<body>

    <?php

    $expiryErr = $cvcErr = $nameErr = $cardNumberErr = "";
    $expiry = $cvc = $name = $cardNumber = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["expiry"])) {
            $expiryErr = "Expiry date required";
        } else {
            $expiry = test_input($_POST["expiry"]);
            if (!preg_match('/^[0-9]{4}+$/', $expiry)) {
                $expiryErr = "Invalid expiry format";
            }
        }

        if (empty($_POST["cvc"])) {
            $cvcErr = "CVC required";
        } else {
            $cvc = test_input($_POST["cvc"]);
            if (!preg_match('/^[0-9]{3}+$/', $cvc)) {
                $cvcErr = "Invalid CVC number";
            }
        }

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["cardnumber"])) {
            $cardNumberErr = "Card number required";
        } else {
            $cardNumber = test_input($_POST["cardnumber"]);
            if (!preg_match('/^[0-9]{20}+$/', $cardNumber)) {
                $cardNumberErr = "Invalid card number";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <div class="background">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
    </div>

    <div class="backingbox">
        <h1 class="toptext">Payment Method</h1><br>
        <img src="./images/creditcard.png" alt="Credit card image"><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!--expiry date-->
            <br><input class="make" type="text" name="expiry" placeholder="   Expiry (MM/YY)"><span class="error"><?php echo $expiryErr; ?></span><br>
            <!--cvc-->
            <br><input class="make" type="text" name="cvc" placeholder="   CVC"><span class="error"><?php echo $cvcErr; ?></span><br>
            <!--name on card-->
            <br><input class="make" type="text" name="name" placeholder="   Name on Card"><span class="error"><?php echo $nameErr; ?></span><br>
            <!--card number-->
            <br><input class="make" type="text" name="cardnumber" placeholder="   Card Number"><span class="error"><?php echo $cardNumberErr; ?></span><br>
            <!--submit-->
            <input class="button" type="submit" name="submit" value="Pay Now">
    </div>

    <?php
    echo $expiry;
    echo "<br>";
    echo $cvc;
    echo "<br>";
    echo $nameErr;
    echo "<br>";
    echo $cardNumber;
    ?>

</body>

</html>