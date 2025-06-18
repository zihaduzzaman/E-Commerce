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

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    #carticon{
      cursor: pointer;
    }
    .nav-itemm {
      display: flex;
    }
    .cart-icon {
    font-size: 32px !important;
    color: #fff !important;
    } 


    .nav-itemm span{
      display: flex;
      width: 30px;
      height: 30px;
      background-color: #23aae2;
      align-items: center;
      justify-content: center;
      color: #fff;
      border-radius: 50%;
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
      height: 340px; /* নতুন height */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
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
    
    
/*  */

.rightt-product-card {
  display: flex;
  gap: 15px;
  align-items: center;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 15px;
  margin-bottom: 20px;
  transition: box-shadow 0.3s;
}

.rightt-product-card:hover {
  box-shadow: 0 6px 15px rgba(0,0,0,0.12);
}

/* Image part */
.rightt-product-card .image-content {
  width: 120px;
  height: 120px;
  flex-shrink: 0;
  overflow: hidden;
  border-radius: 8px;
}

.rightt-product-card .image-content img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Text part */
.rightt-product-card .text-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.rightt-product-card .text-content h5 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 6px;
  color: #333;
}

.rightt-product-card .text-content p {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 8px;
  line-height: 1.4;
}

.rightt-product-card .text-content .current-price {
  font-size: 1rem;
  color: #28a745;
  font-weight: bold;
}

.rightt-product-card .text-content .old-price {
  font-size: 0.9rem;
  color: #999;
  text-decoration: line-through;
  margin-left: 10px;
}

.rightt-product-card .text-content .btn {
  margin-top: 10px;
  padding: 6px 16px;
  font-size: 0.85rem;
  background: linear-gradient(135deg, #007bff, #00c6ff);
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  transition: background 0.3s;
  width: fit-content;
}

.sidebar .product-card,
.rightt-product-card .text-content .btn:hover {
  background: linear-gradient(135deg, #0069d9, #0097e6);
}
.rightt-product-card .text-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    order: 2;
}
/* left */
.leftt-product-card {
  display: flex;
  gap: 15px;
  align-items: center;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  padding: 15px;
  margin-bottom: 20px;
  transition: box-shadow 0.3s;
}

.leftt-product-card:hover {
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.leftt-product-card img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 10px;
  flex-shrink: 0;
}

.leftt-product-card .content {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.leftt-product-card .content h5 {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 6px;
  color: #333;
}

.leftt-product-card .content p {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 8px;
  line-height: 1.4;
}

.leftt-product-card .price {
  font-weight: bold;
  margin-bottom: 8px;
}

.leftt-product-card .current-price {
  font-size: 1rem;
  color: #28a745;
}

.leftt-product-card .old-price {
  font-size: 0.9rem;
  color: #999;
  text-decoration: line-through;
  margin-left: 10px;
}

.leftt-product-card .btn {
  margin-top: 5px;
  padding: 6px 16px;
  font-size: 0.85rem;
  background: linear-gradient(135deg, #007bff, #00c6ff);
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  width: fit-content;
  transition: background 0.3s;
}

.leftt-product-card .btn:hover {
  background: linear-gradient(135deg, #0069d9, #0097e6);
}

.leftt-product-card .text-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    order: 2;
}
.cart-section {
  width: 400px;
  height: 100vh;
  background-color: #02143a;
  color: #eee;
  position: fixed;
  top: 0;
  right: 0;
  display: grid;
  grid-template-rows: 70px 1fr 70px;
  z-index: 10;

  /* ডান পাশে লুকানো অবস্থায় সরানো */
  transform: translateX(100%);
  transition: transform 0.4s ease;
  pointer-events: none; /* হাইড অবস্থায় ক্লিক ব্লক */
  opacity: 0;
}

.cart-section.active {
  transform: translateX(0); /* স্ক্রিনে দেখা যাবে */
  pointer-events: auto;
  opacity: 1;
}



.cart-section .item{
border: 1px solid #ccc;
border-radius: 15px;
}

.cart-section h3 {
  padding: 20px;
  margin: 0;
  color: #fff;
  text-align: center;
}

.cart-section .listcart {
  overflow-y: auto;
}

.cart-section .listcart .item {
  display: grid;
  grid-template-columns: 70px 1fr 57px 100px;;
  gap: 10px;
  color: #fff;
  align-items: center;
  padding: 10px;
}

.cart-section .listcart .item:nth-child(even) {
  background-color: #2f2f2f;
}
.cart-section .listcart .item:nth-child(odd) {
  background-color: #3c3c3c;
}

.cart-section .listcart .item img {
  width: 100%;
  height: auto;
}

.cart-section .qti span {
  display: inline-block;
  width: 25px;
  height: 25px;
  background-color: #fff;
  color: #555;
  border-radius: 50%;
  cursor: pointer;
  line-height: 25px;
  text-align: center;
  font-weight: bold;
}
.cart-section .qti span:nth-child(2) {
  background-color: transparent;
  color: #eee;
}

.cart-section .buttn {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.cart-section .buttn button {
  margin: 10px;
  padding: 10px 20px;
  background: linear-gradient(135deg, #007bff, #00c6ff);
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  transition: background 0.3s;
}
.cart-section .listcart{
  overflow-y: auto;
  padding: 10px;
}
.cart{
  background-color: #008fff;
}
.listcart .item h4{
  margin-top: 0;
    margin-bottom: -0.5rem;
    font-weight: 500;
    line-height: 1.2;
}




    
  </style>

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
<body>

<?php
// ডাটাবেস কানেকশন
$servername = "localhost";
$username = "root";      // XAMPP ডিফল্ট ইউজারনেম
$password = "";          // XAMPP ডিফল্ট পাসওয়ার্ড
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
    
    // বাম সাইডবারের প্রোডাক্ট (৬টি)
    $sidebar_products = [];
    $sql = "SELECT p_name, r_price, o_price, `desc`, img_file FROM product LIMIT 6";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sidebar_products[] = $row;
        }
    }
    
    // মেইন প্রোডাক্ট (১৬টি)
    $main_products = [];
    $sql = "SELECT p_name, r_price, o_price, `desc`, img_file FROM product LIMIT 16";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $main_products[] = $row;
        }
    }
    
    // ডান সাইডবারের প্রোডাক্ট (৬টি র‍্যান্ডম)
    $rightbar_products = [];
    $sql = "SELECT p_name, r_price, o_price, `desc`, img_file FROM product ORDER BY RAND() LIMIT 6";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rightbar_products[] = $row;
        }
    }
    
    $conn->close();
    
} catch (Exception $e) {
    // এরর হ্যান্ডলিং
    echo "<div class='alert alert-danger m-3'>Error: " . $e->getMessage() . "</div>";
    // ডিফল্ট ডাটা সেট করুন
    $sidebar_products = $main_products = $rightbar_products = [];
}
?>

