<?php
// submit_order.php

header('Content-Type: application/json');
$response = ['success' => false, 'message' => ''];

try {
    $servername = "localhost";
    $username = "root";    // your DB username
    $password = "";        // your DB password
    $dbname = "shopping";  // your DB name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");

    // Get POST data & sanitize
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_address = $conn->real_escape_string($_POST['customer_address']);
    $customer_mobile = $conn->real_escape_string($_POST['customer_mobile']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $customer_city = $conn->real_escape_string($_POST['customer_city']);
    $customer_zone = $conn->real_escape_string($_POST['customer_zone']);

    $delivery_method = $conn->real_escape_string($_POST['delivery_method']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']);

    $online_payment_option = isset($_POST['online_payment_option']) ? $conn->real_escape_string($_POST['online_payment_option']) : null;
    $transaction_last4 = isset($_POST['transaction_last4']) ? $conn->real_escape_string($_POST['transaction_last4']) : null;
    $transaction_amount = isset($_POST['transaction_amount']) ? floatval($_POST['transaction_amount']) : 0;

    $cart_data = json_decode($_POST['cart_data'], true);

    if (!$cart_data || count($cart_data) === 0) {
        throw new Exception("Cart data is empty.");
    }

    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_address, customer_mobile, customer_email, customer_city, customer_zone, delivery_method, payment_method, online_payment_option, transaction_last4, transaction_amount, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssssssssd", $customer_name, $customer_address, $customer_mobile, $customer_email, $customer_city, $customer_zone, $delivery_method, $payment_method, $online_payment_option, $transaction_last4, $transaction_amount);

    if (!$stmt->execute()) {
        throw new Exception("Failed to insert order: " . $stmt->error);
    }

    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert each cart item into order_items table
    $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_name, product_price, product_quantity, product_total_price, product_image) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($cart_data as $item) {
        $product_name = $conn->real_escape_string($item['name']);
        $product_price = floatval($item['price']);
        $product_quantity = intval($item['quantity']);
        $product_total_price = $product_price * $product_quantity;
        $product_image = $conn->real_escape_string($item['image']);

        $stmt2->bind_param("isdids", $order_id, $product_name, $product_price, $product_quantity, $product_total_price, $product_image);
        if (!$stmt2->execute()) {
            throw new Exception("Failed to insert order item: " . $stmt2->error);
        }
    }
    $stmt2->close();

    $conn->close();

    $response['success'] = true;
    $response['message'] = "Order placed successfully!";

    // Redirect or show message here
    echo "<script>alert('Order placed successfully!'); window.location.href = 'index.html';</script>";
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    echo "<script>alert('Error: {$response['message']}'); window.history.back();</script>";
}
?>
