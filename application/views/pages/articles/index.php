<main class="page">
    <section class="breadcrums">
        <div class="breadcrums__container _container">
            <ul class="breadcrums__list">
                <li class="breadcrums__item">
                    <a href="/<?=$lclang?>" class="breadcrums__link"><?=$menu['all'][1]->title?></a>
                </li>
                <li class="breadcrums__item">
                    <span class="breadcrums__link"><?=$page_name?></span>
                </li>
            </ul>
        </div>
    </section>
    <section class="blog">
        <div class="blog__container _container">
            <h2 class="blog__title"><?=$page_name?></h2>
            <div class="blog__content">
                <?php foreach ($articles as $article) { ?>
                    <?php $src = newthumbs($article->img, 'articles', 300, 180, '300x180x0', 0) ?>
                    <div class="blog__item item-blog">
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
</main>