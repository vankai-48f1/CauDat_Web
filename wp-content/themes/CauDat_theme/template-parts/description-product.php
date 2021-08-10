<?php
global $product;

woocommerce_template_single_title(); // Title product 

echo '<div class="sg-product-gu">( ' . $product->get_attribute('pa_gu') . ')</div>';

woocommerce_template_single_rating();

woocommerce_template_single_price();

get_template_part('template-parts/attribute', 'product');

?>

<div class="product-structure">
    <div class="product-structure-item">
        <label for="structure-kg">Khối lượng</label>

        <select name="cars" id="structure-kg">
            <option value="volvo"><?php $product->get_attribute('pa_gu') ?></option>
        </select>
    </div>
</div>