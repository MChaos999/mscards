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
            <form method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab"><?=lang('General information')?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <?php foreach(language(true) as $lang){ ?>
                                        <tr>
                                            <td width="200"><?=lang('Name')?> <?=strtoupper($lang)?> *</td>
                                            <td>
                                                <input type="text" name="title<?=strtoupper($lang)?>" class="form-control"
                                                    value="<?= $item->{'title'.strtoupper($lang)} ?>" required>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    <tr>
                                        <td colspan="<?=count(language(true))?>">
                                            <div class="two_colls">
                                                <?php foreach(language(true) as $lang){ ?>
                                                    <div>
                                                        <span><?=lang('Photo')?> <?=strtoupper($lang)?></span>
                                                        <input type="file" name="img<?=strtoupper($lang)?>" id="file" class="form-control">
                                                        <div class="note note-warning" style="margin-bottom: 0px; margin-top: 10px;">
                                                            <p><?=lang('Allowable sizes')?>: 1300x540</p>
                                                        </div>
                                                        <?php if (!empty($item->{'img'.strtoupper($lang)})): ?>
                                                            <?php $src = newthumbs($item->{'img'.strtoupper($lang)}, $table, 350, 170, '350x170x1', 1) ?>
                                                            <br>
                                                            <div class="mt-element-card mt-element-overlay item">
                                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                    <div class="mt-card-item">
                                                                        <div class="mt-card-avatar mt-overlay-1">
                                                                            <img src="<?= $src ?>"/>
                                                                            <div class="mt-overlay">
                                                                                <ul class="mt-info">
                                                                                    <li>
                                                                                        <a class="btn red mine_delete_photo"
                                                                                           data-table="<?=$table?>"
                                                                                           data-id="<?= $item->id ?>"
                                                                                           data-col="img<?=strtoupper($lang)?>"
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
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> <?=lang('Edit')?>
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
