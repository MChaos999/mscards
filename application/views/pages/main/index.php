<main class="page">
    <section class="banner">
        <div class="banner__container _container">
            <div class="banner__content">
                <div class="banner__slider _swiper">
                    <?php foreach ($sliders as $slider) { ?>
                        <?php $src = newthumbs($slider->img, 'slider', 1300, 540, '1300x540x0', 0) ?>
                        <div class="banner__item">
                            <picture>
                                <source srcset="<?= $src ?>" type="image/webp">
                                <img src="<?= $src ?>" alt="Banner-image"></picture>
                        </div>
                    <?php } ?>
                </div>
                <div class="banner__arrow banner-arrow-prev">
                    <picture>
                        <source srcset="/app/img/icons/prev-slider.svg" type="image/webp">
                        <img src="/app/img/icons/prev-slider.svg" alt="Prev"></picture>
                </div>
                <div class="banner__arrow banner-arrow-next">
                    <picture>
                        <source srcset="/app/img/icons/next-slider.svg" type="image/webp">
                        <img src="/app/img/icons/next-slider.svg" alt="Next"></picture>
                </div>
                <div class="banner__paggination"></div>
            </div>
        </div>
    </section>
    <?php if (!empty($home_categories)) { ?>
        <section class="catalog">
            <div class="catalog__container _container">
                <div class="catalog__content">
                    <?php foreach ($home_categories as $home_category) { ?>
                        <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>/<?= $home_category->uri ?>"
                           class="catalog__item">
                            <div class="catalog__info">
                                <p class="catalog__name"><?= $home_category->title ?></p>
                                <p class="catalog__goto"><?= TO_CATALOG ?></p>
                            </div>
                            <div class="catalog__image">
                                <?php $src = newthumbs($home_category->img, 'categories', 150, 150, '150x150x0', 0) ?>
                                <picture>
                                    <source srcset="<?= $src ?>" type="image/webp">
                                    <img src="<?= $src ?>" alt="Image"></picture>
                            </div>
                        </a>
                    <?php } ?>
                    <a href="#" class="catalog__item _sale">
                        <div class="catalog__info">
                            <p class="catalog__name"><?= PROMOTIONS ?> </p>
                            <p class="catalog__goto"><?= TO_CATALOG ?></p>
                        </div>
                        <div class="catalog__image">
                            <picture>
                                <source srcset="/app/img/catalog/08.webp" type="image/webp">
                                <img src="/app/img/catalog/08.png" alt="Image"></picture>
                        </div>
                    </a>
                </div>
                <a href="/<?= $lclang ?>/<?= $menu['all'][3]->uri ?>" class="catalog__more"><?= SEE_CATALOG ?></a>
            </div>
        </section>
    <?php } ?>
    <?php if (!empty($products_promo)) { ?>
        <section class="specials">
            <div class="specials__container _container">
                <h2 class="specials__title _title"><?= SPECIAL_OFFER ?></h2>
                <div class="specials__content">
                    <?php foreach ($products_promo as $product) { ?>
                        <?php $this->load->view("layouts/pages/product", array('item' => $product, 'class_catalog'=>'specials__product')); ?>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php if (!empty($benefits)) { ?>
        <section class="advantage">
            <div class="advantage__container _container">
                <div class="advantage__content">
                    <?php foreach ($benefits as $benefit) { ?>
                        <div class="advantage__item">
                            <div class="advantage__icon">
                                <picture>
                                    <?php $src = newthumbs($benefit->img, 'benefits') ?>
                                    <source srcset="<?= $src ?>" type="image/webp">
                                    <img src="<?= $src ?>" alt="Icon"></picture>
                            </div>
                            <p class="advantage__text">
                                <?= $benefit->title ?>
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <?php if (!empty($articles)) { ?>
        <section class="mini-blog">
            <div class="mini-blog__container _container">
                <div class="mini-blog__head">
                    <h2 class="mini-blog__title _title"><?= $menu['all'][5]->title ?></h2>
                    <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>"
                       class="mini-blog__more"><?= ALL_ARTICLES ?></a>
                </div>
                <div class="mini-blog__content">
                    <?php foreach ($articles as $article) { ?>
                        <?php $src = newthumbs($article->img, 'articles', 300, 180, '300x180x0', 0) ?>
                        <div class="mini-blog__item item-blog">
                            <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>/<?= $article->uri ?>"
                               class="item-blog__image">
                                <picture>
                                    <source srcset="<?= $src ?>" type="image/webp">
                                    <img src="<?= $src ?>" alt="Image"></picture>
                            </a>
                            <div class="item-blog__body">
                                <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>/<?= $article->uri ?>"
                                   class="item-blog__name"><?= $article->title ?> </a>
                                <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>/<?= $article->uri ?>"
                                   class="item-blog__more"><?= TO_READ ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
</main>