

<!-- new code  -->


<div class="wrap">
    <h1 class="wp-heading-inline">Stocks</h1>
    <h2 class="nav-tab-wrapper">
        <a href="#tab1" class="nav-tab nav-tab-active">Tab 1</a>
        <a href="#tab2" class="nav-tab">Tab 2</a>
        <a href="#tab3" class="nav-tab">Tab 3</a>
    </h2>
    <div id="tab1" class="stock-tab-content">
        <h2>Tab 1 Content</h2>
        <!-- Add your content for Tab 1 here -->
    </div>
    <div id="tab2" class="stock-tab-content">
        <h2>Tab 2 Content</h2>
        <!-- Add your content for Tab 2 here -->
    </div>
    <div id="tab3" class="stock-tab-content">
        <h2>Tab 3 Content</h2>
        <!-- Add your content for Tab 3 here -->
    </div>
</div>

<style>
    .stock-tab-content {
        display: none;
    }
</style>

<script>
    jQuery(document).ready(function($) {
        $('.nav-tab-wrapper a').on('click', function(e) {
            e.preventDefault();

            // Hide all tab contents
            $('.stock-tab-content').hide();

            // Show the selected tab content
            var tabId = $(this).attr('href');
            $(tabId).show();

            // Remove the 'nav-tab-active' class from all tabs
            $('.nav-tab-wrapper a').removeClass('nav-tab-active');

            // Add the 'nav-tab-active' class to the clicked tab
            $(this).addClass('nav-tab-active');
        });
    });
</script>
