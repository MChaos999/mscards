<div class="<?=$class_catalog?> product" data-pod_id="<?=$item->id?>">
    <div class="product__image image-product">
        <a href="/<?= $lclang ?>/<?=$menu['all'][3]->uri?>/<?=$item->cat_uri?>/<?=$item->uri?>" class="image-product__image">
            <?php $lastwo = substr($item->id, -2); ?>
            <?php $src = newthumbs($item->img, "product_images/$lastwo/$item->id", 300, 240, '300x240x0', 0) ?>
            <picture>
                <source srcset="<?=$src?>" type="image/webp">
                <img src="<?=$src?>" alt="Image-product" class="image-product__img">
            </picture>
        </a>
        <?php if (!empty($item->promoInfo)){?>
        <p class="image-product__sup"><?=$item->promoInfo?></p>
        <?php } ?>
    </div>
    <div class="product__body">
        <a href="/<?= $lclang ?>/<?=$menu['all'][3]->uri?>/<?=$item->cat_uri?>/<?=$item->uri?>" class="product__name"><?=$item->title?></a>
        <div class="product__price price-product">
            <?php if (!empty($item->price)){?>
            <p class="price-product__single"><?=$item->price?> <?=EUR_PCS?></p>
            <p class="price-product__wholesale"><?=WHOLESALE_FROM?> <?=$item->price * 100?> <?=EUR?></p>
            <?php } ?>
        </div>
        <a href="javascript:;" class="product__button <?php if (!empty($item->price)){?>add_to_cart<?php } ?>" data-prod_id="<?=$item->id?>"><?=ADD_TO_CART?></a>
    </div>
</div>