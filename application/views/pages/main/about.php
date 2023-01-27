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
    <section class="about">
        <div class="about__container _container">
            <h2 class="about__title"><?=$page_name?></h2>
            <div class="about__content">
                <div class="about__description">
                    <?=$page->text?>
                </div>
                <div class="about__image">
                    <?php $src = newthumbs($page->img, "menu") ?>
                    <picture>
                        <source srcset="<?=$src?>" type="image/webp">
                        <img src="<?=$src?>" alt="image"></picture>
                </div>
            </div>
        </div>
    </section>
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
</main>