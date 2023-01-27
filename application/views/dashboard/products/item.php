<?php $lastwo = substr($item->id, -2); ?>
<?php $finmedia = array();?>
<?php if (!empty($media)){ ?>
    <?php foreach ($media as $img){ ?>
        <?php if (!empty($img->img)): ?>
            <?php $finmedia[$img->id] = newthumbs($img->img, "product_images/$lastwo/$item->id", 256, 256, '256x256x1', 1) ?>
        <?php endif; ?>
    <?php }?>
<?php }?>
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/"><?=lang('Home')?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= $parent_url ?>"><?= $parent_title ?></a>
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
    <div class="portlet light">
        <div class="portlet-body">
            <form class="edit" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class="<?=(isset($_SESSION['tab_id']) && $_SESSION['tab_id'] == 1) ? "active" : ""?>">
                            <a href="#tab_1_1" data-toggle="tab"><?=lang('General information')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab"><?=lang('SEO')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab"><?=lang('Filters')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_4" data-toggle="tab"><?=lang('Images')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_5" data-toggle="tab"><?=lang('Price')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_7" data-toggle="tab"><?=lang('Options')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_6" data-toggle="tab"><?=lang('Related products')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_8" data-toggle="tab"><?=lang('More products')?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade <?=((isset($_SESSION['tab_id']) && $_SESSION['tab_id'] == 1)) ? "active in" : ""?>" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td width="200"><?=lang('Parent category')?> *</td>
                                        <td>
                                            <div id="category_id" style="margin: 20px;"></div>
                                            <input type="hidden" name="category_id" value="<?=$item->category_id?>" required>
                                        </td>
                                    </tr>
                                    <?php if(!empty($filter_groups)){?>
                                        <tr>
                                            <td><?=lang('Filter group')?> *</td>
                                            <td>
                                                <select name="filter_group_id" class="form-control" required>
                                                    <?php foreach($filter_groups as $filter_group){?>
                                                        <option <?=($filter_group->id == $item->filter_group_id) ? "selected" : "" ?> value="<?=$filter_group->id?>"><?=$filter_group->{'title'.get_language_for_list(true)}?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <tr>
                                        <td width="200"><?=lang('Code')?></td>
                                        <td>
                                            <input type="text" name="code" class="form-control"
                                                   value="<?=$item->code?>">
                                        </td>
                                    </tr>
                                    <?php foreach(language(true) as $lang){ ?>
                                        <tr>
                                            <td width="200"><?=lang('Name')?> <?=strtoupper($lang)?> *</td>
                                            <td>
                                                <input type="text" name="title<?=strtoupper($lang)?>" class="form-control"
                                                       value="<?= $item->{'title'.strtoupper($lang)} ?>" required>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <?php foreach(language(true) as $lang){ ?>
                                        <tr>
                                            <td width="200"><?=lang('Text')?> <?=strtoupper($lang)?></td>
                                            <td>
                                                <textarea name="text<?=strtoupper($lang)?>" cols="30" rows="3"
                                                          class="form-control ckeditor"><?= $item->{'text'.strtoupper($lang)} ?></textarea>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <!--<tr>
                                        <td width="200"><?/*=lang('Price')*/?>, MDL *</td>
                                        <td>
                                            <input type="number" step="0.01" name="price" class="form-control"
                                                   value="<?/*= $item->price*/?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200"><?/*=lang('Lower price')*/?>, MDL *</td>
                                        <td>
                                            <input type="number" step="0.01" name="discounted_price" class="form-control"
                                                   value="<?/*= $item->discounted_price*/?>">
                                        </td>
                                    </tr>-->
                                    <tr>
                                        <td width="200"><?=lang('Qty')?></td>
                                        <td>
                                            <input type="number" step="1" name="qty" class="form-control"
                                                   value="<?= $item->qty?>">
                                        </td>
                                    </tr>
                                    <?php foreach (language(true) as $lang) { ?>
                                        <tr>
                                            <td width="200"><?= lang('Promotion Info') ?> <?= strtoupper($lang) ?></td>
                                            <td>
                                                <input type="text" name="promoInfo<?= strtoupper($lang) ?>"
                                                       value="<?= $item->{'promoInfo'.strtoupper($lang)} ?>"
                                                       class="form-control">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach (language(true) as $lang) { ?>
                                    <tr>
                                        <td width="200"><?= lang('Doc PDF') ?> <?= strtoupper($lang) ?></td>
                                        <td>
                                            <input type="file" name="pdf<?= strtoupper($lang) ?>"
                                                   id="offers[<?= $item->id ?>][pdf<?= strtoupper($lang) ?>]"
                                                   class="form-control">
                                            <div class="note note-warning"
                                                 style="margin-bottom: 0px; margin-top: 10px;">
                                                <p>
                                                    <?=lang('Allowable sizes')?> : 50МБ
                                                </p>
                                                <?php if (!empty($item->{'pdf'.strtoupper($lang)})) { ?>
                                                    <p class="mt-element-card">
                                                        <a href="/public/products/<?= $item->{'pdf'.strtoupper($lang)} ?>" class="doc_view">
                                                            Посмотреть документ
                                                        </a>
                                                        <a class="btn red mine_clear_file"
                                                           data-table="products"
                                                           data-id="<?= $item->id ?>"
                                                           data-col="pdf"
                                                           data-lang="<?= strtoupper($lang) ?>"
                                                           href="javascript:;">
                                                            <i class="fa fa-ban"></i>
                                                        </a>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i><?=lang('Edit')?>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_1_6">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(!empty($products)) { ?>
                                        <select multiple="multiple" id="my-select" name="related_products[]">
                                            <?php foreach($products as $product) { ?>
                                                <?php if($product->id != $item->id) { ?>
                                                    <option value='<?= $product->id ?>'
                                                        <?= in_array($product->id, $related_products) ? 'selected' : '' ?>>
                                                        <?php $code = !empty($product->code) ? $product->code . " - " : '' ?>
                                                        <?= $code . trim($product->{'title'.get_language_for_list(true)}) ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                        <?=lang('Edit')?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_1_8">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(!empty($products)) { ?>
                                        <select multiple="multiple" id="my-select_more" name="more_products[]">
                                            <?php foreach($products as $product) { ?>
                                                <?php if($product->id != $item->id) { ?>
                                                    <option value='<?= $product->id ?>'
                                                        <?= in_array($product->id, $more_products) ? 'selected' : '' ?>>
                                                        <?php $code = !empty($product->code) ? $product->code . " - " : '' ?>
                                                        <?= $code . trim($product->{'title'.get_language_for_list(true)}) ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                        <?=lang('Edit')?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_1_2">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <?php foreach(language(true) as $lang){ ?>
                                        <tr>
                                            <td width="200"><?=lang('Headline')?> <?=strtoupper($lang)?></td>
                                            <td>
                                                <input type="text" name="seoTitle<?=strtoupper($lang)?>" class="form-control"
                                                       value="<?= $item->{'seoTitle'.strtoupper($lang)} ?>">
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <?php foreach(language(true) as $lang){ ?>
                                        <tr>
                                            <td width="200"><?=lang('Keywords')?> <?=strtoupper($lang)?></td>
                                            <td>
                                                <textarea name="seoKeywords<?=strtoupper($lang)?>" cols="30" rows="3"
                                                          class="form-control"><?= $item->{'seoKeywords'.strtoupper($lang)} ?></textarea>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <?php foreach(language(true) as $lang){ ?>
                                        <tr>
                                            <td width="200"><?=lang('Description')?> <?=strtoupper($lang)?></td>
                                            <td>
                                                <textarea name="seoDesc<?=strtoupper($lang)?>" cols="30" rows="3"
                                                          class="form-control"><?= $item->{'seoDesc'.strtoupper($lang)} ?></textarea>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i><?=lang('Edit')?>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_1_4">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td width="200"><?=lang('Photo')?></td>
                                        <td>
                                            <input type="file"
                                                   multiple
                                                   name="media[]" id="file"
                                                   class="form-control">
                                            <div class="note note-warning"
                                                 style="margin-bottom: 0; margin-top: 10px;">
                                                <p>
                                                    <?=lang('Allowable sizes')?>: 1500x1700
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit"
                                                    class="btn green"><i
                                                        class="fa fa-check"></i>
                                                <?=lang('Add')?>
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
                                    <?php foreach($bulks as $key=>$bulk){?>
                                        <div class="tr-flex" style="gap: 10px;">
                                            <label for="pq<?=$key?>">
                                                <?=lang('Qty')?>
                                                <input id="pq<?=$key?>" type="text" value="<?=$bulk->qty?>" name="product_prices[<?=$key?>][qty]" class="form-control" readonly>
                                            </label>
                                            <label for="pp<?=$key?>">
                                                <?=lang('Price')?> <?=lang('buc')?>
                                                <input id="pp<?=$key?>" type="text" value="<?=@$product_prices[$bulk->qty]?>" name="product_prices[<?=$key?>][price]" class="form-control">
                                            </label>
                                        </div>
                                    <?php }?>
                                    <button type="submit"
                                            class="btn green"><i
                                                class="fa fa-check"></i>
                                        <?=lang('Edit')?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_1_7">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td width="200">Добавить Опции</td>
                                        <td>
                                            <button class="btn green check_characters" id="add_variable"><i
                                                        class="fa fa-plus"></i> <?=lang('Add')?>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody id="table_variable">

                                    <?php if (!empty($item->options)) {
                                        foreach ($item->options as $option) {
                                            ?>
                                            <tr id="variable<?= $option->id ?>">
                                                <td width="50">
                                                    Сортировка
                                                    <input type="text" class="form-control"
                                                           value="<?= $option->sorder ?>"
                                                           name="options[<?= $option->id ?>][sorder]">
                                                </td>
                                                <td  >
                                                    Название RO
                                                    <input type="text" class="form-control"
                                                           value="<?= $option->titleRO ?>"
                                                           name="options[<?= $option->id ?>][titleRO]">
                                                </td>
                                                <td  >
                                                    Название EN
                                                    <input type="text" class="form-control"
                                                           value="<?= $option->titleEN ?>"
                                                           name="options[<?= $option->id ?>][titleEN]">
                                                </td>
                                                <td  width="150">
                                                    Цена
                                                    <input type="text" class="form-control"
                                                           value="<?= $option->price ?>"
                                                           name="options[<?= $option->id ?>][price]">
                                                </td>
                                                <td width="120">
                                                    Активен
                                                    <input type="checkbox" class="form-control" style="width: 25px;height: 25px;"
                                                           value="1" <?= $option->isShown == 1?'checked':'' ?>
                                                           name="options[<?= $option->id ?>][isShown]">
                                                </td>
                                                <td width="120">
                                                    <a onclick="DeleteVariable(<?= $option->id ?>)"
                                                       class="btn btn-xs default btn-editable red-stripe"
                                                       style="margin-top: 15px;">
                                                        <i class="glyphicon glyphicon-remove-circle"></i> Удалить
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green check_characters"><i
                                                        class="fa fa-check"></i> Изменить
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </form>
                        <div class="tab-pane fade" id="tab_1_3">
            <form action="/cp/products/filter/<?=$item->id?>" class="edit" method="post" enctype="multipart/form-data">
                <div class="table-scrollable">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php if(!empty($filters)){?>
                            <?php foreach($filters as $filter) {?>
                                <?php if(isset($product_filters_value[$filter->id])){?>

                                    <tr>
                                        <td colspan="<?=count(language(true))?>">
                                            <?php foreach ($product_filters_value[$filter->id] as $key=> $temp) {?>
                                                <div class="tr-flex">
                                                    <?php foreach(language(true) as $lang){ ?>
                                                        <div>
                                                            <?php if($key==0){?><span><?=$filter->title?> <?=strtoupper($lang)?></span><?php }?>
                                                            <input type="text" value="<?=$temp["value".strtoupper($lang)]?>"
                                                                   name="filters[<?=$filter->id?>][<?=$key?>][value<?=strtoupper($lang)?>]" class="form-control">
                                                        </div>
                                                    <?php }?>
                                                    <?php if($key > 0){?>
                                                        <button type="submit" class="btn red delfill"><i class="fa fa-minus"></i></button>
                                                    <?php } else {?>
                                                        <button data-content='<div class="tr-flex"><?php foreach(language(true) as $lang){?><div><input type="text" value="" name="filters[<?=$filter->id?>][__key__][value<?=strtoupper($lang)?>]" class="form-control" required></div><?php }?><button type="submit" class="btn red delfill"><i class="fa fa-minus"></i></button></div>' type="submit" class="btn green addfill"><i class="fa fa-plus"></i></button>
                                                    <?php }?>
                                                </div>
                                            <?php }?>
                                        </td>
                                    </tr>

                                <?php } else {?>
                                    <tr>
                                        <td colspan="<?=count(language(true))?>">
                                            <div class="tr-flex">
                                                <?php foreach(language(true) as $lang){ ?>
                                                    <div>
                                                        <span><?=$filter->title?> <?=strtoupper($lang)?></span>
                                                        <input type="text" value=""
                                                               name="filters[<?=$filter->id?>][0][value<?=strtoupper($lang)?>]" class="form-control" required>
                                                    </div>
                                                <?php }?>
                                                <button data-content='<div class="tr-flex"><?php foreach(language(true) as $lang){?><div><input type="text" value="" name="filters[<?=$filter->id?>][__key__][value<?=strtoupper($lang)?>]" class="form-control" required></div><?php }?><button type="submit" class="btn red delfill"><i class="fa fa-minus"></i></button></div>' type="submit" class="btn green addfill"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?>
                            <?php }?>
                        <?php }?>
                        <tr>
                            <td width="200">&nbsp;</td>
                            <td>
                                <button type="submit" class="btn green"><i class="fa fa-check"></i><?=lang('Edit')?></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        </div>
</div>

    <?php if (!empty($finmedia)){ ?>
    <h1 class="page-title"><?=lang('Media')?></h1>
    <div class="row thumbnails">
        <div class="portlet light">
            <div class="portlet-body">
                <div class="panel-body ui-sortable" id="media">
                    <?php foreach ($finmedia as $key=> $value){ ?>
                        <div class="col-sm-2 col-md-3 col-lg-2 item ui-sortable-handle" id="so[]_<?= $key ?>">
                            <a href="javascript:;"
                               data-table="product_images/<?=$lastwo?>/<?=$item->id?>"
                               data-id="<?= $key ?>"
                               class="btn btn-circle btn-icon-only red mine_delete_img_row">
                                <i class="fa fa-times"></i>
                            </a>
                            <a href="javascript:;" class="thumbnail"><img src="<?= $value ?>" style=" display: block;"> </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }?>

<link href="/static/assets/global/plugins/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css"/>
<script src="/static/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>

<script>
    $(function () {
        $('#media').sortable({
            items: '> div',
            stop: function( event, ui ) {
                var sorted = $(this).sortable( "serialize", { key: "so[]" } );
                console.log(sorted);
                $.post('/cp/product_images/update_order/', sorted, function(response){
                    if (response.ErrorCode === 500) {
                        toastr["error"](response.ErrorMessage);
                    } else {
                        toastr["success"](response.ErrorMessage);
                    }
                },'json');
            }
        }).disableSelection();
    })
</script>

<script>
    $(function () {
        $('.multi_select').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='<?=lang('Search')?>'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='<?=lang('Search')?>'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    });
</script>

<script>
    $(function () {

        $(document).on("submit", "form.edit", function(e) {
            var category_id = parseInt($(this).closest('form').find('input[name="category_id"]').val());

            console.log(category_id);

            if(category_id && category_id != 0) {
                //toastr["success"]("Нужно");
            } else {
                e.preventDefault();
                toastr["error"]("<?=lang('You need to select a parent category')?>");
            }
        });

        $('#category_id').on('changed.jstree', function (e, data) {
            if(data.action == 'select_node') {
                $('[type="hidden"][name="category_id"]').val(data.node.id);
                toastr["success"]("<?=lang('Category selected')?>.");
            }
        }).jstree({
            'core' : {
                'data' : [<?=$categories_json?>]
            }
        });
    });
</script>

<script>
    $(function () {
        $(document).on("click", ".addfill", function(event){
            event.preventDefault();
            var content = $(this).data('content');
            var n = $(this).closest("tr").find("td:first > div").length;
            var new_content = content.replace(/__key__/g, n);
            $(this).closest("tr").find("td:first").append(new_content);
        });

        $(document).on("click", ".delfill", function(event){
            event.preventDefault();
            if (confirm('<?=lang('You are sure?')?>')) {
                $(this).closest(".tr-flex").remove();
            }
        });
    });

    $('#add_variable').on('click', function () {
        $.ajax({
            url: '/cp/products/add_variable/', // путь к обработчику
            type: 'POST', // метод отправки
            data: {id: "<?=$item->id?>"},
            success: function (data) {
                console.log("УСПЕХ"); // выводим сообщение в консоль
                $("#table_variable").prepend(data);
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
        return false;
    });

    function DeleteVariable(id) {
        var tbid = '#variable' + id;
        if (confirm('Вы уверены, что хотите удалить этот элемент?')) {
            $.ajax({
                url: '/cp/products/add_variable_delete/', // путь к обработчику
                type: 'POST', // метод отправки
                data: {id: id},
                success: function (data) {
                    console.log("УСПЕХ"); // выводим сообщение в консоль
                    $(tbid).remove();
                },
                error: function (data) {
                    console.log(data); // выводим ошибку в консоль
                }
            });
        }
    }
</script>

<style>
    button {
        height: 44px;
    }
</style>
