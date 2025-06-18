<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Flex Product Layout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .section {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-bottom: 30px;
      padding: 0 15px;
    }
    
    /* ডেস্কটপ ভিউ (1024px+) */
    @media (min-width: 1024px) {
      .section {
        flex-direction: row;
      }
      .sidebar, .rightbar {
        flex: 0 0 20%;
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
      .main {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
      }
    }
    
    /* ট্যাবলেট ভিউ (768px-1023px) */
    @media (min-width: 768px) and (max-width: 1023px) {
      .rightbar {
        order: 1;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
      }
      .main {
        order: 2;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
      }
      .sidebar {
        order: 3;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
      }
    }
    
    /* মোবাইল ভিউ (767px নিচে) */
    @media (max-width: 767px) {
      .rightbar, .main, .sidebar {
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
    }

    .product-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    .product-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-bottom: 1px solid #eee;
    }
    
    .product-card .content {
      padding: 15px;
    }
    
    .product-card .content h5 {
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }
    
    .product-card .content p {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 10px;
    }
    
    .product-card .price {
      font-weight: 700;
      margin-bottom: 12px;
    }
    
    .product-card .current-price {
      color: #28a745;
      font-size: 1.1rem;
    }
    
    .product-card .old-price {
      color: #999;
      text-decoration: line-through;
      font-size: 0.9rem;
      margin-left: 8px;
    }
    
    .product-card .content .btn {
      background: linear-gradient(135deg, #007bff, #00c6ff);
      color: #fff;
      border: none;
      border-radius: 30px;
      padding: 6px 20px;
    }
    
    .product-card .btn:hover {
      background: linear-gradient(135deg, #0069d9, #0097e6);
    }
  </style>
</head>
<body>

<?php
$connect = new mysqli("localhost", "root", "", "shopping");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// সব প্রোডাক্ট একসাথে আনবো
$productQuery = "SELECT * FROM product";
$productResult = $connect->query($productQuery);

// Leftbar এর জন্য limit দিয়ে আলাদা করবো
$leftbarQuery = "SELECT * FROM product LIMIT 6";
$leftResult = $connect->query($leftbarQuery);

// Rightbar এর জন্য শেষে থেকে 6টা আনবো
$rightbarQuery = "SELECT * FROM product ORDER BY p_name ASC LIMIT 6";

$rightResult = $connect->query($rightbarQuery);
?>

<div class="section">

   <!-- ডান সাইডবার -->
   <div class="rightbar">
      <?php if(!empty($rightbar_products)): ?>
        <?php foreach($rightbar_products as $product): ?>
          <div class="product-card">
            <img src="<?php echo htmlspecialchars($product['img_file']); ?>" alt="<?php echo htmlspecialchars($product['p_name']); ?>">
            <div class="content">
              <h5><?php echo htmlspecialchars($product['p_name']); ?></h5>
              <p><?php echo htmlspecialchars($product['desc']); ?></p>
              <div class="price">
                <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
                <?php if($product['o_price'] > 0): ?>
                  <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
                <?php endif; ?>
              </div>
              <button class="btn">দেখুন</button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- ডিফল্ট ডাটা যদি ডাটাবেসে কিছু না থাকে -->
        <?php for($i=1; $i<=6; $i++): ?>
          <div class="product-card">
            <img src="https://via.placeholder.com/300x200?text=Side+Product+<?php echo $i; ?>" alt="Side Product <?php echo $i; ?>">
            <div class="content">
              <h5>সাইড প্রোডাক্ট <?php echo $i; ?></h5>
              <p>এটি সাইড প্রোডাক্টের সংক্ষিপ্ত বর্ণনা</p>
              <div class="price">
                <span class="current-price">৳<?php echo number_format(rand(800, 3000), 2); ?></span>
                <span class="old-price">৳<?php echo number_format(rand(3500, 6000), 2); ?></span>
              </div>
              <button class="btn">দেখুন</button>
            </div>
          </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>

  <!-- Main Center Cards -->
  <div class="main center-cards">
    <?php if ($productResult->num_rows > 0): ?>
      <?php while($row = $productResult->fetch_assoc()): ?>
        <div class="product-card">
          <img src="uploads/<?= $row['img_file'] ?>" alt="<?= $row['p_name'] ?>">
          <div class="content">
            <h5><?= $row['p_name'] ?></h5>
            <p><?= $row['desc'] ?></p>
            <div class="price">৳<?= $row['r_price'] ?></div>
            <button class="btn btn-sm">Add to Cart</button>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

  <!-- Left Sidebar -->
  <div class="sidebar">
    <?php if ($leftResult->num_rows > 0): ?>
      <?php while($row = $leftResult->fetch_assoc()): ?>
        <div class="product-card">
          <img src="uploads/<?= $row['img_file'] ?>" alt="<?= $row['p_name'] ?>">
          <div class="content">
            <h5><?= $row['p_name'] ?></h5>
            <p><?= $row['desc'] ?></p>
            <div class="price">৳<?= $row['r_price'] ?></div>
            <button class="btn btn-sm">Buy Now</button>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
