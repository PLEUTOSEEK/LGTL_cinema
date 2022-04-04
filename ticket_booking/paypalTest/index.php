<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PayPal REST API Example</title>

    </head>
    <body class="App">
        <h1>How to Integrate PayPal REST API Payment Gateway in PHP</h1>
        <div class="wrapper">
            <?php
            include_once 'db_connection.php';
            ?>
            <?php
            $results = mysqli_query($db_conn, "SELECT * FROM products where status=1");
            $id = "";
            $name = "";
            $price = 0.0;
            while ($row = mysqli_fetch_array($results)) {
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                ?>
                <div class="col__box">
                    <h5><?php echo $row['name']; ?></h5>
                    <h6>Price: <span> $<?php echo $row['price']; ?> </span> </h6>
                    <form class="paypal" action="request.php" method="post" id="paypal_form">
                        <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>" >
                        <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>" >
                        <input type="hidden" name="amount" value="<?php echo $row['price']; ?>" >
                        <input type="hidden" name="currency_code" value="USD" >
                        <input type="submit" name="submit" value="Buy Now" class="btn__default">
                    </form>
                </div>
            <?php } ?>
        </div>

    </body>
</html>