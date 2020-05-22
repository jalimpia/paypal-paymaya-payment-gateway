<?php
   $data = file_get_contents('product.json');
   $products = json_decode($data);
   $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=$products[$id]->name?></title>
      <!-- Header -->
      <?php include("partial/header.php"); ?>
   </head>
   <body>
      <!-- Navigation -->
      <?php
        include("partial/menu.php");
      ?>

      <!-- Page Content -->
      <div class="container mb-5">

         <div class="row mt-4">

            <div class="col-lg-5 ">
              <button class="btn mb-2" onclick="history.back()"><i class="fa fa-chevron-circle-left"></i> Back</button>
               <div class="card w-100 mb-4 ">
                  <img class="card-img-top w-100" src="img/<?=$products[$id]->img?>" alt="<?=$products[$id]->img?>">
               </div>
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-7">
              <div class="row">
                <div class="col-12 mt-4" id="alert">
                </div>
              </div>
               <div class="padding-top-2x mt-2 hidden-md-up"></div>
               <div class="rating-stars">
                  <?php
                  for($i=0; $i<round($products[$id]->rate); $i++){
                  ?>
                  <small class="stars" style="font-size: 20px;">&#9733;</small>
                  <?php
                  }
                  for($i=0; $i<round(5-$products[$id]->rate); $i++){
                  ?>
                  <small class="stars" style="font-size: 20px;">&#9734;</small>
                  <?php } ?>
               </div>
               <span class="text-muted align-middle">&nbsp;&nbsp;<?=$products[$id]->rate?> | 3 customer reviews</span>
               <h2 class="padding-top-1x text-normal"><?=$products[$id]->name?></h2>
               <span class="h2 d-block">
               <del class="text-muted text-normal">₱<?=$products[$id]->old_price?></del>&nbsp; ₱<?=$products[$id]->price?></span>
               <p><?=$products[$id]->desc?></p>
               <div class="row margin-top-1x">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="size">Men's size</label>
                        <select class="form-control" id="size">
                           <option>Chooze size</option>
                           <option>11.5</option>
                           <option>11</option>
                           <option>10.5</option>
                           <option>10</option>
                           <option>9.5</option>
                           <option>9</option>
                           <option>8.5</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-5">
                     <div class="form-group">
                        <label for="color">Choose color</label>
                        <select class="form-control" id="color">
                           <option>White/Red/Blue</option>
                           <option>Black/Orange/Green</option>
                           <option>Gray/Purple/White</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <select class="form-control" id="quantity">
                           <option>1</option>
                           <option>2</option>
                           <option>3</option>
                           <option>4</option>
                           <option>5</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="pt-1 mb-2"><span class="text-medium">SKU:</span> #<?=$products[$id]->sku?></div>
               <div class="padding-bottom-1x mb-2"><span class="text-medium">Categories:&nbsp;</span><a class="navi-link" href="#">Men’s shoes,</a><a class="navi-link" href="#"> Snickers,</a><a class="navi-link" href="#"> Sport shoes</a></div>
               <hr class="mb-3">
               <div class="d-flex flex-wrap justify-content-between">
                  <div class="entry-share mt-2 mb-2">
                     <span class="text-muted">Share:</span>
                     <div class="share-links">
                        <a class="social-button" href="#" ><i class="fa fa-facebook-square"></i></a>
                        <a class="social-button" href="#" ><i class="fa fa-twitter-square"></i></a>
                        <a class="social-button" href="#" ><i class="fa fa-google-plus-square"></i></a>
                     </div>
                  </div>

                  <div class="sp-buttons mt-2 mb-2">
                     <button class="cart-btn mb-1" onclick="AddItem('<?=$products[$id]->id?>')">Add to Cart</button>
                     <button class="cart-btn checkoutBtn" onclick="AddItem('<?=$products[$id]->id?>');" data-toggle="modal" data-target="#checkout">Buy Now</button>

                  </div>
               </div>
            </div>
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
