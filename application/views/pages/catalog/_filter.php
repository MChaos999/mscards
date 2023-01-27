<div class="catalog-market__content">
    <?php foreach ($products as $product) { ?>
        <?php $this->load->view("layouts/pages/product", array('item' => $product, 'class_catalog' => $class_catalog)); ?>
    <?php } ?>
</div>
<? $this->load->view('layouts/pages/paginator'); ?>