<style>
    .product {
        margin-bottom: 20px;
    }

    .product label {
        display: block;
        margin-bottom: 5px;
    }

    .product input[type="text"],
    .product input[type="date"],
    .product textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    /* Optional: Add some styling for better appearance */
    .product textarea {
        resize: vertical;
    }

    /* Optional: Add some spacing between elements */
    .product+.product {
        margin-top: 20px;
    }
</style>

<h2>Add New Customer </h2>

<div class="product">
    <label for="product"> Add product </label>
    <input type="text" name="select">
</div>

<div class="product">
    <label for="product"> Add product </label>
    <input type="date" name="date">
</div>

<div class="product">
    <label for="product"> Add Note </label>
    <textarea name="note" id="" cols="30" rows="10"></textarea>
</div>