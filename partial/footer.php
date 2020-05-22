<!-- Checkout Modal -->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="checkout_div1">

        <div class="container">
          <div class="row">
            <div class="col-md-12 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill" id="total_item">0</span>
              </h4>

              <ul class="list-group mb-3" id="item_list">
                ...
              </ul>

              <form class="needs-validation" novalidate>
                <h4 class="mb-3">Payment</h4>
                <div class="my-3">
                  <div class="custom-control custom-radio">
                    <input id="paymaya" name="paymentMethod" value="paymaya" type="radio" class="custom-control-input" checked required>
                    <label class="custom-control-label" for="paymaya"><i class="fa fa-credit-card" aria-hidden="true"></i> Paymaya</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input id="paypal" name="paymentMethod" value="paypal" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="paypal"><i class="fa fa-paypal" aria-hidden="true"></i> PayPal</label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Checkout()" data-dismiss="modal">PROCEED TO CHECKOUT</button>
      </div>
    </div>
  </div>
</div>


<div id="loading"></div>

<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; Simple Payment Gateway System</p>
  </div>
  <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Custom JavaScript -->
<script src="js/custom.js"></script>
