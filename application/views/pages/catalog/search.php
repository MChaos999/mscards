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
    <section class="market">
        <div class="market__container _container">
            <div class="market__head head-market">
                <h2 class="head-market__title" data-category_id="0"><?=$page_name?></h2>
                <span class="head-market__count"><?=$count_products?> <?=COUNT_PRODUSE?></span>
            </div>
            <div class="market__actions actions-market">
                <div class="actions-market__selects selects-actions-market">
                    <div class="selects-actions-market__item _sort">
                        <input type="hidden" name="get_search" value="<?=$_GET['search']?>">
                        <p><?=SORT?></p>
                        <div class="selects-actions-market__select">
                            <select name="sort">
                                <option value="1"><?=BY_PRICE_LOWEST?></option>
                                <option value="2"><?=BY_PRICE_LARGEST?></option>
                                <option value="3"><?=PROMOTIONS?></option>
                                <option value="4" selected="selected"><?=POPULARITY?></option>
                            </select>
                        </div>
                    </div>
                    <div class="selects-actions-market__item _counts">
                        <p><?=SHOW_ON_PAGE?></p>
                        <div class="selects-actions-market__select">
                            <select name="counts_view">
                                <option value="16" selected="selected">16</option>
                                <option value="24">24</option>
                                <option value="28">28</option>
                                <option value="32">32</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="market__body">
                <div class="market__catalog catalog-market">
                    <div class="catalog-market__content">
                        <?php foreach ($products as $product) { ?>
                            <?php $this->load->view("layouts/pages/product", array('item' => $product, 'class_catalog'=>'specials__product')); ?>
                        <?php } ?>
                    </div>
                    <? $this->load->view('layouts/pages/paginator'); ?>
                </div>
            </div>
        </div>
    </section>
</main>