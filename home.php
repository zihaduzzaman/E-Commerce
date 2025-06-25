<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Smoother Sliding Carousel</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="home.css">

</head>
<body>

<!-- Header Start -->
<!-- Header -->
<div class="header">
  <div class="container-fluid">
    <div id="subheader" class="row align-items-center">
      <!-- Logo -->
      <div class="col-lg-2 col-4 logo">
        <img src="https://i.ibb.co/WG8pVD8/startech.png" alt="Logo" class="img-fluid">
      </div>

      <!-- Search Bar -->
      <div class="col-lg-4 col-8">
        <div class="search-box">
          <input type="text" placeholder="Search">
          <i class="bi bi-search"></i>
        </div>
      </div>

      <!-- Menu Items -->
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="d-flex align-items-center">
          <div class="nav-itemm">
            <a href=""><i id="cartToggle" class="bi bi-cart cart-icon text-danger fs-5"></i></a>
            <span>0</span>
          </div>
        
          <div class="nav-item">
            <i class="bi bi-person-circle text-danger fs-5"></i><br>
            Account <br><small>Register or Login</small>
          </div>
        </div>
      </div>

      <!-- PC Builder Button -->
      <div class="col-lg-2 d-none d-lg-block text-end">
        <button class="pc-builder-btn">PC Builder</button>
      </div>
    </div>
  </div>
</div>
<!-- Header End -->

  <!-- Carousel -->
  <div id="carouselExample" class="carousel slide " data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="a.jpg" class="d-block w-100" alt="Slide 1" />
        <div class="carousel-caption">
          <h5>First Slide Label</h5>
          <p>Beautiful and centered content with smooth sliding animation.</p>
          <button class="btn">Learn More</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="b.jpg" class="d-block w-100" alt="Slide 2" />
        <div class="carousel-caption">
          <h5>Second Slide Label</h5>
          <p>Experience the smooth left to right sliding.</p>
          <button class="btn">Learn More</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="c.jpg" class="d-block w-100" alt="Slide 3" />
        <div class="carousel-caption">
          <h5>Third Slide Label</h5>
          <p>Fully responsive and modern carousel layout.</p>
          <button class="btn">Learn More</button>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

<h2 class="text-center mt-3">Letest Product</h2>

<?php
// ডাটাবেস কানেকশন
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

try {
    // MySQLi দিয়ে কানেকশন
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // কানেকশন এরর চেক
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // ক্যারেক্টার সেট UTF-8
    $conn->set_charset("utf8");

    // ক্যাটাগরি প্যারামিটার
    $category_filter = isset($_GET['category']) ? $_GET['category'] : '';
    $category_sql = "";

    if (!empty($category_filter)) {
        $category_safe = $conn->real_escape_string($category_filter);
        $category_sql = " WHERE category = '$category_safe' ";
    }
    
    // বাম সাইডবারের প্রোডাক্ট (৬টি)
    $sidebar_products = [];
    $sql = "SELECT p_name, r_price, o_price, `desc`, img_file FROM product $category_sql LIMIT 6";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sidebar_products[] = $row;
        }
    }
    
    // মেইন প্রোডাক্ট (১৬টি)
    $main_products = [];
    $sql = "SELECT p_name, r_price, o_price, `desc`, img_file FROM product $category_sql LIMIT 12";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $main_products[] = $row;
        }
    }
    
    // ডান সাইডবারের প্রোডাক্ট (৬টি র‍্যান্ডম)
    $rightbar_products = [];
    $sql = "SELECT p_name, r_price, o_price, `desc`, img_file FROM product $category_sql ORDER BY RAND() LIMIT 6";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rightbar_products[] = $row;
        }
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<div class='alert alert-danger m-3'>Error: " . $e->getMessage() . "</div>";
    $sidebar_products = $main_products = $rightbar_products = [];
}
?>

<div class="container-fluid py-4">
  <div class="section">
    <!-- বাম সাইডবার -->
    <div class="sidebar">
  <?php if(!empty($sidebar_products)): ?>
    <?php foreach($sidebar_products as $product): ?>
<div class="rightt-product-card">
  <div class="text-content">
    <h5><?php echo htmlspecialchars($product['p_name']); ?></h5>
    <p>
  <?php
    $desc = htmlspecialchars($product['desc']);
    echo strlen($desc) > 30 ? substr($desc, 0, 30) . '...' : $desc;
  ?>
</p>
    <div>
      <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
      <?php if($product['o_price'] > 0): ?>
        <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
      <?php endif; ?>
    </div>
    <button class="btn" id="orderButton">অর্ডার করুন</button>
  </div>
  <div class="image-content">
    <img src="<?php 
      $imagePath = 'uploads/' . $product['img_file'];
      echo file_exists($imagePath) ? $imagePath : 'assets/img/no-image.png'; 
    ?>" alt="<?php echo htmlspecialchars($product['p_name']); ?>">
  </div>
