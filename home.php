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
.category-container {
  margin: 20px auto;
  padding: 0 15px;
  display: flex;
  flex-direction: column;
  align-items: center;  /* এটা ঠিক আছে, এটা কন্টেইনারের আইটেমগুলোকে সেন্টারে রাখে */
  /* text-align: center;  এখানে এটা সরিয়ে দিন */
}

.category-header {
  display: flex;
  justify-content: center; 
  align-items: center;
  flex-direction: column;   stack title and view-all vertically
  margin-bottom: 15px;
}

.category-header h2 {
  margin: 0 0 10px;
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
}

.view-all {
  display: flex;
  align-items: center;
  gap: 5px;
  cursor: pointer;
  color: #4a6bff;
  font-weight: 500;
  transition: color 0.2s;
  justify-content: center;
}

.view-all:hover {
  color: #2c4bff;
}

.view-all svg {
  transition: transform 0.2s;
}

.view-all:hover svg {
  transform: translateX(3px);
}

.category-card {
  width: 100%;
  max-width: 1200px;
  overflow-x: auto;
  padding-bottom: 15px;
}

.category-items {
  display: flex;
  gap: 15px;
  width: max-content;
  margin: 0 auto;
  padding-bottom: 10px; /* add some space at the bottom */
}

.category-item {
  background: white;
  border-radius: 12px;
  padding: 20px 15px;
  min-width: 184px;
  text-align: center;
  box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
  transition: transform 0.2s, box-shadow 0.2s;
  cursor: pointer;
  flex-shrink: 0;
}

.category-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

.category-icon {
  width: 40px;
  height: 40px;
  margin: 0 auto 10px;
  background: #f0f4ff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #4a6bff;
}

.category-item h3 {
  margin: 0;
  font-size: 0.9rem;
  color: #333;
  font-weight: 500;
} */

/* scrollbar styles (optional) */
.category-card::-webkit-scrollbar {
  height: 5px;
}

.category-card::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.category-card::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 10px;
}

.category-card::-webkit-scrollbar-thumb:hover {
  background: #aaa;
} 

.cata {
  background: linear-gradient(90deg, #0d6efd, #00c6ff);
  border-radius: 0.75rem;
  padding: 1rem 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  box-shadow: 0 8px 20px rgba(53, 122, 189, 0.3);
  color: #fff;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  transition: background 0.3s ease;
}

.cata-icon h4 {
  margin: 0;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1.3rem;
  color: #fff;
  text-shadow: 0 0 8px rgba(0,0,0,0.3);
}

.cata-icon h4 i {
  font-size: 1.5rem;
  color: White;
}

.text-marque {
  flex: 1;
  margin-left: 1.8rem;
  padding-top: 6px;
  font-weight: 600;
  font-size: 1.1rem;
  color: White; /* উজ্জ্বল হলুদ টেক্সট */
  overflow: hidden;
}

marquee {
  /* marquee নিজেই ইনহেরিটেড কালার নিবে */
}

/* Responsive */
@media (max-width: 576px) {
  .cata {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.7rem;
    padding: 1rem;
  }

  .text-marque {
    margin-left: 0;
    width: 100%;
    font-size: 1rem;
    color: #fff;
    text-shadow: none;
    background: rgba(0,0,0,0.15);
    border-radius: 8px;
    padding: 6px 12px;
  }
}

.cetagorycontainer {
  background-color: #f8f9fa;
  border-radius: 8px;
  margin: 20px auto;
  max-width: 1200px;
}

.product-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #0d6efd;
  position: relative;
  padding-bottom: 5px;
  font-family: 'Segoe UI', sans-serif;
}

