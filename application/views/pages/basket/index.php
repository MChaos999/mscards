<main class="page">
    <section class="breadcrums">
        <div class="breadcrums__container _container">
            <ul class="breadcrums__list">
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>" class="breadcrums__link"><?= $menu['all'][1]->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <span class="breadcrums__link"><?= $page_name ?></span>
                </li>
            </ul>
        </div>
    </section>
    <?php if (!empty($cart_items)) { ?>
        <section class="cart">
            <div class="cart__container _container">
                <h2 class="cart__title"><?= $page_name ?></h2>
                <div class="cart__content">
                    <div class="cart__main main-cart">
                        <ul class="main-cart__head">
                            <li class="main-cart__column"><?= ORDER_PRODUCT ?></li>
                            <li class="main-cart__column"><?= ORDER_PRICE ?></li>
                            <li class="main-cart__column"><?= ORDER_QUANTITY ?></li>
                            <li class="main-cart__column"><?= ORDER_TOTAL ?></li>
                        </ul>
                        <div class="main-cart__body body-main-cart">
                            <?php foreach ($cart_items as $item) { ?>
                                <div class="body-main-cart__row" data-rowid="<?= $item['rowid']?>">
                                    <div class="body-main-cart__column body-main-cart__info">
                                        <?php $lastwo = substr($item['products']->id, -2); ?>
                                        <?php $src = newthumbs($item['products']->img, "product_images/$lastwo/" . $item['products']->id, 300, 240, '300x240x0', 0) ?>
                                        <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $item['products']->cat_uri ?>/<?= $item['products']->uri ?>"
                                           class="body-main-cart__image">
                                            <picture>
                                                <source srcset="<?= $src ?>" type="image/webp">
                                                <img src="<?= $src ?>" alt="Image-product"></picture>
                                        </a>
                                        <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $item['products']->cat_uri ?>/<?= $item['products']->uri ?>"
                                           class="body-main-cart__name">
                                            <?= $item['products']->title ?>
                                            <?php if (!empty($item['option'])) { ?>
                                                <?php foreach ($item['option'] as $option) { ?>
                                                    <p><?= $option->title ?><span> <?= $option->price ?> <?= EUR_SYMBOL ?></span></p>
                                                <?php } ?>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="body-main-cart__column body-main-cart__price">
                                        <span><?= $item['price'] ?></span> <?= EUR_SYMBOL ?>
                                    </div>
                                    <div class="body-main-cart__quantity">
                                        <div class="quantity">
                                            <div class="quantity__button quantity__button_minus"></div>
                                            <div class="quantity__input">
                                                <input autocomplete="off" type="number" name="counts-product"
                                                       value="<?= $item['qty'] ?>"
                                                       data-rowid="<?= $item['rowid']?>"
                                                       data-max="<?= $item['products']->qty ?>">
                                            </div>
                                            <div class="quantity__button quantity__button_plus"></div>
                                        </div>
                                    </div>
                                    <div class="body-main-cart__total">
                                        <p class="body-main-cart__total_price"><span><?= $item['qty'] * $item['price'] ?></span> <?= EUR_SYMBOL ?></p>
                                        <a href="javascript:;" class="body-main-cart__delete"><?= ORDER_DELETE ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="cart__sidebar sidebar-cart">
                        <h2 class="sidebar-cart__title"><?= ORDER_TOTAL_BLOCK ?></h2>
                        <ul class="sidebar-cart__list list-sidebar-cart">
                            <li class="list-sidebar-cart__item">
                                <p class="list-sidebar-cart__name"><?= ORDER_PRODUCTS ?></p>
                                <div class="list-sidebar-cart__info">
                                    <p class="list-sidebar-cart__value total_price_cart"><span><?= $total_price_cart ?></span> <?= EUR_SYMBOL ?></p>
                                </div>
                            </li>
                            <?php if ((int)FREE_SHIPPING_VALUE > $total_price_cart) {
                                $price_delivery = (int)SHIPPING_PRICE;?>
                                <li class="list-sidebar-cart__item">
                                    <p class="list-sidebar-cart__name"><?= ORDER_DELIVERY ?></p>
                                    <div class="list-sidebar-cart__info">
                                        <p class="list-sidebar-cart__value delivery_cart"><span><?=SHIPPING_PRICE?></span> <?= EUR_SYMBOL ?></p>
<!--                                        <p class="list-sidebar-cart__date">20.09.2022</p>-->
                                    </div>
                                </li>
                            <?php } ?>
                            <?php if (!empty($option_price_off)){?>
                            <li class="list-sidebar-cart__item">
                                <p class="list-sidebar-cart__name"><?= ORDER_ADDITIONAL_SERVICES ?></p>
                                <div class="list-sidebar-cart__info">
                                    <p class="list-sidebar-cart__value option_price"><span><?= $option_price ?></span> <?= EUR_SYMBOL ?></p>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="sidebar-cart__total total-sidebar-cart">
                            <p class="total-sidebar-cart__title"><?= ORDER_TO_PAY ?></p>
                            <div class="total-sidebar-cart__info">
                                <p class="total-sidebar-cart__price">
                                    <span><?= number_format($total_price_cart + $price_delivery + ((($total_price_cart + $price_delivery) * (int)TVA_RATE)/100), 2, '.', '');?></span> <?= EUR_SYMBOL ?>
                                </p>
                                <p class="total-sidebar-cart__tax">
                                    (<?= ORDER_VAT ?> <span><?= number_format((($total_price_cart + $price_delivery)* (int)TVA_RATE)/100, 2, '.', '')?></span> <?= EUR_SYMBOL ?>)
                                </p>
                            </div>
                        </div>
                        <a href="/<?=$lclang?>/<?=$menu['all'][12]->uri?>" class="sidebar-cart__button"><?=$menu['all'][12]->title?></a>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>