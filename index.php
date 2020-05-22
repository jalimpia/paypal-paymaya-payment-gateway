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
          </div>
        </div>
        <div class="row">
          <?php
          foreach ($products as $product) {
          ?>
            <div class="col-lg-4 mb-4 mt-2">
              <div class="card h-100">
                <a href="item.php?id=<?=$product->id?>">
                  <img class="card-img-top" src="img/<?=$product->img?>" alt="<?=$product->img?>">
                </a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="item.php?id=<?=$product->id?>"><?=$product->name?></a>
                  </h4>
                  <h5>₱<?=$product->price?></h5>
                  <p class="card-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?=$product->desc?></p>
                  <?php
                  for($i=0; $i<round($product->rate); $i++){
                  ?>
                  <small class="stars" style="font-size: 20px;">&#9733;</small>
                  <?php
                  }
                  for($i=0; $i<round(5-$product->rate); $i++){
                  ?>
                  <small class="stars" style="font-size: 20px;">&#9734;</small>
                  <?php } ?>
                </div>
                <div class="card-footer">
                  <button class="cart-btn" onclick="AddItem('<?=$product->id?>')">Add to Cart</button>
                </div>
              </div>
            </div>
            <?php
            }
            ?>


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php
    include("partial/footer.php");
  ?>
</body>
</html>