.product-title::after {
  content: '';
  position: absolute;
  left: 50%;
  bottom: 0;
  transform: translateX(-50%);
  width: 0%;
  height: 3px;
  background: linear-gradient(90deg, #0d6efd, #00c6ff);
  transition: width 0.4s ease-in-out;
  border-radius: 10px;
}

.product-title:hover::after {
  width: 100%;
}

.list-icon-btn {
  background-color: #fff;
  border: 1px solid #0d6efd;
  border-radius: 8px;
  padding: 5px 10px;
  box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
  transition: all 0.3s ease;
  cursor: pointer;
}


.list-icon-btn:hover i {
  color: #fff;
}

.list-icon-btn i {
  font-size: 1.4rem;
  transition: color 0.3s ease;
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
        <button class="pc-builder-btn">Login Now</button>
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

    
  </div>


  <div class="category-container">
  <div class="category-card">
    <div class="category-items">
      <div class="category-item">
        <div class="category-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
          </svg>
        </div>
        <h3>Fashion</h3>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zm2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
          </svg>
        </div>
        <h3>Electronics</h3>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6zM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13z"/>
          </svg>
        </div>
        <h3>Home & Garden</h3>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
            <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
          </svg>
        </div>
        <h3>Beauty</h3>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
          </svg>
        </div>
        <h3>Sports</h3>
      </div>
      
      <div class="category-item">
        <div class="category-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135z"/>
          </svg>
        </div>
        <h3>Toys</h3>
      </div>
    </div>
</div>

  <div class="container my-4">
    <div class="cata shadow-sm w-100 d-flex">
      <div class="cata-icon">
        <h4>🔊সার্ভিস </h4>
      </div>
      <div class="text-marque">
        <marquee behavior="scroll" direction="left">আমাদের ডেলিভারি সার্ভিস সপ্তাহের শনিবার থেকে বৃহস্পতিবার পর্যন্ত সক্রিয় থাকে এবং এ সময়ের মধ্যেই সকল গ্রাহকের অর্ডার ডেলিভারি দেওয়া হয়।</marquee>
      </div>
    </div>
  </div>
</div>



<div class="cetagorycontainer d-flex justify-content-between align-items-center px-3 py-2">
  <h2 class="product-title m-0">Letest Product</h2>
  <div class="listproductcatagory shadow-sm">
    <button class="list-icon-btn">
      <i class="bi bi-list text-primary">All Product</i>
    </button>
  </div>
</div>


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
  <h5>
  <?php
    $pname = htmlspecialchars($product['p_name']);
    echo mb_strlen($pname) > 16 ? mb_substr($pname, 0, 16) . '...' : $pname;
  ?>
</h5>
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
        <h5>
  <?php
    $pname = htmlspecialchars($product['p_name']);
    echo mb_strlen($pname) > 20 ? mb_substr($pname, 0, 18) . '...' : $pname;
  ?>
</h5>

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
  <h5>
  <?php
    $pname = htmlspecialchars($product['p_name']);
    echo mb_strlen($pname) > 16 ? mb_substr($pname, 0, 16) . '...' : $pname;
  ?>
</h5>

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
</div>


<div class="middleproduct">


</div>
</div>
<script src="home.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer style="background: linear-gradient(to right, #03325e, #01092d); color: #fff; padding: 40px 20px; font-family: sans-serif;">
  <div style="display: flex; flex-wrap: wrap; justify-content: space-between; max-width: 1200px; margin: auto;">
    
    <!-- SUPPORT -->
    <div style="flex: 1; min-width: 250px; margin-bottom: 30px;">
      <h4 style="letter-spacing: 2px;">SUPPORT</h4>
      <div style="background-color: #00000020; padding: 15px; border-radius: 10px; margin: 10px 0; display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 20px;">📞</span>
        <div>
          <div style="font-size: 12px;">9 AM - 8 PM</div>
          <div style="color: #ff4c4c; font-size: 20px;">16793</div>
        </div>
      </div>
      <div style="background-color: #00000020; padding: 15px; border-radius: 10px; display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 20px;">📍</span>
        <div>
          <div style="font-size: 12px;">Store Locator</div>
          <div style="color: #ff4c4c; font-size: 16px;">Find Our Stores</div>
        </div>
      </div>
    </div>

    <!-- ABOUT US -->
    <div style="flex: 2; min-width: 400px; display: flex; flex-wrap: wrap; gap: 30px;">
      <div>
        <h4 style="letter-spacing: 2px;">ABOUT US</h4>
        <ul style="list-style: none; padding: 0; margin: 10px 0;">
          <li>Affiliate Program</li>
          <li>Online Delivery</li>
          <li>Refund and Return Policy</li>
          <li>Blog</li>
        </ul>
      </div>
      <div>
        <ul style="list-style: none; padding: 0; margin-top: 32px;">
          <li>EMI Terms</li>
          <li>Privacy Policy</li>
          <li>Star Point Policy</li>
          <li>Contact Us</li>
        </ul>
      </div>
      <div>
        <ul style="list-style: none; padding: 0; margin-top: 32px;">
          <li>About Us</li>
          <li>Terms and Conditions</li>
          <li>Career</li>
          <li>Brands</li>
        </ul>
      </div>
    </div>

    <!-- STAY CONNECTED -->
    <div style="flex: 1; min-width: 250px;">
      <h4 style="letter-spacing: 2px;">STAY CONNECTED</h4>
      <p><strong>Brand Style Online Shop</strong></p>
      <p style="font-size: 14px;">
        Head Office: 28 Kazi Nazrul Islam Ave, Navana Zohura Square, Dhaka 1000
      </p>
      <p>Email:<br><span style="color: #ff4c4c;">webteam@startechbd.com</span></p>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div style="border-top: 1px solid #ffffff20; margin-top: 40px; padding-top: 20px; text-align: center;">
    <div style="margin-bottom: 15px;">
      <span>Experience Star Tech App on your mobile:</span><br>
      <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" style="height: 40px; margin: 5px;">
      <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="App Store" style="height: 40px; margin: 5px;">
    </div>
    <div style="font-size: 14px;">© 2025 BSOS | All rights reserved | Devoloped by: <span style="color: #ff4c4c;"><a href="https://github.com/zihaduzzaman">Zihad Solution BD</a></span></div>
    <div style="margin-top: 10px;">
      <span style="margin: 0 10px;">⚪</span>
      <span style="margin: 0 10px;">📘</span>
      <span style="margin: 0 10px;">▶️</span>
      <span style="margin: 0 10px;">📷</span>
    </div>
    <div style="margin-top: 5px; font-size: 12px;">Powered By: BSOS</div>
  </div>
</footer>

</html>
