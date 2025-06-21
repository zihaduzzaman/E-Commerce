<?php
// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Ajax থেকে Request Handle করা - Done বা Cancel Action
if (isset($_POST['action']) && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    $action = $_POST['action'];

    if ($action === 'done') {
        // Status update to delivered
        $stmt = $conn->prepare("UPDATE orders SET status = 'delivered' WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => true, 'message' => 'Order marked as delivered']);
        exit;
    } elseif ($action === 'cancel') {
        // Delete order from DB
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => true, 'message' => 'Order cancelled and deleted']);
        exit;
    }
}

// Fetch all orders ordered by status and date
$sql = "SELECT * FROM orders ORDER BY FIELD(status, 'pending', 'delivered', 'cancelled'), id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f5f7fa;
      padding-top: 30px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .order-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      padding: 25px;
      transition: box-shadow 0.3s ease;
    }
    .order-card:hover {
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .order-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 15px;
    }
    .status-badge {
      padding: 5px 12px;
      border-radius: 20px;
      color: #fff;
      font-weight: 600;
      font-size: 0.9rem;
    }
    .status-pending {
      background: #f0ad4e;
    }
    .status-delivered {
      background: #5cb85c;
    }
    .status-cancelled {
      background: #d9534f;
    }
    .product-card {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 12px 15px;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      margin-bottom: 12px;
      background-color: #f9f9f9;
    }
    .product-card img {
      width: 90px;
      height: 90px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 0 7px rgba(0,0,0,0.1);
    }
    .product-info h6 {
      margin: 0 0 4px 0;
      font-weight: 600;
      color: #007bff;
    }
    .product-info p {
      margin: 0;
      font-size: 0.9rem;
      color: #333;
    }
    .btn-group {
      margin-top: 15px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    .btn-delivered {
      background-color: #28a745;
      color: #fff;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-delivered:hover {
      background-color: #218838;
    }
    .btn-cancel {
      background-color: #dc3545;
      color: #fff;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-cancel:hover {
      background-color: #c82333;
    }
    .btn-view {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    .btn-view:hover {
      background-color: #0069d9;
      color: #fff;
    }
  </style>
</head>
<body class="container">

  <h1 class="mb-4 text-center">All Orders</h1>

  <div id="ordersContainer">
  <?php if ($result->num_rows > 0): ?>
    <?php while ($order = $result->fetch_assoc()): ?>
      <?php
        $cart_items = json_decode($order['cart_items'], true);
        $statusClass = '';
        if ($order['status'] == 'pending') $statusClass = 'status-pending';
        elseif ($order['status'] == 'delivered') $statusClass = 'status-delivered';
        elseif ($order['status'] == 'cancelled') $statusClass = 'status-cancelled';

        $grand_total = 0;
        if(is_array($cart_items)){
          foreach ($cart_items as $p) {
            $grand_total += $p['price'] * $p['quantity'];
          }
        }
        $total_amount = $grand_total + floatval($order['delivery_charge']);
      ?>
      <div class="order-card" data-order-id="<?php echo $order['id']; ?>">
        <div class="order-header">
          <h4>Order #<?php echo $order['id']; ?> <small>(<?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?>)</small></h4>
          <span class="status-badge <?php echo $statusClass; ?>"><?php echo ucfirst($order['status']); ?></span>
        </div>

        <h5>Customer Information</h5>
        <ul class="list-group mb-3">
          <li class="list-group-item"><strong>Full Name:</strong> <?php echo htmlspecialchars($order['full_name']); ?></li>
          <li class="list-group-item"><strong>Mobile:</strong> <?php echo htmlspecialchars($order['mobile']); ?></li>
          <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></li>
          <li class="list-group-item"><strong>City:</strong> <?php echo htmlspecialchars($order['city']); ?></li>
          <li class="list-group-item"><strong>Zone:</strong> <?php echo htmlspecialchars($order['zone']); ?></li>
          <li class="list-group-item"><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($order['address'])); ?></li>
        </ul>

        <h5>Delivery & Payment</h5>
        <ul class="list-group mb-3">
          <li class="list-group-item"><strong>Delivery Method:</strong> <?php echo htmlspecialchars($order['delivery_method']); ?></li>
          <li class="list-group-item"><strong>Delivery Charge:</strong> ৳<?php echo number_format($order['delivery_charge'], 2); ?></li>
          <li class="list-group-item"><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></li>
          <?php if ($order['payment_method'] === 'Online Payment'): ?>
            <li class="list-group-item"><strong>Payment Gateway:</strong> <?php echo htmlspecialchars($order['payment_gateway']); ?></li>
            <li class="list-group-item"><strong>Last 4 Digits:</strong> <?php echo htmlspecialchars($order['last_4_digits']); ?></li>
            <li class="list-group-item"><strong>Amount Sent:</strong> ৳<?php echo number_format($order['amount_sent'], 2); ?></li>
          <?php endif; ?>
        </ul>

        <h5>Ordered Products</h5>
        <?php if (!empty($cart_items) && is_array($cart_items)): ?>
          <?php foreach ($cart_items as $product): ?>
            <div class="product-card">
              <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
              <div class="product-info">
                <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                <p>Price: ৳<?php echo number_format($product['price'], 2); ?> × Quantity: <?php echo $product['quantity']; ?></p>
                <p><strong>Subtotal: ৳<?php echo number_format($product['price'] * $product['quantity'], 2); ?></strong></p>
              </div>
            </div>
          <?php endforeach; ?>
          <h6 class="mt-3">Grand Total (Products): ৳<?php echo number_format($grand_total, 2); ?></h6>
          <h6>Delivery Charge: ৳<?php echo number_format($order['delivery_charge'], 2); ?></h6>
          <h5>Total Amount: ৳<?php echo number_format($total_amount, 2); ?></h5>
        <?php else: ?>
          <p>No products found in this order.</p>
        <?php endif; ?>

        <div class="btn-group">
          <?php if ($order['status'] === 'pending'): ?>
            <button class="btn-delivered" data-action="done" data-id="<?php echo $order['id']; ?>">Done</button>
            <button class="btn-cancel" data-action="cancel" data-id="<?php echo $order['id']; ?>">Cancel</button>
          <?php else: ?>
            <span class="text-success fw-semibold">Order <?php echo ucfirst($order['status']); ?></span>
          <?php endif; ?>

          <a href="view_invoice.php?order_id=<?php echo $order['id']; ?>" class="btn-view" target="_blank" rel="noopener noreferrer">View Invoice</a>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-center">No orders found.</p>
  <?php endif; ?>
  </div>

<script>
  document.querySelectorAll('.btn-delivered, .btn-cancel').forEach(button => {
    button.addEventListener('click', function() {
      const orderId = this.getAttribute('data-id');
      const action = this.getAttribute('data-action');

      if (action === 'cancel') {
        if (!confirm('Are you sure you want to cancel this order?')) return;
      }

      fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `action=${action}&order_id=${orderId}`
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          if (action === 'cancel') {
            // Remove the order card from DOM
            const card = document.querySelector(`.order-card[data-order-id="${orderId}"]`);
            if(card) card.remove();
          } else if (action === 'done') {
            // Change status badge and hide buttons
            const card = document.querySelector(`.order-card[data-order-id="${orderId}"]`);
            if(card){
              const badge = card.querySelector('.status-badge');
              badge.textContent = 'Delivered';
              badge.className = 'status-badge status-delivered';
              const btnGroup = card.querySelector('.btn-group');
              btnGroup.innerHTML = '<span class="text-success fw-semibold">Order Delivered</span><a href="view_invoice.php?order_id=' + orderId + '" class="btn-view" target="_blank" rel="noopener noreferrer">View Invoice</a>';
            }
          }
        }
      })
      .catch(err => alert('Error: ' + err));
    });
  });
</script>

</body>
</html>

<?php
$conn->close();
?>
