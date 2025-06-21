<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 10px;
      margin-bottom: 15px;
      background-color: #f9f9f9;
    }
    .product-card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
    }
    .product-details h5 {
      margin: 0;
    }
    .section-title {
      margin-top: 40px;
      border-bottom: 2px solid #0088cc;
      padding-bottom: 5px;
    }
    .total-summary {
      font-weight: bold;
      font-size: 18px;
      margin-top: 10px;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body class="container py-4">

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = new mysqli("localhost", "root", "", "shopping");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  function clean($conn, $val) {
    return $conn->real_escape_string(trim($val));
  }

  $name       = clean($conn, $_POST['name']);
  $mobile     = clean($conn, $_POST['mobile']);
  $email      = clean($conn, $_POST['email']);
  $city       = clean($conn, $_POST['city']);
  $zone       = clean($conn, $_POST['zone']);
  $address    = clean($conn, $_POST['address']);
  $delivery   = clean($conn, $_POST['delivery']);
  $payment    = clean($conn, $_POST['payment']);
  $gateway    = isset($_POST['gateway']) ? clean($conn, $_POST['gateway']) : '';
  $last4      = isset($_POST['last4']) ? clean($conn, $_POST['last4']) : '';
  $amountSent = isset($_POST['amountSent']) ? (float)$_POST['amountSent'] : 0;

  $cartItemsJson = $_POST['cartItems'];
  $cartItems = json_decode($cartItemsJson, true);

  $total = 0;
  foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
  }

  $deliveryCharge = 0;
  if (strpos($delivery, '60') !== false) $deliveryCharge = 60;
  elseif (strpos($delivery, '300') !== false) $deliveryCharge = 300;

  $finalTotal = $total + $deliveryCharge;
  $cartEncoded = $conn->real_escape_string($cartItemsJson);

  $sql = "INSERT INTO orders (
    full_name, mobile, email, city, zone, address,
    delivery_method, delivery_charge, payment_method,
    payment_gateway, last_4_digits, amount_sent,
    cart_items, total_amount
  ) VALUES (
    '$name', '$mobile', '$email', '$city', '$zone', '$address',
    '$delivery', $deliveryCharge, '$payment',
    '$gateway', '$last4', $amountSent,
    '$cartEncoded', $finalTotal
  )";

  if ($conn->query($sql)) {
    echo "<script>
      localStorage.removeItem('checkoutItems');
      alert('✅ Order Confirmed!');
      window.location = 'index.php';
    </script>";
  } else {
    echo "<script>alert('❌ Order Failed: {$conn->error}');</script>";
  }

  $conn->close();
}
?>

<h2 class="mb-4">Checkout Summary</h2>
<div id="checkoutItems"></div>
<div class="total-summary" id="totalSummary"></div>

<!-- Customer Information -->
<h4 class="section-title">Customer Information</h4>
<form id="orderForm" method="post" action="">
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Mobile</label>
      <input type="text" name="mobile" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">City</label>
      <input type="text" name="city" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Zone</label>
      <input type="text" name="zone" class="form-control">
    </div>
    <div class="col-12">
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control" required></textarea>
    </div>
  </div>

  <!-- Delivery Method -->
  <h4 class="section-title">Delivery Method</h4>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="delivery" value="Home Delivery - 60৳" checked>
    <label class="form-check-label">Home Delivery - 60৳</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="delivery" value="Store Pickup - 0৳">
    <label class="form-check-label">Store Pickup - 0৳</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="delivery" value="Request Express - 300৳">
    <label class="form-check-label">Request Express - 300৳</label>
  </div>

  <!-- Payment Method -->
  <h4 class="section-title">Payment Method</h4>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="payment" value="Cash on Delivery" checked>
    <label class="form-check-label">Cash on Delivery</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="payment" value="Online Payment" id="onlinePay">
    <label class="form-check-label">Online Payment</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="payment" value="POS on Delivery">
    <label class="form-check-label">POS on Delivery</label>
  </div>

  <!-- Online Payment Options -->
  <div id="onlineOptions" class="hidden mt-3">
    <label class="form-label">Select Payment Gateway:</label>
    <select class="form-select mb-2" name="gateway">
      <option value="Bkash">Bkash</option>
      <option value="Nagad">Nagad</option>
      <option value="Rocket">Rocket</option>
      <option value="Upay">Upay</option>
      <option value="Bank">Bank Account</option>
    </select>
    <label class="form-label">Last 4 Digits of Sender Account</label>
    <input type="text" name="last4" class="form-control" maxlength="4">
    <label class="form-label mt-2">Amount Sent (৳)</label>
    <input type="number" name="amountSent" class="form-control">
  </div>

  <input type="hidden" name="cartItems" id="cartItems">
  <button type="submit" class="btn btn-success mt-4">Submit Order</button>
</form>

<div class="alert alert-success mt-4 d-none" id="successMsg">
  ✅ Order confirmed! Thank you for shopping with us.
</div>

<script>
  const items = JSON.parse(localStorage.getItem('checkoutItems')) || [];
  const checkoutDiv = document.getElementById('checkoutItems');
  let total = 0;

  items.forEach(item => {
    const productHTML = `
      <div class="product-card">
        <img src="${item.image}" alt="${item.name}"/>
        <div class="product-details">
          <h5>${item.name}</h5>
          <p>Price: ৳${item.price} × ${item.quantity} = ৳${(item.price * item.quantity).toFixed(2)}</p>
        </div>
      </div>
    `;
    total += item.price * item.quantity;
    checkoutDiv.insertAdjacentHTML('beforeend', productHTML);
  });

  document.getElementById('totalSummary').textContent = `Total: ৳${total.toFixed(2)}`;

  document.getElementById('onlinePay').addEventListener('change', function () {
    document.getElementById('onlineOptions').classList.remove('hidden');
  });

  document.querySelectorAll('input[name="payment"]').forEach(radio => {
    radio.addEventListener('change', () => {
      if (document.getElementById('onlinePay').checked) {
        document.getElementById('onlineOptions').classList.remove('hidden');
      } else {
        document.getElementById('onlineOptions').classList.add('hidden');
      }
    });
  });

  document.getElementById('orderForm').addEventListener('submit', function(e) {
    document.getElementById('cartItems').value = JSON.stringify(items);
  });
</script>

</body>
</html>