<div class="container-fluid py-4">
  <div class="section">
    <!-- বাম সাইডবার -->
    <div class="sidebar">
  <?php if(!empty($sidebar_products)): ?>
    <?php foreach($sidebar_products as $product): ?>
<!--  -->

<div class="rightt-product-card">
  <div class="text-content">
    <h5><?php echo htmlspecialchars($product['p_name']); ?></h5>
    <p><?php echo htmlspecialchars($product['desc']); ?></p>
    <div>
      <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
      <?php if($product['o_price'] > 0): ?>
        <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
      <?php endif; ?>
    </div>
    <button class="btn">অর্ডার করুন</button>
  </div>
  <div class="image-content">
    <img src="<?php 
      $imagePath = 'uploads/' . $product['img_file'];
      echo file_exists($imagePath) ? $imagePath : 'assets/img/no-image.png'; 
    ?>" alt="<?php echo htmlspecialchars($product['p_name']); ?>">
  </div>
</div>



<!--  -->
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
          <button class="btn">অর্ডার করুন</button>
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
          <p><?php echo htmlspecialchars($product['desc']); ?></p>
          <div class="price">
            <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
            <?php if($product['o_price'] > 0): ?>
              <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
            <?php endif; ?>
          </div>
          <button class="btn">কার্টে যোগ করুন</button>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <!-- ডিফল্ট ডাটা -->
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
          <button class="btn">কার্টে যোগ করুন</button>
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
    <p><?php echo htmlspecialchars($product['desc']); ?></p>

    <div class="price">
      <span class="current-price">৳<?php echo number_format($product['r_price'], 2); ?></span>
      <?php if ($product['o_price'] > 0): ?>
        <span class="old-price">৳<?php echo number_format($product['o_price'], 2); ?></span>
      <?php endif; ?>
    </div>

    <button class="btn">দেখুন</button>
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

  <div class="listcart">
    <div class="item">
      <div class="image"><img src="show3.jpg" alt=""></div>
      <div class="name"><h4 style="font-size: 18px;">NAME</h4></div>
      <div class="pprice">$200</div>
      <div class="qti">
        <span class="minus">&lt;</span>
        <span>1</span>
        <span class="plus">&gt;</span>
      </div>
    </div>

    <!-- Repeat .item as needed -->
  </div>

  <div id="buttn" class="buttn">
    <button class="btns">CLOSE</button>
    <button class="btns">CHECK Out</button>
  </div>
</div>



</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const toggleCartBtn = document.getElementById("cartToggle");
  const cartSection = document.getElementById("cartSection");
  const closeCartBtn = document.querySelector(".cart-section .buttn button:first-child");

  // Toggle cart visibility
  toggleCartBtn.addEventListener("click", function(e) {
    e.preventDefault(); // Prevent default anchor behavior
    e.stopPropagation(); // Stop event bubbling
    cartSection.classList.toggle("active");
  });

  // Close cart when clicking the close button
  closeCartBtn.addEventListener("click", function(e) {
    e.preventDefault();
    e.stopPropagation();
    cartSection.classList.remove("active");
  });

  // Close cart when clicking outside
  document.addEventListener("click", function(e) {
    if (!cartSection.contains(e.target) && e.target !== toggleCartBtn) {
      cartSection.classList.remove("active");
    }
  });
});



document.addEventListener("DOMContentLoaded", function () {
  const cartButton = document.getElementById("buttn");

  // Fix the position dynamically
  cartButton.style.position = "fixed";
  cartButton.style.bottom = "0";

  cartButton.style.width = "400px";
  cartButton.style.display = "grid";
  cartButton.style.gridTemplateColumns = "repeat(2, 1fr)";
  cartButton.style.padding = "15px";
  cartButton.style.gap = "10px";
});













</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
