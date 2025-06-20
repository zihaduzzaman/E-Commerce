<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      padding: 20px;
    }
    .product-summary {
      border-bottom: 1px solid #ccc;
      margin-bottom: 10px;
      padding-bottom: 10px;
    }
    .checkout-form {
      margin-top: 30px;
    }
    .order-confirmed {
      padding: 20px;
      background-color: #e6ffee;
      border: 1px solid #88cc88;
      border-radius: 5px;
      margin-top: 20px;
      display: none;
    }
  </style>
</head>
<body>

  <h2 class="mb-4">🛒 আপনার অর্ডার সারাংশ</h2>
  <div id="checkoutItems"></div>

  <div class="checkout-form">
    <h4>📝 ইউজার ইনফরমেশন</h4>
    <form id="orderForm">
      <div class="mb-3">
        <label class="form-label">আপনার নাম</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">মোবাইল নাম্বার</label>
        <input type="text" name="mobile" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">ঠিকানা</label>
        <textarea name="address" class="form-control" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary">✅ Order Confirm করুন</button>
    </form>
  </div>

  <div id="orderConfirmed" class="order-confirmed">
    <h5>🎉 অর্ডার কনফার্ম হয়েছে!</h5>
    <p>আমরা খুব শীঘ্রই আপনার সাথে যোগাযোগ করবো।</p>
  </div>

  <script>
    // লোকাল স্টোরেজ থেকে কার্ট আইটেমগুলো নিয়ে দেখানো
    const checkoutItems = JSON.parse(localStorage.getItem('checkoutItems')) || [];
    const container = document.getElementById('checkoutItems');

    if (checkoutItems.length === 0) {
      container.innerHTML = '<p>🛍️ আপনার কার্ট খালি!</p>';
      document.querySelector('.checkout-form').style.display = 'none';
    } else {
      checkoutItems.forEach(item => {
        const div = document.createElement('div');
        div.className = 'product-summary';
        div.innerHTML = `
          <strong>${item.name}</strong> <br>
          দাম: ৳${item.price} × ${item.quantity} = <strong>৳${(item.price * item.quantity).toFixed(2)}</strong>
        `;
        container.appendChild(div);
      });
    }

    // ফর্ম সাবমিট করে অর্ডার প্রসেস
    document.getElementById('orderForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      const orderData = {
        name: formData.get('name'),
        mobile: formData.get('mobile'),
        address: formData.get('address'),
        items: checkoutItems
      };

      // এখানে চাইলে AJAX দিয়ে সার্ভারে পাঠাতে পারো

      console.log("✅ অর্ডার কনফার্ম:", orderData);

      // লোকাল স্টোরেজ ক্লিয়ার
      localStorage.removeItem('checkoutItems');

      // Success message দেখাও
      document.getElementById('orderForm').reset();
      document.getElementById('orderConfirmed').style.display = 'block';
      document.getElementById('checkoutItems').innerHTML = '';
      document.querySelector('.checkout-form').style.display = 'none';
    });
  </script>

</body>
</html>
