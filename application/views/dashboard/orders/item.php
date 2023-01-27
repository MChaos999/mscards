<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/">Home</a>
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
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                        <form method="post" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet yellow-crusta box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Детали заказа
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Заказ:</div>
                                                    <div class="col-md-7 value"> #<?= $item->order_id ?>
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Статус:</div>
                                                    <div class="col-md-7 value">
                                                        <?
                                                        $status = [
                                                            'new' => 'Новый',
                                                            'progress' => 'В обработке',
                                                            'finished' => 'Закрыт',
                                                            'canceled' => 'Отменён'
                                                        ];
                                                        $pay = [
                                                            '1' => '<span class="label label-sm label-info"> Наличными </span>',
                                                            '2' => '<span class="label label-sm label-info"> Картой </span>',
                                                            '3' => '<span class="label label-sm label-info"> В кредит </span>',
                                                            '4' => '<span class="label label-sm label-info"> Перечислением </span>'
                                                        ];
                                                        $delivery = [
                                                            '1' => 'Самовывоз',
                                                            '2' => 'Курьерская доставка',
                                                        ]
                                                        ?>
                                                        <select name="status" id="status" class="form-control">
                                                            <? foreach ($status as $key => $title) { ?>
                                                                <option value="<?= $key ?>" <?= ($item->status == $key) ? 'selected' : '' ?>><?= $title ?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Оплата:</div>
                                                    <div class="col-md-7 value">
                                                        <?= $pay[$item->payment] ?>
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Время заказа:</div>
                                                    <div class="col-md-7 value"><?= date('d.m.Y H:i:s', strtotime($item->added)) ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Тип доставки</div>
                                                    <div class="col-md-7 value"> <?= $delivery[$item->delivery] ?>
                                                    </div>
                                                </div>
                                                <?php if ($item->delivery == 2) { ?>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Доставка</div>
                                                        <div class="col-md-7 value"> <?= $item->delivery_price ?>EUR
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Общая стоимость</div>
                                                    <div class="col-md-7 value"> <?= $item->total + $item->delivery_price + (number_format((($item->total + $item->delivery_price) * (float)$TVA_RATE) / 100, 2, '.', '')) ?>
                                                        EUR
                                                        <span> (inclusiv TVA: <?= number_format((($item->total + $item->delivery_price) * (float)$TVA_RATE) / 100, 2, '.', '') ?>EUR)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet blue-hoki box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Информация заказчика
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Имя:</div>
                                                    <div class="col-md-7 value"> <?= $item->name ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Email:</div>
                                                    <div class="col-md-7 value"> <?= $item->email ?> </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Номер телефона:</div>
                                                    <div class="col-md-7 value"> <?= $item->phone ?> </div>
                                                </div>
                                                <?php if ($item->delivery == 2) { ?>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Адресс Доставки:</div>
                                                        <div class="col-md-7 value"> <?= $item->address ?>  </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Самовывоз из:</div>
                                                        <div class="col-md-7 value"> <?= $CHECKOUT_PICK_UP_AT_THE_STORE_ADDRESS ?>  </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Коментарий</div>
                                                    <div class="col-md-7 value"> <?= $item->notes ?> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($order_invoice)) { ?>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="portlet blue-hoki box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Информация для Фактуры
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Тип покупателя</div>
                                                        <div class="col-md-7 value"> <?= $order_invoice->person == 1 ? 'Физическое лицо' : 'Юридическое лицо' ?> </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Имя Фамилия</div>
                                                        <div class="col-md-7 value"> <?= $order_invoice->name ?> <?= $order_invoice->surname ?></div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Телефон</div>
                                                        <div class="col-md-7 value"> <?= $order_invoice->phone ?> </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Email</div>
                                                        <div class="col-md-7 value"> <?= $order_invoice->email ?> </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Адрес</div>
                                                        <div class="col-md-7 value"> <?= $order_invoice->address ?> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet grey-cascade box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Корзина
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th> Код</th>
                                                            <th> Товар</th>
                                                            <th> Цена</th>
                                                            <th width="80"> Кол-во</th>
                                                            <th width="100"> Общая стоимость</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <? foreach ($products as $product) { ?>

                                                            <tr>
                                                                <td> <?= $product->product->code ?></td>
                                                                <td>
                                                                    <a href="/cp/products/item/<?= !empty($product->product->product_id) ? $product->product->product_id : $product->product_id ?>"
                                                                       target="_blank"> <?= $product->product->title ?> </a>
                                                                    <?php if (!empty($product->product->options)) { ?>
                                                                        <p><?= $product->product->options->titleRO ?></p>
                                                                    <?php } ?>
                                                                </td>
                                                                <td> <?= $product->price ?> EUR</td>
                                                                <td><?= $product->qty ?></td>
                                                                <td> <?= $product->total ?> EUR</td>
                                                            </tr>
                                                        <? } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.return_pay').click(function () {
        let prompt = window.confirm("Подтвердить возврат денежных средств");
        if (prompt) {
            return true;
        } else {
            return false;
        }
    });
</script>
