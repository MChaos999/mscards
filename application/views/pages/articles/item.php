<main class="page">
    <section class="breadcrums">
        <div class="breadcrums__container _container">
            <ul class="breadcrums__list">
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>" class="breadcrums__link"><?= $menu['all'][1]->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>"
                       class="breadcrums__link"><?= $menu['all'][5]->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <span class="breadcrums__link"><?= $page_name ?></span>
                </li>
            </ul>
        </div>
    </section>
    <section class="blog-page">
        <div class="blog-page__container _container">
            <div class="blog-page__wrapper">
                <article class="blog-page__head">
                    <h2 class="blog-page__title"><?= $page_name ?></h2>
                    <p class="blog-page__date"><?= date('d/m/Y', strtotime($article->date)) ?></p>
                </article>
                <div class="blog-page__content">
                    <div class="blog-page__image">
                        <?php $src = newthumbs($article->img, 'articles') ?>
                        <picture>
                            <source srcset="<?= $src ?>" type="image/webp">
                            <img src="<?= $src ?>" alt="Image"></picture>
                    </div>
                    <div class="blog-page__body">
                        <div class="blog-page__row">
                            <?= $article->text ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-page__footer">
                <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>" class="blog-page__back"><?= BACK_TO_LIST ?></a>
            </div>
        </div>
    </section>
    <section class="other-blog">
        <div class="other-blog__container _container">
            <h2 class="other-blog__title"><?= OTHER_ARTICLES ?></h2>
            <div class="other-blog__content">
                <?php $i = 0; foreach ($articles_more as $article_more) { ?>
                    <?php if ($article_more->id != $article->id) { ?>
                        <?php $src = newthumbs($article_more->img, 'articles', 300, 180, '300x180x0', 0) ?>
                        <div class="other-blog__item item-blog">
                            <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>/<?= $article_more->uri ?>"
                               class="item-blog__image">
                                <picture>
                                    <source srcset="<?= $src ?>" type="image/webp">
                                    <img src="<?= $src ?>" alt="Image"></picture>
                            </a>
                            <div class="item-blog__body">
                                <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>/<?= $article_more->uri ?>"
                                   class="item-blog__name"><?= $article_more->title ?> </a>
                                <a href="/<?= $lclang ?>/<?= $menu['all'][5]->uri ?>/<?= $article_more->uri ?>"
                                   class="item-blog__more"><?= TO_READ ?></a>
                            </div>
                        </div>
                    <?php $i = $i + 1; } ?>
                    <?php if ($i > 4) break;?>
                <?php } ?>
            </div>
        </div>
    </section>
</main>