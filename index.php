<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
//    echo '<h2>$_COOKIE</h2>';
//    var_dump($_COOKIE);
//    echo '<h2>$_SESSION</h2>';
//    var_dump($_SESSION);
}

// Provide some products (you may overwrite the example)
$products = [
    ['name' => 'Harness Suit', 'price' => 17.0],
    ['name' => 'Collar', 'price' => 7.5],
    ['name' => 'Walking Line', 'price' => 13.0],
    ['name' => 'Christmas Suit', 'price' => 11.5],
    ['name' => 'Birthday Suit', 'price' => 21.0],
    ['name' => 'Valentine Suit', 'price' => 22.5],
    ['name' => 'Lion Costume', 'price' => 22.5],
    ['name' => 'Black Bat Wings (Halloween)', 'price' => 20.5],
    ['name' => 'Cap For Sun Protection', 'price' => 5.0],
];

$totalValue = 0;

function validate()
{
    // This function will send a list of invalid fields back
    return [];
}

function handleForm() {
    global $products;
    // TODO: form related tasks (step 1)
    $streetName = $_POST['street'];
    $streetNumber = $_POST['streetnumber'];
    $zipCode = $_POST['zipcode'];
    $city = $_POST['city'];
    $address = $streetName ." ". $streetNumber . " " . $zipCode . " " . $city;

    $alertText = "Delivery address: $address Product list: ";

    $product = array_keys($_POST['products']);
    print_r($product);

    for ($i = 0 ; $i < count($product) ; $i++){
        $productKey = $product[$i];
        $currentProduct = $products[$productKey];
        $alertText .= $currentProduct['name'] . " €" . $currentProduct['price']." ";
    }

    ?>
    <script>alert("<?= $alertText ?>")</script>
    <?php

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleForm();
}

require 'form-view.php';