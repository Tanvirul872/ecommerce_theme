jQuery(function ($) {
  $(document).delegate(".pos_category select", "change", function () {
    var cat = $("#product_category").val();

    var data = {
      action: "filter_products",
      cat: cat,
    };

    $.ajax({
      url: variables.ajax_url,
      type: "POST",
      data: data,

      success: function (response) {
        $(".js-products").html(response);
      },
    });
  });
});






// press sku and enter 

jQuery(document).ready(function() {  
  jQuery('input[name="product_sku"]').on('keypress', function(event) {  
    if (event.which === 13) { // 13 is the Enter key code
      event.preventDefault(); 
      var productSku = jQuery(this).val();
      alert(productSku); 

      var data = {
        action: "add_products",
        productSku: productSku,
      };
  
      jQuery.ajax({
        url: variables.ajax_url,
        type: "POST",
        data: data,
  
        success: function (response) {
          myVariable = true;
          jQuery(".pos_data_product").html(response);
        },
      });

      calculateTotal();
  }
    
    });
});


// jQuery(document).ready(function ($) {
//   $(document).delegate(".product-quantity", "input", function () { 

    
//     var row = $(this).closest(".product-row"); 
//     var quantity = $(this).val();
//     // alert(quantity) ;   
//     var productPrice = $(this).data("product-price");
//     var totalPrice = quantity * productPrice;
//     row.find(".total_price").html(totalPrice); 
//     calculateTotal();
    
//   });
// });

// jQuery(document).ready(function ($) {
//   $(document).delegate(".product-price", "input", function () {
//     var row = $(this).closest(".product-row");
//     var productPrice = $(this).val();

//     // alert(productPrice);

//     var quantity = row.find(".product-quantity").val();
//     // alert(quantity);
//     var totalPrice = quantity * productPrice;
//     // alert(totalPrice);
//     row.find(".total_price").html(totalPrice);
  

//   });
// });


// jQuery(document).ready(function ($) {
//   function calculateTotal() {
//     var total = 0;
//     $(".product-price").each(function () {
//         var price = parseFloat($(this).val());
//         if (!isNaN(price)) {
//             total += price;
//         }
//     });
//     $("input[name='total_amount']").val(total);
//   }
  
// });




jQuery(document).ready(function ($) {
  function calculateTotal() {
      var total = 0;
      $(".product-row").each(function () {
          var row = $(this);
          var subtotal = parseFloat(row.find(".total_price").text().replace(/[^\d.-]/g, ''));
          if (!isNaN(subtotal)) {
              total += subtotal;
          }
      });
      $("input[name='total_amount']").val(total.toFixed(2));
  }

  $(document).delegate(".product-quantity, .product-price", "input", function () {
      var row = $(this).closest(".product-row");
      var quantity = row.find(".product-quantity").val();
      var productPrice = row.find(".product-price").val();
      var totalPrice = quantity * productPrice;
      row.find(".total_price").html('<span class="woocommerce-Price-amount amount"><bdi>' + totalPrice.toFixed(2) + '<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span>');
      calculateTotal();
  });

  calculateTotal();
});


 // Event handler for input changes in the discount_amount field
jQuery(document).ready(function ($) {
  jQuery(document).on('input', '.pos_discount', function () {
      var discountValue = $(this).val();
      var total_amount = $('.total_amount').val();
      amount_after_discount = total_amount - discountValue ; 
      $('.total_amount').val(amount_after_discount);
   
  });
});

jQuery(document).ready(function ($) {
  // alert("kamrul");
  $("#select_customer").select2();
  $('.select2_products').select2();
});

 
jQuery(document).ready(function() { 
  jQuery('.examplessss').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copyHtml5',
            {
                  extend: 'excelHtml5',
                  title: 'Project Report - ' + new Date().toJSON().slice(0,10).replace(/-/g,'-')
              },
          'csvHtml5',
          'pdfHtml5'
      ]
  } );
} );



