<?php
$data = file_get_contents('product.json');
$products = json_decode($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shop</title>
  <!-- Header -->
  <?php include("partial/header.php"); ?>
</head>

<body>

  <!-- Navigation -->
  <?php
    include("partial/menu.php");
  ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
          <h6>Categories: </h6>
          <a href="#" class="list-group-item">Men’s shoes</a>
          <a href="#" class="list-group-item">Men’s jacket</a>
          <a href="#" class="list-group-item">Sport shoes</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
        <div class="row">
          <div class="col-12 mt-4" id="alert">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Payment Success!</h4>
              <p>Thank you for purchasing our product. Your support and trust in us are much appreciated. </p>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>

</html>
