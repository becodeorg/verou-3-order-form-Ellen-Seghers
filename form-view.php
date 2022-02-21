<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Cat Suits</title>
</head>
<body>
<div class="container">
    <div class="alert alert-primary" role="alert">
        <?php
            // Replace this if by an actual check
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                handleForm();
            }
        ?>
    </div>
    <h1>Place your order</h1>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> of cat suits!</footer>
</div>
<?php
if($errorFlag == true) {
    fillForm();
}
    function fillForm () {
        ?><script>
            const email = document.getElementById("email");
            email.value = "<?= $_POST['email']?>";

            const city = document.getElementById("city");
            city.value = "<?= $_POST['city']?>";

            const zipcode = document.getElementById("zipcode");
            zipcode.value = "<?= $_POST['zipcode']?>";

            const streetNumber = document.getElementById("streetnumber");
            streetNumber.value = "<?= $_POST['streetnumber']?>";

            const street = document.getElementById("street");
            street.value = "<?= $_POST['street']?>";

            let checkBox;
            <?php
            if (sizeof($_POST['products']) > 0) {
                $product = array_keys($_POST['products']);

                for ($i = 0 ; $i < count($product) ; $i++){
                    $productKey = $product[$i];
                    ?>
                        checkBox = document.querySelector('input[name="products[<?= $productKey?>]"]');
                        checkBox.checked = true;
                    <?php
                }
            }
            ?>
        </script><?php
    }
?>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