jQuery(document).ready(function ($) {

  $('.search_product_for_purchase').on('keypress', function (event) {
      if (event.which === 13) {
          event.preventDefault();

          var inputValue = $(this).val();

          var data = {
              action: "search_product_for_purchase",
              product_sku: inputValue,
          };

          $.ajax({
              url: variables.ajax_url,
              type: "POST",
              data: data,
              success: function (response) {
                  if (response.error) {
                      alert(response.error);
                  } else {
                      var productName = response.product_name;
                      var purchasePrice = response.purchase_price;
                      var product_id = response.product_id;
                      
                      // Create a new row with the retrieved data
                      var newRow = '<tr>' +
                          '<td>1</td>' +
                          '<td>' + productName + '</td>' +
                          '<input type="hidden" name="productid[]" value="' + product_id + '" class="product-id">' +
                          '<td> <input type="number" name="rate[]" value="' + purchasePrice + '" class="rate-input"> </td>' +
                          '<td> <input type="number" name="quantity[]" value="1" class="quantity-input"> </td>' +
                          '<input type="hidden" name="subtotal[]" value="' + purchasePrice + '" class="subtotal-price">' +
                          '<td class="subtotal">' + purchasePrice + '</td>' +
                          '<td class="delete-row">Delete</td>' +   
                          '</tr>';

                      // Append the new row to the table
                      $(".widefat tbody").append(newRow);

                      // Add event listener for quantity change
                      $('.quantity-input').on('input', function () {
                          updateSubtotalsAndGrandTotal();
                      });

                      // Add event listener for rate change
                      $('.rate-input').on('input', function () {
                          updateSubtotalsAndGrandTotal();
                      });

                      // Add event listener for delete row
                      $('.delete-row').on('click', function () {
                            $(this).closest('tr').remove();
                            updateSubtotalsAndGrandTotal();
                      });

                      // Calculate and display initial grand total
                      updateSubtotalsAndGrandTotal();
                  }
              },
          });
      }
  });


  // search product for order start 

  $('.search_product_for_order').on('keypress', function (event) {
    if (event.which === 13) {
        event.preventDefault();

        var inputValue = $(this).val();

        var data = {
            action: "search_product_for_order",
            product_sku: inputValue,
        };

        $.ajax({
            url: variables.ajax_url,
            type: "POST",
            data: data,
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else { 

                    var productName = response.product_name;
                    var purchasePrice = response.sale_price;
                    var product_id = response.product_id;
                    
                    // Create a new row with the retrieved data
                    var newRow = '<tr>' +
                        '<td>1</td>' +
                        '<td>' + productName + '</td>' +
                        '<input type="hidden" name="productid[]" value="' + product_id + '" class="product-id">' +
                        '<td> <input type="number" name="rate[]" value="' + purchasePrice + '" class="rate-input"> </td>' +
                        '<td> <input type="number" name="quantity[]" value="1" class="quantity-input"> </td>' +
                        '<input type="hidden" name="subtotal[]" value="' + purchasePrice + '" class="subtotal-price">' +
                        '<td class="subtotal">' + purchasePrice + '</td>' +
                        '<td class="delete-row">Delete</td>' +   
                        '</tr>';

                    // Append the new row to the table
                    $(".widefat tbody").append(newRow);

                    // Add event listener for quantity change
                    $('.quantity-input').on('input', function () {
                        updateSubtotalsAndGrandTotal();
                    });

                    // Add event listener for rate change
                    $('.rate-input').on('input', function () {
                        updateSubtotalsAndGrandTotal();
                    });

                    // Add event listener for delete row
                    $('.delete-row').on('click', function () {
                          $(this).closest('tr').remove();
                          updateSubtotalsAndGrandTotal();
                    });

                    // Calculate and display initial grand total
                    updateSubtotalsAndGrandTotal();
                }
            },
        });
    }
});
  // search product for order end 



  var addedProducts = [];

  $(document).delegate(".product-item", "click", function () { 

    var productSku = $(this)
      .find(".product-sku")
      .text()
      .trim()
      .replace("SKU: ", "");

      alert(productSku) ; 


    if (addedProducts.includes(productSku)) {
      alert("Product already added");
      return;
    } 

    var data = {
      action: "search_product_for_order",
      product_sku: productSku,
    };

      $.ajax({
        url: variables.ajax_url,
        type: "POST",
        data: data,
        success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else { 

                    var productName = response.product_name;
                    var purchasePrice = response.sale_price;
                    var product_id = response.product_id;
                    
                    // Create a new row with the retrieved data
                    var newRow = '<tr>' +
                        '<td>1</td>' +
                        '<td>' + productName + '</td>' +
                        '<input type="hidden" name="productid[]" value="' + product_id + '" class="product-id">' +
                        '<td> <input type="number" name="rate[]" value="' + purchasePrice + '" class="rate-input"> </td>' +
                        '<td> <input type="number" name="quantity[]" value="1" class="quantity-input"> </td>' +
                        '<input type="hidden" name="subtotal[]" value="' + purchasePrice + '" class="subtotal-price">' +
                        '<td class="subtotal">' + purchasePrice + '</td>' +
                        '<td class="delete-row">Delete</td>' +   
                        '</tr>';

                    // Append the new row to the table
                    $(".widefat tbody").append(newRow);

                    // Add event listener for quantity change
                    $('.quantity-input').on('input', function () {
                        updateSubtotalsAndGrandTotal();
                    });

                    // Add event listener for rate change
                    $('.rate-input').on('input', function () {
                        updateSubtotalsAndGrandTotal();
                    });

                    // Add event listener for delete row
                    $('.delete-row').on('click', function () {
                          $(this).closest('tr').remove();
                          updateSubtotalsAndGrandTotal();
                    });

                    // Calculate and display initial grand total
                    updateSubtotalsAndGrandTotal();
                }
            },
      });
   
  });




  // search_products_frm_pos start

   

  // search_products_frm_pos end



  // Function to update subtotals and grand total
  function updateSubtotalsAndGrandTotal() {
      var grandTotal = 0;

      $('.rate-input').each(function () {
          var rate = parseFloat($(this).val());
          var quantity = parseInt($(this).closest('tr').find('.quantity-input').val());
          var subtotal = quantity * rate;

          grandTotal += subtotal;

          $(this).closest('tr').find('.subtotal').text(subtotal.toFixed(2));
          $(this).closest('tr').find('.subtotal-price').val(subtotal.toFixed(2));
      });

      // Update the grand total field
      $('.grand-total').text(grandTotal.toFixed(2));
      $('.payable_amount').text(grandTotal.toFixed(2));
      $('.due_amount').text(grandTotal.toFixed(2));

      // Set grandTotal value to input fields
      $('input[name="payable"]').val(grandTotal.toFixed(2));
      $('input[name="due"]').val(grandTotal.toFixed(2));

  }