</div>
    <?php endforeach; ?>
  <?php else: ?>
    <?php for($i=1; $i<=6; $i++): ?>
      <div class="product-card">
        <img src="https://via.placeholder.com/300x200?text=Product+<?php echo $i; ?>" alt="Product <?php echo $i; ?>">
        <div class="content">
          <h5>প্রোডাক্ট <?php echo $i; ?></h5>
          <p>এটি একটি স্যাম্পল প্রোডাক্ট বর্ণনা</p>
          <div class="price">
            <span class="current-price">৳<?php echo number_format(rand(500, 2000), 2); ?></span>
            <span class="old-price">৳<?php echo number_format(rand(2500, 4000), 2); ?></span>
          </div>
          <button class="btn" id="orderButton">অর্ডার করুন</button>
        </div>
      </div>
    <?php endfor; ?>
  <?php endif; ?>
</div>

    <!-- মেইন কন্টেন্ট -->
    <div class="main">
  <?php if(!empty($main_products)): ?>
    <?php foreach($main_products as $product): ?>
      <div class="product-card">
        <img src="<?php 
          $imagePath = 'uploads/' . $product['img_file'];
          echo file_exists($imagePath) ? $imagePath : 'assets/img/no-image.png'; 
        ?>" alt="<?php echo htmlspecialchars($product['p_name']); ?>">
        
        <div class="content">
          <h5><?php echo htmlspecialchars($product['p_name']); ?></h5>
          <p>
            <?php
              $desc = htmlspecialchars($product['desc']);
              echo strlen($desc) > 30 ? substr($desc, 0, 30) . '...' : $desc;
            ?>
          </p>

          <div class="price">
            <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
            <?php if($product['o_price'] > 0): ?>
              <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
            <?php endif; ?>
          </div>
          <button class="btn" id="cartnow">কার্টে যোগ করুন</button>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <?php for($i=1; $i<=16; $i++): ?>
      <div class="product-card">
        <img src="https://via.placeholder.com/300x200?text=Main+Product+<?php echo $i; ?>" alt="Main Product <?php echo $i; ?>">
        <div class="content">
          <h5>মেইন প্রোডাক্ট <?php echo $i; ?></h5>
          <p>এটি মেইন প্রোডাক্টের বিস্তারিত বর্ণনা। প্রোডাক্টের ফিচার এবং স্পেসিফিকেশন এখানে লিখুন।</p>
          <div class="price">
            <span class="current-price">৳<?php echo number_format(rand(1000, 5000), 2); ?></span>
            <span class="old-price">৳<?php echo number_format(rand(6000, 10000), 2); ?></span>
          </div>
          <button id="cartnow" class="btn" id="cartnow">কার্টে যোগ করুন</button>
        </div>
      </div>
    <?php endfor; ?>
  <?php endif; ?>
</div>

    <!-- ডান সাইডবার -->
    <div class="rightbar">
  <?php if(!empty($rightbar_products)): ?>
    <?php foreach($rightbar_products as $product): ?>
      <div class="leftt-product-card">
  <!-- Product Image -->
  <img src="<?php 
    $imagePath = 'uploads/' . $product['img_file'];
    echo file_exists($imagePath) ? $imagePath : 'assets/img/no-image.png'; 
  ?>" alt="<?php echo htmlspecialchars($product['p_name']); ?>">

  <!-- Product Content -->
  <div class="content">
    <h5><?php echo htmlspecialchars($product['p_name']); ?></h5>
    <p>
  <?php
    $desc = htmlspecialchars($product['desc']);
    echo strlen($desc) > 30 ? substr($desc, 0, 30) . '...' : $desc;
  ?>
</p>


    <div class="price">
      <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
      <?php if ($product['o_price'] > 0): ?>
        <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
      <?php endif; ?>
    </div>

    <button class="btn" id="view">দেখুন</button>
  </div>
</div>

    <?php endforeach; ?>
  <?php else: ?>
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
</div>

<div id="cartSection" class="cart-section">
  <div class="cart">
    <h3>Shopping Cart</h3>
  </div>

  <div class="listcart" id="listcart">
  <div id="items" class="item">

  </div>
</div>

<!-- Footer should be outside .listcart so it doesn't move -->
<div class="footer" id="cartFooter">
  <div class="foot">
    <h3>Total</h3>
    <h3 id="total">0.00</h3>
  </div>
  <div id="buttn" class="buttn">
  <button id="closeBtn" class="btns">CLOSE</button>
  <button id="checkoutBtn" class="btns"><a href="index.php">CHECK Out</a></button>
</div>

</div>

  
</div></div>
<script src="home.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
