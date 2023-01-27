<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/"><?= lang('Home') ?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?= $title ?></span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"><?= $title ?></h1>
<!-- END PAGE TITLE-->

<?php // Отображаем сообщения пользователю ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-block alert-success fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-block alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?php foreach ($_SESSION['error'] as $error) : ?>
            <?= $error ?>
            <br/>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="row">
    <div class="portlet bordered">
        <div class="accordion" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i
                                    class="fa fa-plus"></i> <?= $add ?></a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <form class="add" action="<?= $a_path ?>" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab"><?= lang('General information') ?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"><?= lang('SEO') ?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_5" data-toggle="tab"><?= lang('Price') ?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_6" data-toggle="tab"><?= lang('Related products') ?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td width="200"><?= lang('Parent category') ?> *</td>
                                                <td>
                                                    <div id="category_id" style="margin: 20px;"></div>
                                                    <input type="hidden" name="category_id" value="0" required>
                                                </td>
                                            </tr>
                                            <?php if (!empty($filter_groups)) { ?>
                                                <tr>
                                                    <td><?= lang('Filter group') ?> *</td>
                                                    <td>
                                                        <select name="filter_group_id" class="form-control" required>
                                                            <?php foreach ($filter_groups as $filter_group) { ?>
                                                                <option value="<?= $filter_group->id ?>"><?= $filter_group->{'title' . get_language_for_list(true)} ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td width="200"><?= lang('Code') ?></td>
                                                <td>
                                                    <input type="text" name="code" class="form-control"
                                                           value="">
                                                </td>
                                            </tr>
                                            <?php foreach (language(true) as $lang) { ?>
                                                <tr>
                                                    <td width="200"><?= lang('Name') ?> <?= strtoupper($lang) ?> *</td>
                                                    <td>
                                                        <input type="text" name="title<?= strtoupper($lang) ?>"
                                                               class="form-control" required>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php foreach (language(true) as $lang) { ?>
                                                <tr>
                                                    <td width="200"><?= lang('Text') ?> <?= strtoupper($lang) ?></td>
                                                    <td>
                                                        <textarea name="text<?= strtoupper($lang) ?>" cols="30" rows="3"
                                                                  class="form-control ckeditor"></textarea>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <!--<tr>
                                                <td width="200"><? /*=lang('Price')*/ ?>, MDL *</td>
                                                <td>
                                                    <input type="number" step="0.01" name="price" class="form-control"
                                                           value="" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="200"><? /*=lang('Lower price')*/ ?>, MDL *</td>
                                                <td>
                                                    <input type="number" step="0.01" name="discounted_price" class="form-control"
                                                           value="">
                                                </td>
                                            </tr>-->
                                            <tr>
                                                <td width="200"><?= lang('Qty') ?></td>
                                                <td>
                                                    <input type="number" step="1" name="qty" class="form-control"
                                                           value="">
                                                </td>
                                            </tr>
                                            <?php foreach (language(true) as $lang) { ?>
                                                <tr>
                                                    <td width="200"><?= lang('Promotion Info') ?> <?= strtoupper($lang) ?></td>
                                                    <td>
                                                        <input type="text" name="promoInfo<?= strtoupper($lang) ?>"
                                                               class="form-control">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td width="200">&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                        <?= lang('Add') ?>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1_2">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <?php foreach (language(true) as $lang) { ?>
                                                <tr>
                                                    <td width="200"><?= lang('Headline') ?> <?= strtoupper($lang) ?></td>
                                                    <td>
                                                        <input type="text" name="seoTitle<?= strtoupper($lang) ?>"
                                                               class="form-control">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php foreach (language(true) as $lang) { ?>
                                                <tr>
                                                    <td width="200"><?= lang('Keywords') ?> <?= strtoupper($lang) ?></td>
                                                    <td>
                                                        <textarea name="seoKeywords<?= strtoupper($lang) ?>" cols="30"
                                                                  rows="3" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php foreach (language(true) as $lang) { ?>
                                                <tr>
                                                    <td width="200"><?= lang('Description') ?> <?= strtoupper($lang) ?></td>
                                                    <td>
                                                        <textarea name="seoDesc<?= strtoupper($lang) ?>" cols="30"
                                                                  rows="3" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td width="200">&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                        <?= lang('Add') ?>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1_5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php foreach ($bulks as $key => $bulk) { ?>
                                                <div class="tr-flex" style="gap: 10px;">
                                                    <label for="pq<?= $key ?>">
                                                        <?= lang('Qty') ?>
                                                        <input id="pq<?= $key ?>" type="text" value="<?= $bulk->qty ?>"
                                                               name="product_prices[<?= $key ?>][qty]"
                                                               class="form-control disabled" >
                                                    </label>
                                                    <label for="pp<?= $key ?>">
                                                        <?= lang('Price') ?>
                                                        <input id="pp<?= $key ?>" type="text" value=""
                                                               name="product_prices[<?= $key ?>][price]"
                                                               class="form-control">
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                <?= lang('Add') ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1_6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if (!empty($products)) { ?>
                                                <select multiple="multiple" id="my-select" name="related_products[]">
                                                    <?php foreach ($products as $product) { ?>
                                                        <option value='<?= $product->id ?>'>
                                                            <?= trim($product->{'title' . get_language_for_list(true)}) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                <?= lang('Add') ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="portlet light">
        <div class="portlet-body">
            <form action="">
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-md-2">
                        <input class="form-control" name="search" value="<?= @$_GET['search'] ?>" type="text"
                               placeholder="<?= lang('Search') ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> <?= lang('Search') ?>
                        </button>
                        <?php if (isset($_GET['search']) && !empty($_GET['search'])) { ?>
                            <a href="<?= $path; ?>" type="submit" class="btn red"><i
                                        class="fa fa-remove"></i> <?= lang('Delete') ?></a>
                        <?php } ?>
                    </div>
                </div>
            </form>
            <?php if (!empty($products)) : ?>
                <form action="<?= $o_path; ?>" method="post">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-striped table-hover tree">
                            <tbody>
                            <?php if (isset($_GET['search']) && !empty($_GET['search'])) { ?>
                            <thead>
                            <tr>
                                <th><?= lang('Name') ?></th>
                                <th width="100" class="mine-center-item"><?= lang('On site') ?></th>
                                <th width="300" class="mine-center-item"> <?= lang('Action') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $item): ?>
                                <tr style="height: 51px;">
                                    <td class="align-middle"><a style="font-weight: 900;"
                                                                href="<?= $e_path . $item->id; ?>"><?= $item->{'title' . get_language_for_list(true)} ?></a>
                                    </td>
                                    <td class="align-middle">
                                        <?php $cmod = (!empty($item->isShown)) ? 'checked' : '' ?>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input data-col="isShown" data-table="<?= $table ?>"
                                                   type="checkbox" <?= $cmod ?> value="<?= $item->id ?>"
                                                   class="mine_change_check">&nbsp;
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?= $e_path . $item->id . '/' ?>"
                                           class="btn green">
                                            <i class="fa fa-pencil"></i> <?= lang('Edit') ?>
                                        </a>
                                        <a href="<?= $del_path . $item->id . '/' ?>"
                                           class="btn red mine_delete_row">
                                            <i class="fa fa-trash"></i> <?= lang('Delete') ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php } else { ?>
                                <?php $ids = array_map(function ($item) {
                                    return $item->category_id;
                                }, $products); ?>
                                <?php $ids = array_unique($ids);
                                sort($ids); ?>
                                <?php admin_categories_tree_with_products($categories, $table, $ids, $products, $e_path, $del_path); ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> <?= lang('Refresh order') ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="/static/assets/plugins/treeGrid/js/jquery.treegrid.js"></script>
<script src="/static/assets/plugins/treeGrid/js/jquery.treegrid.bootstrap3.js"></script>
<link href="/static/assets/plugins/treeGrid/css/jquery.treegrid.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    $(document).ready(function () {
        $('.tree').treegrid({
            initialState: 'collapsed',
            treeColumn: 0,
        });
    });
</script>

<link href="/static/assets/global/plugins/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css"/>
<script src="/static/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>

<script>
    $(function () {

        $(document).on("submit", "form.add", function (e) {
            var category_id = parseInt($(this).closest('form').find('input[name="category_id"]').val());

            if (category_id && category_id != 0) {
                //toastr["success"]("Нужно");
            } else {
                e.preventDefault();
                toastr["error"]("<?=lang('You need to select a parent category')?>");
            }
        });

        $('#category_id').on('changed.jstree', function (e, data) {
            if (data.action == 'select_node') {
                $('[type="hidden"][name="category_id"]').val(data.node.id);
                toastr["success"]("<?=lang('Category selected')?>.");
            }
        }).jstree({
            'core': {
                'data': [<?=$categories_json?>]
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.category_ajax', function (event) {
            event.preventDefault();

            var current = $(this);
            var icon = current.find('i');
            var text = current.find('span');
            var table_products = current.closest('td').find('table');
            var td = current.closest('td');
            var count = 1;
            td.find(".treegrid-indent").each(function (index) {
                count++;
            });
            var padding = count * 30;

            table_products.find(' tbody tr th:first-child').css("padding-left", padding + "px");
            table_products.find(' tbody tr td:first-child').css("padding-left", padding + "px");

            if ($(table_products).hasClass('table-hide')) {
                $(table_products).removeClass('table-hide');
                $(icon).removeClass('fa-plus').addClass('fa-minus');
                text.html('<?=lang('Hide products')?>');
            } else {
                $(table_products).addClass('table-hide');
                $(icon).removeClass('fa-minus').addClass('fa-plus');
                text.html('<?=lang('Show products')?>');
            }
        });
    });
</script>
<style>
    .all_product .treegrid-parent-0 .sorder_id span {
        display: none;
    }
</style>
