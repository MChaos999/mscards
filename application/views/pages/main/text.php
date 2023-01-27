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
    <section class="contacts">
        <div class="contacts__container _container">
            <h2 class="contacts__title"><?=$page_name?></h2>
            <div class="contacts__content">
                <?=$text_for_layout?>
            </div>
        </div>
    </section>
</main>