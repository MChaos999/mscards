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
                    <span class="breadcrums__link"><?= $page_name ?></span>
                </li>
            </ul>
        </div>
    </section>
    <section class="market">
        <div class="market__container _container">
            <div class="market__head head-market">
                <h2 class="head-market__title" data-category_id="<?=$category->id?>"><?= $page_name ?></h2>
                <span class="head-market__count"><span><?= $count_products ?></span> <?= COUNT_PRODUSE ?></span>
            </div>
            <?php if (!empty($products)){?>
            <div class="market__actions actions-market">
                <div class="actions-market__filter">
                    <picture>
                        <source srcset="/app/img/icons/filter.svg" type="image/webp">
                        <img src="/app/img/icons/filter.svg" alt="Icon"></picture>
                    <span><?=FILTER?></span>
                </div>
                <div class="actions-market__selects selects-actions-market">
                    <div class="selects-actions-market__item _sort">
                        <p><?=SORT?></p>
                        <div class="selects-actions-market__select">
                            <select name="sort">
                                <option value="1" <?php if(!empty($_GET['sort']) && $_GET['sort'] == 1) echo 'selected="selected"'?>><?=BY_PRICE_LOWEST?></option>
                                <option value="2" <?php if(!empty($_GET['sort']) && $_GET['sort'] == 2) echo 'selected="selected"'?>><?=BY_PRICE_LARGEST?></option>
                                <option value="3" <?php if(!empty($_GET['sort']) && $_GET['sort'] == 3) echo 'selected="selected"'?>><?=PROMOTIONS?></option>
                                <option value="4" <?php if(!empty($_GET['sort']) && $_GET['sort'] == 4) echo 'selected="selected"'?><?php if(empty($_GET['sort'])) echo 'selected="selected"'?>><?=POPULARITY?></option>
                            </select>
                        </div>
                    </div>
                    <div class="selects-actions-market__item _counts">
                        <p><?=SHOW_ON_PAGE?></p>
                        <div class="selects-actions-market__select">
                            <select name="counts_view">
                                <option value="16" selected="selected">16</option>
                                <option value="24" <?php if(!empty($_GET['view']) && $_GET['view'] == 24) echo 'selected="selected"'?>>24</option>
                                <option value="28" <?php if(!empty($_GET['view']) && $_GET['view'] == 28) echo 'selected="selected"'?>>28</option>
                                <option value="32" <?php if(!empty($_GET['view']) && $_GET['view'] == 32) echo 'selected="selected"'?>>32</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="market__body">
                <div class="market__sidebar sidebar-market">
                    <?php if (!empty($category_filters)) { ?>
                        <form action="#" class="sidebar-market__form">
                            <div class="sidebar-market__top">
                                <div class="sidebar-market__title">
                                    <picture>
                                        <source srcset="/app/img/icons/filter.svg" type="image/webp">
                                        <img src="/app/img/icons/filter.svg" alt="Filter"></picture>
                                    <span><?=FILTER?></span>
                                </div>
                                <button type="reset" class="sidebar-market__clear"><?=CLEAR?></button>
                                <div class="sidebar-market__close">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13 14.148L18.9248 20.0743L20.0753 18.9255L14.1489 12.9991L20.0753 7.07433L18.9264 5.92383L13 11.8502L7.07527 5.92383L5.92639 7.07433L11.8511 12.9991L5.92639 18.9238L7.07527 20.0743L13 14.148Z"
                                              fill="#A4A4A4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="sidebar-market__body _spollers">
                                <?php foreach ($category_filters

                                               as $filter) { ?>
                                    <?php if (!empty($filter->values)) {
                                        $filter->values = json_decode($filter->values,true); ?>
                                        <div class="sidebar-market__row">
                                            <div class="sidebar-market__head _spoller">
                                                <p class="sidebar-market__name"><?= $filter->title ?></p>
                                                <div class="sidebar-market__arrow">
                                                    <picture>
                                                        <source srcset="/app/img/icons/more-black.svg"
                                                                type="image/webp">
                                                        <img src="/app/img/icons/more-black.svg" alt="Arrow"></picture>
                                                </div>
                                            </div>
                                            <ul class="sidebar-market__list">
                                                <?php foreach ($filter->values as $value) { ?>
                                                    <li class="sidebar-market__item">
                                                        <label class="sidebar-market__checkbox checkbox">
                                                            <input class="checkbox__input filter_checkbox" type="checkbox" value="<?=$value['value']?>"
                                                                   name="fl[]"
                                                            <?php if (!empty($_GET['fl'])){
                                                                foreach ($_GET['fl'] as $fl){
                                                                    if ($fl == $value['value']){
                                                                        echo 'checked';
                                                                    }
                                                                }
                                                            } ?>
                                                            >
                                                            <span class="checkbox__text"><?=$value['value']?></span>
                                                        </label>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="market__catalog catalog-market">
                    <div class="catalog-market__content">
                        <?php foreach ($products as $product) { ?>
                            <?php $this->load->view("layouts/pages/product", array('item' => $product, 'class_catalog' => 'catalog-market__product')); ?>
                        <?php } ?>
                    </div>
                    <? $this->load->view('layouts/pages/paginator'); ?>
                </div>
            </div>
            <?php } ?>
            <div class="market__body_text">
                <?=$category->text?>
            </div>
        </div>
    </section>
</main>