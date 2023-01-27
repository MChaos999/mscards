<header class="header _first-page">
    <div class="header__top top-header">
        <div class="top-header__container _container">
            <nav class="top-header__navigation navigation-top-header">
                <ul class="navigation-top-header__list">
                    <?php if (!empty($menu['top'])) { ?>
                        <?php foreach ($menu['top'] as $nav) { ?>
                            <li class="navigation-top-header__item">
                                <a href="/<?= $lclang ?>/<?= $nav->uri ?>"
                                   class="navigation-top-header__link"><?= $nav->title ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </nav>
            <div class="top-header__actions">
                <div class="top-header__contacts">
                    <a href="tel:<?= CONTACTPHONE ?>" class="top-header__contact _phone"><?= CONTACTPHONE ?></a>
                    <a href="mailto:<?= CONTACTEMAIL ?>" class="top-header__contact _mail"><?= CONTACTEMAIL ?></a>
                </div>
                <?php select_language($clang, $lang_urls); ?>
            </div>
        </div>
    </div>
    <div class="header__main main-header">
        <div class="main-header__container _container">
            <a href="/<?= $lclang ?>" class="main-header__logo">mscards<span>.ro</span></a>
            <div class="main-header__catalog catalog-header">
                <div class="catalog-header__head">
                    <div class="catalog-header__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span class="catalog-header__name"><?= CATALOG ?></span>
                </div>
                <div class="catalog-header__body">
                    <ul class="catalog-header__list">
                        <?php if (!empty($categories_onPromotion)) { ?>
                            <li class="catalog-header__item _more _sale">
                                <a href="#" class="catalog-header__link"><?= PROMOTIONS ?></a>
                                <ul class="catalog-header__sublist">
                                    <?php foreach ($categories_onPromotion as $cat_nav) { ?>
                                        <li class="catalog-header__subitem">
                                            <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $cat_nav->uri ?>"
                                               class="catalog-header__sublink"><?= $cat_nav->title ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if (!empty($categories)) { ?>
                            <?php foreach ($categories as $category_nav) { ?>
                                <li class="catalog-header__item <?php if (!empty($category_nav->children)) { ?>_more<?php } ?>">
                                    <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $category_nav->uri ?>"
                                       class="catalog-header__link"><?= $category_nav->title ?></a>
                                    <ul class="catalog-header__sublist">
                                        <?php if (!empty($category_nav->children)) { ?>
                                            <?php foreach ($category_nav->children as $children_nav) { ?>
                                                <li class="catalog-header__subitem">
                                                    <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $children_nav->uri ?>"
                                                       class="catalog-header__sublink"><?= $children_nav->title ?></a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="main-header__menu menu">
                <div class="menu__icon icon-menu">
                    <div>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <p><?= MENU ?></p>
                </div>
                <div class="menu__content">
                    <div class="menu__head head-menu">
                        <a href="/<?= $lclang ?>" class="head-menu__logo">mscards<span>.ro</span></a>
                        <div class="head-menu__close">
                            <picture>
                                <source srcset="/app/img/icons/close.svg" type="image/webp">
                                <img src="/app/img/icons/close.svg" alt="Close-menu"></picture>
                        </div>
                    </div>
                    <div class="menu__body">
                        <form action="/<?= $lclang ?>/<?= $menu['all'][10]->uri ?>" class="menu__search search-menu" method="get">
                            <input type="text" name="search" placeholder="Поиск" class="search-menu__input">
                            <button type="submit" class="search-menu__btn">
                                <picture>
                                    <source srcset="/app/img/icons/search.svg" type="image/webp">
                                    <img src="/app/img/icons/search.svg" alt="Search"></picture>
                            </button>
                        </form>
                        <div class="menu__catalog catalog-menu">
                            <div class="catalog-menu__head">
                                <p>Каталог</p>
                            </div>
                            <div class="catalog-menu__body body-catalog-menu">
                                <div class="body-catalog-menu__head">
                                    <p class="body-catalog-menu__title"><?= CATALOG ?></p>
                                    <div class="body-catalog-menu__back">
                                        <picture>
                                            <source srcset="/app/img/icons/back-blue.svg" type="image/webp">
                                            <img src="/app/img/icons/back-blue.svg" alt="Back"></picture>
                                    </div>
                                </div>
                                <ul class="body-catalog-menu__list">
                                    <li class="body-catalog-menu__item _more _sale">
                                        <a href="#" class="body-catalog-menu__link"><?= PROMOTIONS ?></a>
                                        <div class="body-catalog-menu__subbody">
                                            <div class="body-catalog-menu__subhead">
                                                <div class="body-catalog-menu__subback">
                                                    <picture>
                                                        <source srcset="/app/img/icons/back-blue.svg" type="image/webp">
                                                        <img src="/app/img/icons/back-blue.svg" alt="Back"></picture>
                                                </div>
                                                <p class="body-catalog-menu__subtitle"><?= PROMOTIONS ?></p>
                                            </div>
                                            <?php if (!empty($categories_onPromotion)) { ?>
                                                <ul class="body-catalog-menu__sublist">
                                                    <?php foreach ($categories_onPromotion as $cat_nav) { ?>
                                                        <li class="body-catalog-menu__subitem">
                                                            <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $cat_nav->uri ?>"
                                                               class="body-catalog-menu__sublink"><?= $cat_nav->title ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    <?php if (!empty($categories)) { ?>
                                        <?php foreach ($categories as $category_nav) { ?>
                                            <li class="body-catalog-menu__item <?php if (!empty($category_nav->children)) { ?>_more<?php } ?>">
                                                <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $category_nav->uri ?>"
                                                   class="body-catalog-menu__link"><?= $category_nav->title ?></a>
                                                <div class="body-catalog-menu__subbody">
                                                    <div class="body-catalog-menu__subhead">
                                                        <div class="body-catalog-menu__subback">
                                                            <picture>
                                                                <source srcset="/app/img/icons/back-blue.svg"
                                                                        type="image/webp">
                                                                <img src="/app/img/icons/back-blue.svg" alt="Back">
                                                            </picture>
                                                        </div>
                                                        <p class="body-catalog-menu__subtitle"><?= $category_nav->title ?></p>
                                                    </div>
                                                    <?php if (!empty($category_nav->children)) { ?>
                                                        <ul class="body-catalog-menu__sublist">
                                                            <?php foreach ($category_nav->children as $children_nav) { ?>
                                                                <li class="body-catalog-menu__subitem">
                                                                    <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $children_nav->uri ?>"
                                                                       class="body-catalog-menu__sublink"><?= $children_nav->title ?></a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php if (!empty($menu['top'])) { ?>
                        <?php foreach ($menu['top'] as $nav) { ?>
                        <ul class="menu__navigation navigation-menu">
                            <li class="navigation-menu__item">
                                <a href="<?= $lclang ?>/<?= $nav->uri ?>" class="navigation-menu__link"><?= $nav->title ?></a>
                            </li>
                        </ul>
                            <?php } ?>
                        <?php } ?>
                        <div class="menu__contacts contacts-menu">
                            <a href="tel:<?= CONTACTPHONE ?>" class="contacts-menu__contact _phone"><?= CONTACTPHONE ?></a>
                            <a href="mailto:<?= CONTACTEMAIL ?>"
                               class="contacts-menu__contact _mail"><?= CONTACTEMAIL ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/<?= $lclang ?>/<?= $menu['all'][10]->uri ?>" class="main-header__search search-header">
                <div class="search-header__head">
                    <picture>
                        <source srcset="/app/img/icons/search.svg" type="image/webp">
                        <img src="/app/img/icons/search.svg" alt="Open-search"></picture>
                </div>
                <div class="search-header__body">
                    <div class="search-header__content">
                        <input type="text" name="search" placeholder="<?= SEARCH ?>" class="search-header__input">
                        <button type="submit" class="search-header__btn">
                            <picture>
                                <source srcset="/app/img/icons/search.svg" type="image/webp">
                                <img src="/app/img/icons/search.svg" alt="Search"></picture>
                        </button>
                    </div>
                    <div class="search-header__close">
                        <picture>
                            <source srcset="/app/img/icons/close.svg" type="image/webp">
                            <img src="/app/img/icons/close.svg" alt="Close-search"></picture>
                    </div>
                </div>
            </form>
            <?php if (empty($total_price_cart)){?>
            <a href="javascript:;" data-uri="/<?=$lclang?>/<?=$menu['all']['11']->uri?>" data-curs="<?= EUR_SYMBOL ?>" class="main-header__cart"><?= CART_IS_EMPTY ?></a>
            <?php } else {?>
                <a href="/<?=$lclang?>/<?=$menu['all']['11']->uri?>" class="main-header__cart"><span><?=$total_price_cart?></span><?= EUR_SYMBOL ?></a>
            <?php } ?>
            <div class="cart_products_full">
                <?=MAXIMUM_QTY_PRODUCTS?> <span></span>
            </div>
        </div>
    </div>
</header>