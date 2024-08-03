jQuery(document).ready(function($) { 
    
    jQuery('.search-field').on('keyup', function(e) {
        e.preventDefault();
        var keyword = $(this).find('input[name="search-keyword"]').val().trim(); 
        // alert(keyword) ; 
        if (keyword.length >= 3) {
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'GET',
                data: {
                    action: 'ajax_search_products',
                    search_keyword: keyword,
                },
                success: function(response) {
                    jQuery('.search-suggestion').html(response);
                },
                error: function(errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    
    });
});


