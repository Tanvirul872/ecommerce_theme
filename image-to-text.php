<?php 
  
/**

*  Template Name: image-text

**/
get_header();  ?>



<div class="container">
    <div class="row">
         <div class="col-md-4">
              <form action="#" id="got_measurement">

                 <div class="form_class">
                      <label for="#"> Product Link </label>
                      <input type="text" name="product_link" >
                  </div>

                  <div class="form_class">
                      <label for="#">Price Font Size</label>
                      <input type="text" name="font_size" value="80">
                  </div>

                  <div class="form_class">
                      <label for="#"> Price Left Right Position</label>
                      <input type="text" name="left_right" value="20">
                  </div>
                  <div class="form_class">
                      <label for="#">Price Top Bottom Position</label>
                      <input type="text" name="top_bottom" value="100">
                  </div>



                  <div class="form_class">
                      <label for="#">SKU Font Size</label>
                      <input type="text" name="sku_font_size" value="40">
                  </div>

                  <div class="form_class">
                      <label for="#"> SKU Left Right Position</label>
                      <input type="text" name="sku_left_right" value="30">
                  </div>
                  <div class="form_class">
                      <label for="#">SKU Top Bottom Position</label>
                      <input type="text" name="sku_top_bottom" value="140">
                  </div>



                  <div class="form_class">
                      <input type="submit" value="Submit">
                  </div>

              </form>
         </div>

<div class="col-md-8"> 

<div class="show_img_with_txt">

</div>
  <?php //echo do_shortcode('[image_with_text]'); ?>

</div>

    </div>
</div>



<script>



jQuery(function ($) {
  $("body").delegate("#got_measurement", "submit", function (event) {
    event.preventDefault();

    var ajax_url = ajax_object.ajax_url;     
    var form = $('#got_measurement').serialize();
    var formData = new FormData();  
    formData.append('action', 'got_measurement'); 
    formData.append('got_measurement', form);

    $.ajax({
      url: ajax_url,
      data: formData,
      processData: false,
      contentType: false,
      type: 'post',
      success: function(response) {
        $('.show_img_with_txt').html(response);
      }
    });
  });
});





//   // purchase product  
// jQuery(function ($) {
//   $("body").delegate("#got_measurement", "submit", function (event) {
// // $('#got_measurement').submit(function (event) {
//   event.preventDefault();

//   var ajax_url = ajax_object.ajax_url;     
//   // Get the educational certificate files

//   // alert(ajax_url) ; 

//   var form = $('#got_measurement').serialize();
//   // alert(form) ; 

//   var formData = new FormData ;  
//   formData.append('action','got_measurement') ; 
//   formData.append('got_measurement', form ) ;

//   $.ajax({
//       url: ajax_url,
//       data: formData,
//       processData:false,
//           contentType:false,
//           type:'post',
//       // data: data,
      
//       success: function(response){ 

       
//         if ($('.show_img_with_txt').find('img').length > 0) {
//             $('.show_img_with_txt').empty();
//             $('.show_img_with_txt').html(response);
//         }
//         $('.show_img_with_txt').html(response);

        
//       }
//   });

  
// });

// });




</script>

<?php get_footer(); ?>