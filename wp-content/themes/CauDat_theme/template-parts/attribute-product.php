<?php global $product;
if($args['product']) {
    $product = $args['product'];
}
?>
<div class="attr-product">
    <!-- <div class="attr-product__inner"> -->
    <ul class="attr-product__list">
        <?php if (is_product()) : ?>
            <li class="attr-product__SKU">
                <div class="attr-product__row">
                    <div class="attr-product__name">Mã sản phẩm</div>
                    <div class="attr-product__value">
                        <?php
                        echo $product->get_sku();
                        ?>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Thành phần</div>
                <div class="attr-product__value">
                    <?php
                    $ingredients = $product->get_attribute('pa_thanh-phan');
                    echo $ingredients;
                    ?>
                </div>
            </div>
        </li>
        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Vị (độ đắng)</div>
                <div class="attr-product__value">
                    <?php
                    $taste = $product->get_attribute('pa_vi-do-dang');
                    ?>
                    <span class="attr-product__percent-taste" data-percent="<?php echo $taste;?>"></span>
                    <ul class="attr-product__circle attr-product__circle--taste">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Độ đậm (thể chất)</div>
                <div class="attr-product__value">
                    <?php
                    $taste_bold = $product->get_attribute('pa_do-dam-the-chat');
                    ?>
                    <span class="attr-product__percent-taste-bold" data-percent="<?php echo $taste_bold; ?>"></span>
                    <ul class="attr-product__circle attr-product__circle--taste-bold">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Vị chua đặc trưng</div>
                <div class="attr-product__value">
                    <?php
                    $sour = $product->get_attribute('pa_vi-chua-dac-trung');
                    ?>
                    <span class="attr-product__percent-sour" data-percent="<?php echo $sour; ?>"></span>
                    <ul class="attr-product__circle attr-product__circle--sour">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Hương</div>
                <div class="attr-product__value">
                    <?php
                    global $product;
                    $smell = $product->get_attribute('pa_huong');
                    echo $smell;
                    ?>
                </div>
            </div>
        </li>
    </ul>
    <!-- </div> -->
</div>