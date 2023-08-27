<?php

if (!isset($_SESSION['can302'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
$page_title="Thank You!";
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $admin = $_SESSION['can302'];
    $get_admin = "select * from users where email='$admin'";
    $run_admin = mysqli_query($con,$get_admin);
    $row_admin = mysqli_fetch_array($run_admin);
    $nickname = $row_admin['nickname'];
    $role = $row_admin['role'];
    $id = $row_admin['id'];

    $order_query = "SELECT * FROM orders WHERE id = '$order_id' AND user_id = '$id'";
    $order_result = mysqli_query($con, $order_query);

    if (mysqli_num_rows($order_result) > 0) {
        $order = mysqli_fetch_assoc($order_result);
        $product_id = $order['product_id'];

        $product_query = "SELECT name, price FROM product WHERE id = '$product_id'";
        $product_result = mysqli_query($con, $product_query);

        if (mysqli_num_rows($product_result) > 0) {
            $product = mysqli_fetch_assoc($product_result);
            $product_name = $product['name'];
            $order_total = $order['total_price'];

            // Display order confirmation
            echo "Order Confirmation<br>";
            echo "Product: $product_name<br>";
            echo "Total Price: $order_total<br>";
            echo "Thank you for your purchase!";
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Order not found.";
    }
}
?>
