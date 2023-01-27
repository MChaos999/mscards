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
                                    <a href="#tab_1_1" data-toggle="tab"><?=lang('General information')?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"><?=lang('SEO')?></a>
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
                                                    <input type="hidden" name="parent_id" value="0" required>
                                                </td>
                                            </tr>
                                            <?php foreach(language(true) as $lang){ ?>
                                                <tr>
                                                    <td width="200"><?=lang('Name')?> <?=strtoupper($lang)?> *</td>
                                                    <td>
                                                        <input type="text" name="title<?=strtoupper($lang)?>" class="form-control" required>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            <?php foreach(language(true) as $lang){ ?>
                                                <tr>
                                                    <td width="200"><?=lang('Text')?> <?=strtoupper($lang)?></td>
                                                    <td>
                                                        <textarea name="text<?=strtoupper($lang)?>" cols="30" rows="3" class="form-control ckeditor"></textarea>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            <!--<tr>
                                                <td width="200"><?php /*=lang('Price')*/?> </td>
                                                <td>
                                                    <input type="text" name="min_price" class="form-control">
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
                                                            </div>
                                                        <?php /*}*/?>
                                                    </div>
                                                </td>
                                            </tr>-->
                                            <tr>
                                                <td width="200">&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                        <?=lang('Add')?>
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
                                                        <input type="text" name="seoTitle<?=strtoupper($lang)?>" class="form-control">
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            <?php foreach(language(true) as $lang){ ?>
                                                <tr>
                                                    <td width="200"><?=lang('Keywords')?> <?=strtoupper($lang)?></td>
                                                    <td>
                                                        <textarea name="seoKeywords<?=strtoupper($lang)?>" cols="30" rows="3" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            <?php foreach(language(true) as $lang){ ?>
                                                <tr>
                                                    <td width="200"><?=lang('Description')?> <?=strtoupper($lang)?></td>
                                                    <td>
                                                        <textarea name="seoDesc<?=strtoupper($lang)?>" cols="30" rows="3" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            <tr>
                                                <td width="200">&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                        <?=lang('Add')?>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
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

<?php if (!empty($objects)) : ?>
    <div class="row">
        <div class="portlet light">
            <div class="portlet-body">
                <form action="<?= $o_path; ?>" method="post">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-striped table-hover tree">
                            <thead>
                            <tr>
                                <th> <?=lang('Name')?></th>
                                <th width="180"></th>
                                <th width="180"></th>
                                <th width="180"></th>
                                <th width="305"> <?=lang('Action')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?= admin_categories_tree($objects, $e_path, $del_path) ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> <?=lang('Refresh order')?></button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
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

