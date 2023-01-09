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
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab"><?=lang('General information')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab"><?=lang('SEO')?></a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab"><?=lang('Filters')?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td width="200"><?=lang('Parent category')?> *</td>
                                        <td>
                                            <div id="parent_id" style="margin: 20px;"></div>
                                            <input type="hidden" name="parent_id" value="<?=$item->parent_id?>" required>
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
                                   <!-- <tr>
                                        <td width="200"><?php /*=lang('Price')*/?> </td>
                                        <td>
                                            <input type="text" name="min_price" class="form-control" value="<?php /*= $item->min_price */?>">
                                        </td>
                                    </tr>-->
                                    <tr>
                                        <td width="200"><?=lang('Photo')?></td>
                                        <td>
                                            <input type="file" name="img" id="file" class="form-control">
                                            <div class="note note-warning" style="margin-bottom: 0px; margin-top: 10px;">
                                                <p>
                                                    <?=lang('Allowable sizes')?>: 200x100
                                                </p>
                                            </div>
                                            <?php if (!empty($item->img)): ?>
                                                <?php $src = newthumbs($item->img, $table, 250, 250, '250x250x1', 1) ?>
                                                <br>
                                                <div class="mt-element-card mt-element-overlay item">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img src="<?= $src ?>"/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a class="btn red mine_delete_photo"
                                                                               data-table="<?=$table?>"
                                                                               data-id="<?= $item->id ?>"
                                                                               data-col="img"
                                                                               href="javascript:;">
                                                                                <i class="fa fa-ban"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <!--<tr>
                                        <td colspan="<?php /*=count(language(true))*/?>">
                                            <div class="tr-flex">
                                                <?php /* foreach(language(true) as $lang){ */?>
                                                    <div>
                                                        <span><?php /*=lang('Size photo')*/?> <?php /*=strtoupper($lang)*/?></span>
                                                        <input type="file" name="size_img<?php /*=strtoupper($lang)*/?>" id="file" class="form-control">
                                                        <div class="note note-warning" style="margin-bottom: 0px; margin-top: 10px;">
                                                            <p><?php /*=lang('Allowable sizes')*/?>: 500x500</p>
                                                        </div>
                                                        <?php /*if (!empty($item->{'size_img'.strtoupper($lang)})): */?>
                                                            <?php /*$src = newthumbs($item->{'size_img'.strtoupper($lang)}, $table, 250, 250, '250x250x1', 1) */?>
                                                            <br>
                                                            <div class="mt-element-card mt-element-overlay item">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="mt-card-item">
                                                                        <div class="mt-card-avatar mt-overlay-1">
                                                                            <img src="<?php /*= $src */?>"/>
                                                                            <div class="mt-overlay">
                                                                                <ul class="mt-info">
                                                                                    <li>
                                                                                        <a class="btn red mine_delete_photo"
                                                                                           data-table="<?php /*=$table*/?>"
                                                                                           data-id="<?php /*= $item->id */?>"
                                                                                           data-col="size_img<?php /*=strtoupper($lang)*/?>"
                                                                                           href="javascript:;">
                                                                                            <i class="fa fa-ban"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php /*endif; */?>
                                                    </div>
                                                <?php /*}*/?>
                                            </div>
                                        </td>
                                    </tr>-->
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
                        <div class="tab-pane fade" id="tab_1_3">
                            <div class="table-scrollable">
                                <table class="table table-striped table-bordered table-hover">
                                    <tr class="heading nodrop nodrag">
                                        <td width="100"><?=lang('Show in filtres')?></td>
                                        <!--<td width="100"><?php /*=lang('Open')*/?></td>-->
                                        <td width="100"><?=lang('Order in filters')?></td>
                                        <td width="220"><?=lang('Name')?></td>
                                        <td><?=lang('Value')?></td>
                                    </tr>
                                    <?php
                                    $result = array();
                                    $uri4=uri(4);

                                    $cat_family_ids = categories_family_ids($objects, $uri4);

                                    $query = $this->db->select('distinct(filter_group_id) as filter_group_id')->where_in('category_id', $cat_family_ids)->get('products')->result();
                                    $query2 = $this->db->select('distinct(id) as product_id')->where_in('category_id', $cat_family_ids)->get('products')->result();
                                    $filter_groups_ids = array();
                                    $product_ids = array();
                                    $filter_groups_ids = array_map( function($item) { return $item->filter_group_id; } ,$query);
                                    $product_ids = array_map( function($item) { return $item->product_id; } ,$query2);

                                    if(!empty($filter_groups_ids)){

                                        $filter_group = admin_get_filters_by_category($filter_groups_ids, $product_ids);

                                        $mnflt = $this->db->select('filter_id,sorder,checked,opened')
                                            ->where('category_id',$uri4)
                                            ->get('category_filters')->result_array();

                                        $first_list=array();
                                        $second_list=array();
                                        $third_list=array();
                                        foreach($mnflt as $row) {
                                            $first_list[$row['filter_id']]=$row['sorder'];
                                            $second_list[$row['filter_id']]=$row['checked'];
                                            $third_list[$row['filter_id']]=$row['opened'];
                                        }

                                        $first=$second=array();

                                        foreach($filter_group as $group) {
                                            foreach($group->filters as $filter) {
                                                if (!empty($second_list[$filter->id])) {
                                                    $filter->real_sorder=$first_list[$filter->id];
                                                    $first[]=$filter;
                                                } else {
                                                    $second[]=$filter;
                                                }
                                            }
                                        }

                                        function sort_elems($first,$second) {
                                            return $first->real_sorder > $second->real_sorder;
                                        }

                                        usort($first,'sort_elems');

                                        $result = array_merge($first,$second);
                                    }

                                    ?>
                                    <?php foreach($result as $filter) { ?>
                                        <tr>
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-outline">
                                                    <input <?= (!empty($second_list[$filter->id])) ? ' checked' : ''?> type="checkbox" name="attr_isshow[<?=$filter->id;?>]" value="1">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <?php if (!empty($second_list[$filter->id])) { ?>
                                                <td>
                                                    <input class="form-control"
                                                           type="text"
                                                           name="attr_sorder[<?=$filter->id?>]"
                                                           value="<?=intval(@$first_list[$filter->id])?>"
                                                           style="height:24px;text-align:center;">
                                                </td>
                                            <?php } else { ?>
                                                <td></td>
                                            <?php }?>
                                            <td><?=$filter->{'titleRO'}?></td>
                                            <td>
                                                <?php if (!empty($filter->values)) {
                                                    $cval=array();
                                                    foreach($filter->values as $row) {
                                                        $cval[]=$row->valueRO;
                                                    }
                                                    $cva=implode(', ',$cval);
                                                    echo $cva;
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <tr class="heading nodrop nodrag">
                                        <td>&nbsp;</td>
                                        <td colspan="5"><button type="submit" class="btn green"><i class="fa fa-check"></i><?=lang('Edit')?></button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<link href="/static/assets/global/plugins/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css"/>
<script src="/static/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>

<script>
    $(function () {

        $('#parent_id').on('changed.jstree', function (e, data) {
            if(data.action == 'select_node') {
                $('[type="hidden"][name="parent_id"]').val(data.node.id);
                toastr["success"]("<?=lang('Category selected')?>.");
            }
        }).jstree({
            'core' : {
                'data' : [<?=$categories_json?>]
            }
        });
    });
</script>