function updateDue() {
    var payable = parseFloat($('input[name="payable"]').val());
    var paid = parseFloat($('input[name="paid"]').val());
    var due = payable - paid;
    $('input[name="due"]').val(due.toFixed(2));
    $('.due_amount').text(due.toFixed(2));
}

// Call updateDue() when the page loads
updateDue();

// Call updateDue() when the "paid" input field changes
$('input[name="paid"]').on('input', function() {
    updateDue();
});


});



// pos order product 

// purchase product  
jQuery(function ($) {

  $('#pos_order').submit(function (event) {
    event.preventDefault();
  
    var ajax_url = variables.ajax_url;     
    // Get the educational certificate files
  
    alert(ajax_url) ; 
  
    var form = $('#pos_order').serialize();
    alert(form) ; 
  
    var formData = new FormData ;  
    formData.append('action','pos_order') ; 
    formData.append('pos_order', form ) ;
  
    $.ajax({
        url: ajax_url,
        data: formData,
        processData:false,
        contentType:false,
        type:'post',
        // data: data,
        
        success: function(response){
          // alert('successfully store data') ; 
  
        }
    });
  
    
  });
  
  });



// purchase product  
jQuery(function ($) {

$('#purchase_product').submit(function (event) {
  event.preventDefault();

  var ajax_url = variables.ajax_url;     
  // Get the educational certificate files

  alert(ajax_url) ; 

  var form = $('#purchase_product').serialize();
  alert(form) ; 

  var formData = new FormData ;  
  formData.append('action','purchase_product') ; 
  formData.append('purchase_product', form ) ;

  $.ajax({
      url: ajax_url,
      data: formData,
      processData:false,
          contentType:false,
          type:'post',
      // data: data,
      
      success: function(response){
      }
  });
});

// add pos product 

$('#pos_add_product').submit(function (event) {
  event.preventDefault();

  var ajax_url = variables.ajax_url;     
  // Get the educational certificate files

  // alert(ajax_url) ; 

  var form = $('#pos_add_product').serialize();
  alert(form) ; 

  var formData = new FormData ;  
  formData.append('action','pos_add_product') ; 
  formData.append('pos_add_product', form ) ;
  
  $.ajax({
      url: ajax_url,
      data: formData,
      processData:false,
      contentType:false,
      type:'post',
      // data: data,
      success: function(response){ 
        // location.reload() ;
      }
  });

});


});


// download wholesale products  

jQuery(function ($) {
  $('.download_wholesale_ordersheet a').click(function (event) {
      event.preventDefault();
      var ajax_url = variables.ajax_url;
      var form = $('#purchase_product').serialize();
      var formData = new FormData();
      formData.append('action', 'download_wholesale_ordersheet');
      formData.append('download_wholesale_ordersheet', form);
      
      $.ajax({
          url: ajax_url,
          data: formData,
          processData: false,
          contentType: false,
          type: 'post',
          xhrFields: {
              responseType: 'blob' // Set the response type to blob for binary data
          },
          success: function(response) {
              var blob = new Blob([response], { type: 'application/pdf' });
              var url = window.URL.createObjectURL(blob);
              var a = document.createElement('a');
              a.href = url;
              a.target = '_blank';
              document.body.appendChild(a);
              a.click();
              document.body.removeChild(a);
              window.URL.revokeObjectURL(url);
          }
      });
  });
});

