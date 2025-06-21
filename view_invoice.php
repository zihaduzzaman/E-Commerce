<?php
// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
if ($order_id <= 0) {
    die("Invalid Order ID");
}

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    die("Order not found.");
}

$cart_items = json_decode($order['cart_items'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Invoice - Order #<?php echo $order_id; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #f4f4f4; }
    .invoice-box {
      background: #fff;
      padding: 30px;
      margin: 30px auto;
      border-radius: 10px;
      max-width: 800px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    h1, h3, h5 {
      color: #007bff;
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="invoice-box">
  <h1 class="mb-3">Invoice - Order #<?php echo $order_id; ?></h1>
  <p><strong>Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></p>

  <h3>Customer Information</h3>
  <ul>
    <li><strong>Full Name:</strong> <?php echo htmlspecialchars($order['full_name']); ?></li>
    <li><strong>Mobile:</strong> <?php echo htmlspecialchars($order['mobile']); ?></li>
    <li><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></li>
    <li><strong>City:</strong> <?php echo htmlspecialchars($order['city']); ?></li>
    <li><strong>Zone:</strong> <?php echo htmlspecialchars($order['zone']); ?></li>
    <li><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($order['address'])); ?></li>
  </ul>

  <h3>Delivery & Payment</h3>
  <ul>
    <li><strong>Delivery Method:</strong> <?php echo htmlspecialchars($order['delivery_method']); ?></li>
    <li><strong>Delivery Charge:</strong> ৳<?php echo number_format($order['delivery_charge'], 2); ?></li>
    <li><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></li>
    <?php if ($order['payment_method'] === 'Online Payment'): ?>
      <li><strong>Payment Gateway:</strong> <?php echo htmlspecialchars($order['payment_gateway']); ?></li>
      <li><strong>Last 4 Digits:</strong> <?php echo htmlspecialchars($order['last_4_digits']); ?></li>
      <li><strong>Amount Sent:</strong> ৳<?php echo number_format($order['amount_sent'], 2); ?></li>
    <?php endif; ?>
  </ul>

  <h3>Ordered Products</h3>
  <?php if (!empty($cart_items) && is_array($cart_items)): ?>
    <table class="table table-bordered">
      <thead class="table-primary">
        <tr>
          <th>Product Image</th>
          <th>Product Name</th>
          <th>Price (৳)</th>
          <th>Quantity</th>
          <th>Subtotal (৳)</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $grand_total = 0;
          foreach ($cart_items as $product):
            $subtotal = $product['price'] * $product['quantity'];
            $grand_total += $subtotal;
        ?>
          <tr>
            <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:70px; height:70px; object-fit:cover; border-radius:5px;"></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo number_format($product['price'], 2); ?></td>
            <td><?php echo intval($product['quantity']); ?></td>
            <td><?php echo number_format($subtotal, 2); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h5 class="text-end">Grand Total (Products): ৳<?php echo number_format($grand_total, 2); ?></h5>
    <h5 class="text-end">Delivery Charge: ৳<?php echo number_format($order['delivery_charge'], 2); ?></h5>
    <h3 class="text-end">Total Amount: ৳<?php echo number_format($grand_total + $order['delivery_charge'], 2); ?></h3>
  <?php else: ?>
    <p>No products found in this order.</p>
  <?php endif; ?>

</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
