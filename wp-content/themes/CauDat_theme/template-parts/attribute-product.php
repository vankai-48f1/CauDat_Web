<?php global $product; ?>
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
                <div class="attr-product__name">Vị(độ đắng)</div>
                <div class="attr-product__value">
                    <!-- < ?php 
                            $koostis = $product->get_attribute('pa_thanh-phan');
                            echo $koostis;
                            ?> -->
                </div>
            </div>
        </li>
        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Độ đậm (thể chất)</div>
                <div class="attr-product__value">
                    <!-- < ?php
                            $koostis = $product->get_attribute('pa_thanh-phan');
                            echo $koostis;
                            ?> -->
                </div>
            </div>
        </li>
        <li>
            <div class="attr-product__row">
                <div class="attr-product__name">Vị chua đặc trưng</div>
                <div class="attr-product__value">
                    <!-- < ?php
                            $koostis = $product->get_attribute('pa_thanh-phan');
                            echo $koostis;
                            ?> -->
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