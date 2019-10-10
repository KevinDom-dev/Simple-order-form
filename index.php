<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}


$error = $email = $name = $submitOk = $field = $emailError = $message = $calc = "";
$products = $product = [];
if(isset($_POST['submit'])) {
    $name = array('street', 'streetnumber', 'city', 'zipcode');
    $errorTxt = " is required.";
    $numberErr = " should be a number.";
    $errors = array();
    $noError = array();
    $error = array();
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "$email is an invalid email";
            } else {
            $submitOk = "<i>Order sent</i>";
            }
    }
    foreach($name as $i => $field) {
        if (empty($_POST[$field])) {
            $error[] = $name[$i] . $errorTxt;
        } else if (!is_numeric($_POST["streetnumber"])) {
            $error[1] = $name[1] . $numberErr;
        } else if (!is_numeric($_POST["zipcode"])){
            $error[3] = $name[3] . $numberErr;
        } else {
            $error[] = $_POST[$field];
        }
    }
    if (empty($_POST['formDelivery'])) {
        $message .= "<li>You forgot to select your preferred delivery type!</li>";
    } elseif ($_POST['formDelivery'] = "Express")  {
        $message .= "<li>Your order will be delivered in 45 minutes.</li>";
    } else {
        $message .= "<li>Your order will be delivered in 2 hours.</li>";
    }
}
whatIsHappening();
/*
 *    $name = array('street', 'streetnumber', 'city', 'zipcode', 'email');
    $error = false;
    foreach($name as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }
    if ($error) {
        echo "All fields are required.";
    } else {
        echo "Proceed...";
    }
 */



//your products with their price.
$productPrice = [];
$product = [];

if(isset($_GET['food']) && $_GET['food'] == 0) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
    if ($_POST['products']){
        foreach ($productPrice as $key => $product["price"]) {
             $calc = array_sum($productPrice);
            var_dump($calc);
        }
    }
} else {
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
    if ($_POST['products']){
        $totalValue = array_sum($products);
    }
}

$totalValue = 0;
require 'form-view.php';