
<?php
session_start();
require('datacon.php');

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted

    // Get the total price, quantity, item name quantity, and customer ID from the form
    // require('checkout.php');
    $totalPrice =  $_SESSION['totalPrice'];
    $totalQuantity =$_SESSION['totalQuantity'];
    $item_name_quantity = $_SESSION['item_name_quantity'];
    $customerId = $_SESSION['customer_id'];

    // Insert the order into the orders table
    $orderDate = date("Y-m-d H:i:s");
    $query = "INSERT INTO orders (customer_id, order_date, quantity, item_name_quantity, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isisi", $customerId, $orderDate, $totalQuantity, $item_name_quantity, $totalPrice);
    
    if (mysqli_stmt_execute($stmt)) {
        // Order successfully inserted
        echo '<script>alert("Order Placed Succesfully"); window.location.href = "menu.php";</script>';
        exit();
        // header("Location:menu.php");
    } else {
        // Error inserting order
        echo "<script>alert('Failed to place order');</script>";
        
    }

?>