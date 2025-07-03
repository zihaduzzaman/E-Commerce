<?php require "header.php"; ?>
<?php require "config.php"; ?>
<?php require "sidebar.php"; ?>

<?php
if (isset($_POST['add'])) {
    $pname        = $_POST['product_name'];
    $regularPrice = $_POST['regular_price'];
    $oldPrice     = $_POST['old_price'];
    $description  = $_POST['description'];
    $category = $_POST['category'];
    $name = $_FILES['uimage']['name'];
    $tmp_name = $_FILES['uimage']['tmp_name'];

    $upload = move_uploaded_file($tmp_name, "uploads/$name");
    if($upload){
        $insert = "INSERT INTO product (p_name, r_price, o_price, `desc`, img_file, category) 
                   VALUES ('$pname','$regularPrice','$oldPrice','$description','$name', '$category')";
                   $query = mysqli_query($conn, $insert);
                }else{
                    echo "Failed to upload";
                }
}
?>

<body>
<div class="cards">
  <div class="card">
    <div class="container mt-5 mb-5">
      <h2 class="mb-4 text-center">Add New Product</h2>
      
      <form action="productadd.php" method="POST" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="mb-3">
          <input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
        </div>

        <!-- Regular Price -->
        <div class="mb-3">
          <input type="number" class="form-control" name="regular_price" placeholder="Regular Price" required>
        </div>

        <!-- Old Price -->
        <div class="mb-3">
          <input type="number" class="form-control" name="old_price" placeholder="Old Price">
        </div>

        <!-- Description -->
        <div class="mb-3">
          <textarea class="form-control" name="description" rows="3" placeholder="Description (within 25 words)"></textarea>
        </div>

        <!-- Product Image -->
        <div class="mb-3">
        <input class="form-control" type="file" name="uimage" />
        </div>

        <div class="mb-3">
          <select class="form-select form-control" name="category" id="categorySelect" onchange="filterByCategory(this.value)">
            <option selected disabled>Select category</option>
            <option value="Main Product">Main Product</option>
            <option value="Side Product">Side Product</option>
            <option value="Right Product">Right Product</option>
          </select>
        </div>




        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" name="add">Add Product</button>
      </form>
    </div>
  </div>
</div>
</body>
