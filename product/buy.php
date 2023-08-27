<?php
// Ensure user is logged in
if (!isset($_SESSION['can302'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
$admin = $_SESSION['can302'];
$get_admin = "select * from users where email='$admin'";
$run_admin = mysqli_query($con,$get_admin);
$row_admin = mysqli_fetch_array($run_admin);
$nickname = $row_admin['nickname'];
$role = $row_admin['role'];
$id = $row_admin['id'];

function simulatePayment() {
    // Placeholder simulation of payment process
    $randomSuccess = rand(0, 1); // Randomly generate success or failure
    return $randomSuccess;
}
// Assuming $_GET['id'] contains the product ID
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $query = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $product_row = mysqli_fetch_assoc($result);

        $pro_name = $product_row['name'];
        $pro_price = $product_row['price'];
        $pro_stock = $product_row['stock'];
    } else {
        // Handle database error
        echo "Error fetching product details: " . mysqli_error($con);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle the form submission
        $quantity = $_POST['quantity'];
        // Calculate total price
        $total_price = $pro_price * $quantity;

        // Store the order in the database (you need to have an orders table)
        // Insert or update the order record with user ID, product ID, quantity, total price, etc.

        // Simulate a payment process
        $payment_success = simulatePayment(); // You can adjust this based on your payment process

        if ($payment_success) {

            $existing_order_query = "SELECT * FROM orders WHERE user_id = '$id' AND product_id = '$product_id' AND status = 'paid'";
            $existing_order_result = mysqli_query($con, $existing_order_query);
            
            if (mysqli_num_rows($existing_order_result) > 0) {
                // User has an existing order, update the total price and quantity
                $existing_order = mysqli_fetch_assoc($existing_order_result);
                $order_id = $existing_order['id'];
                $existing_quantity = $existing_order['quantity'];
                $existing_total_price = $existing_order['total_price'];
            
                $total_price = $existing_total_price + ($pro_price * $quantity);
            
                $update_query = "UPDATE orders SET quantity = '$quantity', total_price = '$total_price' WHERE id = '$order_id'";
                mysqli_query($con, $update_query);
 
            } else {
                $insert_query = "INSERT INTO orders (user_id, product_id, quantity, total_price, status) VALUES ('$id', '$product_id', '$quantity', '$total_price', 'paid')";
                mysqli_query($con, $insert_query);

            }

            $latest_order_query = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($con, $latest_order_query);
            $row = mysqli_fetch_assoc($result);
            $next_order_id = $row['id'];
            echo "<script>
                window.open('index.php?product=order_confirmation&order_id=" . $next_order_id . "','_self')
                </script>";
            exit;
        } else {
            // Payment failed, handle accordingly
            echo "Payment failed. Please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Preview Order</title>
</head>
<body>
    <h2>Preview Order</h2>
    <p>Product: <?php echo $pro_name; ?></p>
    <p>Price: <?php echo $pro_price; ?></p>
    <p>Stock: <?php echo $pro_stock; ?></p>
    
    <form method="POST">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" min="1" max="<?php echo $pro_stock; ?>" required>
        <br>
        <p>Total Price: <span id="total-price">0</span></p>
        <input type="submit" value="Place Order">
    </form>

    <script>
        const quantityInput = document.querySelector('input[name="quantity"]');
        const totalPriceSpan = document.getElementById('total-price');
        const proPrice = <?php echo $pro_price; ?>;

        quantityInput.addEventListener('input', () => {
            const quantity = parseInt(quantityInput.value) || 0;
            const total = quantity * proPrice;
            totalPriceSpan.textContent = total;
        });
    </script>
</body>
</html>
