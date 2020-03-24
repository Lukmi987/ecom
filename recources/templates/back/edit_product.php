<?php
var_dump($_GET['id']);
if(isset($_GET['id'])) {
global $conn;

$currentId = intval($_GET['id']);

$sql ="SELECT *FROM products WHERE product_id = $currentId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($result as $row){
    $product_title = $row['product_title'];
    $product_category_id = $row['product_category_id'];
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];
    $product_description = $row['product_description'];
    $short_desc = $row['short_desc'];
    $product_image = $row['product_image'];

    $product_image = display_image($row['product_image']);
  }
update_product();
}
?>
<div class="col-md-12">

<div class="row">
  <?php display_message(); ?>
<h1 class="page-header">
   Edit Product kkot

</h1>
</div>



<form action="" method="post" enctype="multipart/form-data">
<div class="col-md-8">
  <div class="form-group">
    <label for="product-title">Product Title </label>
    <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
  </div>

  <div class="form-group">
      <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control" ><?php echo $product_description; ?></textarea>
  </div>

  <div class="form-group row">
      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
      </div>
    </div>

  <div class="form-group">
      <label for="product-title">Short Description</label>
      <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"><?php echo $short_desc; ?></textarea>
  </div>

</div><!--Main Content-->

<!-- SIDEBAR-->

<aside id="admin_sidebar" class="col-md-4">

  <div class="form-group">
    <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
    <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
  </div>

     <!-- Product Categories-->
     <div class="form-group">
         <label for="product-title">Product Category</label>
        <select name="product_category_id" id="" class="form-control">
            <option value="<?php echo $product_category_id; ?>"> <?php echo show_product_category_title($product_category_id); ?></option>
            <?php show_categories_add_product(); ?>
        </select>
    </div>
    <!-- Product Brands-->
    <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <input type="number" name="product_quantity" class="form-control" value="<?php echo $product_quantity; ?>">
    </div>

    <!-- Product Image -->
        <label for="product-title">Product Image</label>
        <div class="form-group">
        <input type="file" name="file"> <br>
        <img width="200" src="../../recources/<?php echo $product_image; ?>" alt="">
  </div>
</aside><!--SIDEBAR-->
</form>
</div>
<!-- /.container-fluid -->
