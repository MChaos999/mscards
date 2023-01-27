<main class="page">
    <section class="breadcrums">
        <div class="breadcrums__container _container">
            <ul class="breadcrums__list">
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>" class="breadcrums__link"><?= $menu['all'][1]->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>"
                       class="breadcrums__link"><?= $menu['all'][3]->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $category->uri ?>"
                       class="breadcrums__link"><?= $category->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <span class="breadcrums__link"><?= $page_name ?></span>
                </li>
            </ul>
        </div>
    </section>
    <section class="card">
        <div class="card__container _container">
            <div class="card__content">
                <?php if (!empty($product->slider)) { ?>
                    <div class="card__slider slider-card _gallery">
                        <div class="slider-card__main main-slider-card _swiper">
                            <?php foreach ($product->slider as $image) { ?>
                                <?php $lastwo = substr($product->id, -2); ?>
                                <?php $src = newthumbs($image->img, "product_images/$lastwo/$product->id", 445, 320, '445x320x0', 0) ?>
                                <a href="<?= $src ?>" class="main-slider-card__item">
                                    <picture>
                                        <source srcset="<?= $src ?>" type="image/webp">
                                        <img src="<?= $src ?>" alt="Image"></picture>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="slider-card__thrumbs thrumbs-slider-card _swiper">
                            <?php foreach ($product->slider as $image) { ?>
                                <?php $lastwo = substr($product->id, -2); ?>
                                <?php $src = newthumbs($image->img, "product_images/$lastwo/$product->id", 445, 320, '445x320x0', 0) ?>
                                <div class="thrumbs-slider-card__item">
                                    <picture>
                                        <source srcset="<?= $src ?>" type="image/webp">
                                        <img src="<?= $src ?>" alt="Image"></picture>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if (!empty($product->promoInfo)) { ?>
                            <p class="slider-card__sup"><?= $product->promoInfo ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="card__info info-card">
                    <div class="info-card__main main-info-card">
                        <div class="main-info-card__head">
                            <h2 class="main-info-card__title"><?= $product->title ?></h2>
                            <p class="main-info-card__article"><?= SKU ?> <?= $product->code ?></p>
                        </div>
                        <?php if (!empty($product->prices)) { ?>
                            <p class="main-info-card__price">
                                <?php $standart_price = $product->prices[0]->price;
                                unset($product->prices[0]); ?>
                                <?= PRICE ?> <span
                                        class="main-info-card__price_value"><?= $standart_price ?><?= EUR_SYMBOL ?></span>
                                <span
                                        class="main-info-card__price_tax"><?= WITHOUT_TVA ?></span>
                            </p>
                        <?php } ?>
                        <?php if (!empty($product->prices)) { ?>
                            <ul class="main-info-card__pricelist pricelist-main-info-card">
                                <?php foreach ($product->prices as $price) { ?>
                                    <li class="pricelist-main-info-card__item" data-price="<?= $price->price ?>"
                                        data-qty="<?= $price->bulk_id ?>">
                                        <p><?= str_replace("{count}", $price->bulk_id, BUY_PCS_ON); ?>
                                            <strong><?= $price->price ?><?= EUR_SYMBOL ?></strong> <?= EACH_ADN_SAVE ?>
                                            <strong><?php echo number_format(100 - ($price->price * 100) / $standart_price, 2, '.', ''); ?>
                                                %</strong>
                                        </p>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <p class="main-info-card__status">
                            <?= AVAILABILITY ?>
                            <?php if ($product->qty > 500) { ?>
                                <span class="_few"><?= MANY ?></span>
                            <?php } elseif ($product->qty > 0) { ?>
                                <span class="_few"><?= FEW ?></span>
                            <?php } else { ?>
                                <span class="_few"><?= NOT_AVAILABLE ?></span>
                            <?php } ?>
                        </p>
                        <?php if (!empty($product->option)) { ?>
                            <div class="main-info-card__addition addition-main-info-card">
                                <?php foreach ($product->option as $option) { ?>
                                    <div class="addition-main-info-card__item">
                                        <label class="addition-main-info-card__checkbox checkbox">
                                            <input class="checkbox__input option_input" type="checkbox"
                                                   value="<?= $option->price ?>"
                                                   name="options[<?= $option->id ?>]" data-options="<?= $option->id ?>">
                                            <span class="checkbox__text"><span><?= $option->title ?> <strong>+<?= $option->price ?><?= EUR_SYMBOL ?></strong></span></span>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (!empty($product->prices)) { ?>
                        <div class="info-card__other other-info-card">
                            <div class="other-info-card__actions">
                                <div class="other-info-card__quantity">
                                    <div class="quantity">
                                        <div class="quantity__button quantity__button_minus"></div>
                                        <div class="quantity__input">
                                            <input autocomplete="off" type="number" name="qty_add" value="1"
                                                   data-max="<?= $product->qty ?>"
                                                   data-standart_price="<?= $standart_price ?>">
                                        </div>
                                        <div class="quantity__button quantity__button_plus"></div>
                                    </div>
                                </div>
                                <!--                            <form action="#" class="other-info-card__promo promo-other-info-card">-->
                                <!--                                <input type="text" name="promocode" placeholder="Промокод"-->
                                <!--                                       class="promo-other-info-card__input">-->
                                <!--                                <button type="submit" class="promo-other-info-card__button">Использовать</button>-->
                                <!--                            </form>-->
                            </div>
                            <div class="other-info-card__price price-other-info-card">
                                <p class="price-other-info-card__total"><?= TOTAL ?>
                                    <strong><span class="total_price"><?= $standart_price ?></span> <?= EUR ?></strong>
                                    <span class="wt_tva"><?= WITHOUT_TVA ?></span>
                                </p>
                                <p class="price-other-info-card__discount"><?= YOU_SALVAT ?>
                                    <strong><span class="total_discount">0</span><?= EUR_SYMBOL ?></strong></p>
                            </div>
                            <div class="other-info-card__buttons">
                                <a href="#" class="other-info-card__to-cart"
                                   data-prod_id="<?= $product->id ?>"><?= ADD_TO_CART ?></a>
                                <a href="#request"
                                   class="other-info-card__request _popup-link"><?= SUBMIT_AN_INQUIRY ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="card__tabs tabs-card _tabs">
                    <ul class="tabs-card__head">
                        <?php if (!empty($product->text)) { ?>
                            <li class="tabs-card__item _tabs-item _active"><?= DESCRIPTION ?></li>
                        <?php } ?>
                        <?php if (!empty($product->filters)) { ?>
                            <li class="tabs-card__item _tabs-item"><?= CHARACTERISTICS ?></li>
                        <?php } ?>
                        <?php if (!empty($product->pdf)) { ?>
                            <li class="tabs-card__item _tabs-item"><?= DOCUMENTATION ?></li>
                        <?php } ?>
                    </ul>
                    <div class="tabs-card__blocks">
                        <?php if (!empty($product->text)) { ?>
                            <div class="tabs-card__block _tabs-block _active">
                                <div class="tabs-card__text">
                                    <?= $product->text ?>
                                </div>
                                <a href="#" class="tabs-card__more"><?= MORE ?></a>
                                <a href="#" class="tabs-card__unmore"><?= LASS ?></a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($product->filters)) { ?>
                            <div class="tabs-card__block _tabs-block">
                                <div class="tabs-card__filters">
                                    <?php foreach ($product->filters as $filter) { ?>
                                        <?php if (!empty($filter->value)) { ?>
                                            <?php if (!empty($filter_item) && $filter_item->filter_title == $filter->filter_title) { ?>
                                                <div class="filter-card__item _filter-item more_value">
                                                    <div class="filter_value"><?= $filter->value ?></div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="filter-card__item _filter-item">
                                                    <div class="filter_title"><?= $filter->filter_title ?></div>
                                                    <div class="filter_value"><?= $filter->value ?></div>
                                                </div>
                                            <?php } ?>
                                            <?php $filter_item = $filter;
                                        } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($product->pdf)) { ?>
                            <div class="tabs-card__block _tabs-block">
                                <div class="tabs-card__pdf">
                                    <div class="img_pdf">
                                        <svg height="30px" width="30px" version="1.1" id="Layer_1"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             viewBox="0 0 303.188 303.188" xml:space="preserve">
<g>
    <polygon style="fill:#E8E8E8;" points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525 	"/>
    <path style="fill:#FB3449;" d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936
		c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202
		c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251
		c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594
		c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603
		c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02
		c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024
		c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387
		c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205
		c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119
		c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57
		C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041
		c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065
		c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918
		c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985
		c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993
		c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883
		c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265
		c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197
		c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z
		 M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542
		c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275
		c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z"/>
    <polygon style="fill:#FB3449;" points="227.64,25.263 32.842,25.263 32.842,0 219.821,0 	"/>
    <g>
        <path style="fill:#A4A9AD;" d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643
			v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z
			 M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857
			h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z"/>
        <path style="fill:#A4A9AD;" d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979
			h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324
			c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43
			C160.841,257.523,161.76,254.028,161.76,249.324z"/>
        <path style="fill:#A4A9AD;" d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374
			L196.579,273.871L196.579,273.871z"/>
    </g>
    <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0 	"/>
</g>
</svg>
                                    </div>
                                    <div class="download_pdf">
                                        <a href="/public/products/<?= $product->pdf ?>"
                                           target="_blank"><?= DOWNLOAD_PDF ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if (!empty($products_related)) { ?>
                    <div class="card__related related-card">
                        <h3 class="related-card__title"><?= RELATED_PRODUCTS ?></h3>
                        <div class="related-card__content">
                            <div class="related-card__arrow related-card-arrow-prev">
                                <picture>
                                    <source srcset="/app/img/icons/slider-arrow-prev.svg" type="image/webp">
                                    <img src="/app/img/icons/slider-arrow-prev.svg" alt="Prev"></picture>
                            </div>
                            <div class="related-card__slider _swiper">
                                <?php foreach ($products_related as $related) { ?>
                                    <?php $lastwo = substr($related->id, -2); ?>
                                    <?php $src = newthumbs($related->img, "product_images/$lastwo/$related->id", 300, 240, '300x240x0', 0) ?>
                                    <div class="related-card__product product">
                                        <div class="product__image image-product">
                                            <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $related->cat_uri ?>/<?= $related->uri ?>"
                                               class="image-product__image">
                                                <picture>
                                                    <source srcset="<?= $src ?>" type="image/webp">
                                                    <img src="<?= $src ?>" alt="Image-product"
                                                         class="image-product__img"></picture>
                                            </a>
                                            <?php if (!empty($related->promoInfo)) { ?>
                                                <p class="image-product__sup"><?= $related->promoInfo ?></p>
                                            <?php } ?>
                                        </div>
                                        <div class="product__body">
                                            <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $related->cat_uri ?>/<?= $related->uri ?>"
                                               class="product__name">
                                                <?= $related->title ?>
                                            </a>
                                            <?php if (!empty($related->price)) { ?>
                                                <div class="product__price price-product">
                                                    <p class="price-product__single"><?= $related->price ?> <?= EUR_PCS ?></p>
                                                    <p class="price-product__wholesale"><?= WHOLESALE_FROM ?> <?= $related->price * 100 ?> <?= EUR ?></p>
                                                </div>
                                                <a href="#" class="product__button"><?= ADD_TO_CART ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="related-card__arrow related-card-arrow-next">
                                <picture>
                                    <source srcset="/app/img/icons/slider-arrow-next.svg" type="image/webp">
                                    <img src="/app/img/icons/slider-arrow-next.svg" alt="Next"></picture>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php if (!empty($products_more)) { ?>
        <section class="interested">
            <div class="interested__container _container">
                <div class="interested__head">
                    <h2 class="interested__title"><?= YOU_MAY_ALSO ?></h2>
                    <div class="interested__arrows">
                        <div class="interested__arrow interested-arrow-prev">
                            <picture>
                                <source srcset="/app/img/icons/arrow-2-left.svg" type="image/webp">
                                <img src="/app/img/icons/arrow-2-left.svg" alt="Prev"></picture>
                        </div>
                        <div class="interested__arrow interested-arrow-next">
                            <picture>
                                <source srcset="/app/img/icons/arrow-2-right.svg" type="image/webp">
                                <img src="/app/img/icons/arrow-2-right.svg" alt="Next"></picture>
                        </div>
                    </div>
                </div>
                <div class="interested__content">
                    <div class="interested__slider _swiper">
                        <?php foreach ($products_more as $item) { ?>
                            <?php $this->load->view("layouts/pages/product", array('item' => $item, 'class_catalog' => 'interested__product')); ?>
                        <?php } ?>
                    </div>
                    <!-- <div class="interested__paggination"></div> -->
                </div>
            </div>
        </section>
    <?php } ?>
</main>
<?php if (!empty($messaje)) { ?>
    <div id="popup_success" class="quiz">
        <div class="popup_bg"></div>
        <div class="popup-block quiz__form-wrapper">
            <a href="/en" class="main-header__logo">mscards<span>.ro</span></a>
            <h1 class="popup-block__title"><?= $messaje ?></h1>
        </div>
    </div>
<?php } ?>
<div class="popup popup_request request-popup ">
    <div class="popup__content">
        <div class="popup__body">
            <div class="popup__close"></div>
            <h3 class="request-popup__title"><?= SUBMIT_AN_INQUIRY ?></h3>
            <p class="request-popup__text"><?= SUBMIT_AN_INQUIRY_INFO ?></p>
            <form action="/<?= $uri1 ?>/<?= $uri2 ?>/<?= $uri3 ?>/<?= $uri4 ?>" class="request-popup__form"
                  method="post">
                <input type="hidden" name="product" id="input-request-product" value="<?= $product->id ?>">
                <div class="request-popup__row">
                    <label for="input-request-name" class="request-popup__label"><?= YOUR_NAME ?></label>
                    <input type="text" name="name" id="input-request-name" class="request-popup__input">
                </div>
                <div class="request-popup__row">
                    <label for="input-request-phone" class="request-popup__label"><?= YOUR_PHONE ?></label>
                    <input type="tel" name="phone" id="input-request-phone" class="request-popup__input">
                </div>
                <div class="request-popup__row">
                    <label for="input-request-email" class="request-popup__label"><?= THE_EMAIL ?></label>
                    <input type="email" name="email" id="input-request-email" class="request-popup__input">
                </div>
                <div class="request-popup__row">
                    <label for="input-request-message" class="request-popup__label"><?= YOUR_MESSAGE ?></label>
                    <textarea name="message" id="input-request-message" class="request-popup__textarea"></textarea>
                </div>
                <div class="request-popup__row">
                    <button type="submit" class="request-popup__button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.91202 11.9998H4.00002L2.02302 4.1348C2.01036 4.0891 2.00265 4.04216 2.00002 3.9948C1.97802 3.2738 2.77202 2.7738 3.46002 3.1038L22 11.9998L3.46002 20.8958C2.78002 21.2228 1.99602 20.7368 2.00002 20.0288C2.00204 19.9655 2.01316 19.9029 2.03302 19.8428L3.50002 14.9998"
                                  stroke="#2779F6" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                        </svg>
                        <?= SEND ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>