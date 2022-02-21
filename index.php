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
$errorFlag = false;

function validate() {
    // This function will send a list of invalid fields back
    $errorArr = [];
    if (empty($_POST['street'])){
        array_push($errorArr, "Street is required!");
    }
    if (empty($_POST['streetnumber'])){
        array_push($errorArr, "Streetnumber is required!");
    }
    if (empty($_POST['zipcode'])){
        array_push($errorArr, "Zipcode is required!");
    }
    if (empty($_POST['city'])){
        array_push($errorArr, "City is required!");
    }
    if (empty($_POST['email'])){
        array_push($errorArr, "Email is required!");
    }
    if (empty($_POST['products'])){
        array_push($errorArr, "Products are required!");
    }
    if (!is_numeric($_POST['zipcode'])){
        array_push($errorArr, "Zipcode is not a number!");
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errorArr, "Email address is not valid!");
    }

    return $errorArr;
}

function handleForm() {
    global $errorFlag;
    global $products;
    // Form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        for ($counter = 0; $counter < sizeof($invalidFields); $counter++) {
            $error = $invalidFields[$counter];
            print_r($error."<br>");
        }
        $errorFlag = true;
    }
    else {
        // Handle successful submission
        $streetName = $_POST['street'];
        $streetNumber = $_POST['streetnumber'];
        $zipCode = $_POST['zipcode'];
        $city = $_POST['city'];
        $address = $streetName ." ". $streetNumber . " " . $zipCode . " " . $city;

        $alertText = "Delivery address: $address<br>Product list:<br><ul> ";

        $product = array_keys($_POST['products']);

        for ($i = 0 ; $i < count($product) ; $i++){
            $productKey = $product[$i];
            $currentProduct = $products[$productKey];
            $alertText .="<li>". $currentProduct['name'] . " €" . $currentProduct['price']."</li><br>";
        }

        $alertText.= "</ul>";
        print_r($alertText);
    }
}

require 'form-view.php';