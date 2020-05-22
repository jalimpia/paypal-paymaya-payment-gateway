  cart = [];
  if(localStorage.shoppingCart){
    cart = localStorage.getItem('shoppingCart').split(",");
    $('#total_cart').html(cart.length);
    console.log(cart);
  }
  function AddItem(id){
      $('#alert_msg').remove();
      if(cart.includes(id)==false){
        cart.push(id);
        localStorage.setItem('shoppingCart', cart);
        $('#total_cart').html(cart.length);
        console.log(cart);
        $(function() {
        $('#alert').html(`
          <div class="alert alert-success" id="alert_msg" role="alert" style="display:none;">
          Added to Cart
          </div>`);
        $(".alert").fadeIn(1000);
        });
      }else{
        $('#alert').html(`
          <div class="alert alert-warning" id="alert_msg" role="alert" style="display:none;">
           Already added!
          </div>`);
        $(".alert").fadeIn(1000);
      }
  }

  function RemoveItem(id){
    const index = cart.indexOf(id);
    if (index > -1) {
      cart.splice(index, 1);
      localStorage.setItem('shoppingCart', cart);
      $('#total_cart, #total_item').html(cart.length);
      console.log(cart);
    }
  }

  var p = [];
  var data_cart = [];
  var data_cart_paymaya = [];
  function Calculate(){
    data_cart = [];
    data_cart_paymaya=[];
    var carts = localStorage.getItem('shoppingCart').split(",");
    var total_price = 0;
    p.forEach(function(item) {
      if(carts.includes(String(item.id))){
        var qty = parseInt($(`#prod_${item.id}_qty`).val());
        total_price+= parseInt(item.price) * qty;
        var data = {
          'name': item.name,
          'qty': qty,
          'sku': item.sku,
          'price': item.price
        };
        var paymaya_item = {
          "name": item.name,
          "code": String(item.sku),
          "description": item.desc,
          "quantity": String(qty),
          "amount": {
            "value": String(item.price.toFixed(2)),
          },
          "totalAmount": {
            "value": String((parseInt(item.price) * qty).toFixed(2))
          }
        };
        /*Checkout data for Paypal and Paymaya*/
        data_cart.push(data);
        data_cart_paymaya.push(paymaya_item);
      }
    });
    $('#total_price').val(total_price);
    $('#total_price_txt').html('₱'+total_price);
  }

  $( ".checkoutBtn" ).click(function() {
    var carts = localStorage.getItem('shoppingCart').split(",");
    $('#total_item').html(carts.length);
    /*Retrieve Items From JSON File*/
    let requestURL = 'product.json';
    let request = new XMLHttpRequest();
    request.open('GET', requestURL);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
      const products = request.response;
      p = products;
      $('#checkout_div').html('');
      var item_list='';
      products.forEach(function(item) {
          if(carts.includes(String(item.id))){
            item_list+=`
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">${item.name}</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">
                <input onchange="Calculate()" id="prod_${item.id}_qty" class="text-center plusminus" type="number" value="1" style="width:50px" step="1" min="1" max="10">
              </span>
              <span class="text-muted">₱${item.price}</span>
              <a href="#" onclick="RemoveItem('${item.id}');Calculate();$(this).parent().remove()" class="text-danger text-center"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </li>`;
          }
      });
      $('#item_list').html(item_list);
      $('#item_list').append(`
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (PHP)</span>
          <input id="total_price" type="number" value="" min="0" hidden>
          <strong id="total_price_txt"></strong>
        </li>
      `);
      Calculate();
    }
  });

function Checkout(){
  var carts = localStorage.getItem('shoppingCart').split(",");
  if(carts.length<1){
    return false;
  }
  if($( "input[name='paymentMethod']:checked" ).val()=='paymaya'){
    Checkout_Paymaya();
  }else{
    Checkout_Paypal();
  }
}

function Checkout_Paypal(){

  $('#loading').show();
  $.ajax({
    url:'checkout.php',
    type:'POST',
    data: {data_cart},
  }).done(function(data){
    console.log(data);
    if(data!=0){
      localStorage.clear();
      window.location.href = data;
  }else{
    console.log(data);
    alert('Transaction problem, please try again!');
    $('#loading').hide();
  }
  });
}

function Checkout_Paymaya(){
  $('#loading').show();
  var data = {
  "totalAmount": {
    "currency": "PHP",
    "value": $('#total_price').val(),
    "details": {
      "discount": "0.00",
      "serviceCharge": "0.00",
      "shippingFee": "0.00",
      "tax": "0.00",
      "subtotal": $('#total_price').val()
    }
  },
  "buyer": {
    "firstName": "Jerone",
    "middleName": "Baman",
    "lastName": "Alimpia",
    "contact": {
      "phone": "+63(2)1234567890",
      "email": "paymayabuyer1@gmail.com"
    },
    "shippingAddress": {
      "line1": "9F Robinsons Cybergate 3",
      "line2": "Pioneer Street",
      "city": "Mandaluyong City",
      "state": "Metro Manila",
      "zipCode": "12345",
      "countryCode": "PH"
    },
    "billingAddress": {
      "line1": "9F Robinsons Cybergate 3",
      "line2": "Pioneer Street",
      "city": "Mandaluyong City",
      "state": "Metro Manila",
      "zipCode": "12345",
      "countryCode": "PH"
    }
  },
  "items": data_cart_paymaya,
  "redirectUrl": {
    "success": "http://www.askthemaya.com/",
    "failure": "http://www.askthemaya.com/failure?id=6319921",
    "cancel": "http://www.askthemaya.com/cancel?id=6319921"
  },
  "requestReferenceNumber": "000141386713",
  "metadata": {}
};


console.log(data);

    $.ajax({
        url: 'https://pg-sandbox.paymaya.com/checkout/v1/checkouts',
        type: "POST",
        contentType: "application/json; charset=utf-8",
        crossDomain: true,
        dataType: "json",
        cache: false,
        data: JSON.stringify(data),
        beforeSend: function (xhr) {
            /* Authorization header */
            xhr.setRequestHeader("Authorization", "Basic " + "cGstZW80c0wzOTNDV1U1S212ZUpVYVc4VjczMFRUZWkyelk4ekU0ZEhKRHhrRjo=");
        },
        success: function(result){
            console.log(result.redirectUrl);
            localStorage.clear();
            window.location.href = result.redirectUrl;
        },
        fail: function(xhr, textStatus, errorThrown){
            console.log(result);
            alert('Transaction problem, please try again!');
            $('#loading').hide();
        }
    })
}