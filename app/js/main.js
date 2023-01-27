function changeLangue(obj) {
    window.location.href = obj.getAttribute('data-link');
}

function filter_products() {
    let sort = $('select[name="sort"]').val();
    sort = '&sort=' + sort;
    let view = $('select[name="counts_view"]').val();
    view = '&view=' + view;
    let lang = $('html').attr('lang');
    let category_id = $('h2.head-market__title').data('category_id');
    category_id = '&category_id=' + category_id;
    let get_search = $('input[name="get_search"]').val();
    if (get_search) {
        get_search = '&search=' + get_search;
    } else {
        get_search = '';
    }
    var filter = $('.filter_checkbox:checked').serialize();
    var url = '/' + lang + '/filter_products/';
    filter = filter + get_search + sort + view + category_id;
    history.pushState({}, ' ', '?' + filter);
    $.ajax({
        url: url, // путь к обработчику
        type: 'POST', // метод отправки
        dataType: 'json',
        data: {filter: filter},
        success: function (data) {
            $('.market__catalog.catalog-market').html(data.html)
            $('.head-market__count span').html(data.count)
        },
        error: function (data) {
            console.log(data); // выводим ошибку в консоль
        }
    });
}

$('body').on('click', '.selects-actions-market .select__option', function (e) {
    filter_products();
});
$('body').on('click', '.sidebar-market__clear', function (e) {
    var url = document.location.href;
    var mainurl = url.split("?");
    window.location.href = mainurl[0];
});
$('body').on('change', '.filter_checkbox', function (e) {
    filter_products();
});
$('body').on('click', '.popup_bg', function (e) {
    $('#popup_success').hide();
});


function product_price_calk() {
    var price = $('input[name="qty_add"]').data('standart_price');
    let qty_add = $('input[name="qty_add"]').val();

    let option_input = $('.option_input:checked');
    let option_price = 0;
    option_input.each(function () {
        option_price = parseFloat(option_price) + parseFloat($(this).val());
    });

    let price_standart = qty_add * (parseFloat(option_price) + parseFloat(price));

    let pricelist = $('.pricelist-main-info-card__item');
    pricelist.each(function () {
        var qty = $(this).data('qty');
        if (qty_add >= qty) {
            price = $(this).data('price');
        }
    });

    let total = qty_add * (parseFloat(option_price) + parseFloat(price));
    $('.total_price').html(total.toFixed(2));
    $('.total_discount').html((price_standart.toFixed(2) - total.toFixed(2)).toFixed(2));
}

$('.card__content').on('click', '.quantity__button_plus', function (e) {
    product_price_calk();
});
$('.card__content').on('click', '.quantity__button_minus', function (e) {
    product_price_calk();
});
$('.card__content').on('change', 'input[name="qty_add"]', function (e) {
    product_price_calk();
});
$('body').on('change', '.option_input', function (e) {
    product_price_calk();
});


function product_qty_calk_basket(product) {
    var qty_product = product.parent().parent().parent().find('input[name="counts-product"]').val();
    var rowid = product.parent().parent().parent().find('input[name="counts-product"]').data('rowid');
    $.ajax({
        url: '/cart/update_cart/', // путь к обработчику
        type: 'POST', // метод отправки,
        dataType: 'json',
        data: {rowid: rowid, quantity: qty_product},
        success: function (data) {
            if (data.status == 'ok') {
                $('.main-header__cart span').html(data.cart_total);
                $('.total_price_cart span').html(data.cart_total);
                $('.delivery_cart span').html(data.delivery_price);
                $('.option_price span').html(data.price_options);
                $('.total-sidebar-cart__price span').html(data.total);
                $('.total-sidebar-cart__tax span').html(data.TVA);
                product = product.parent().parent().parent().find('input[name="counts-product"]').parent().parent().parent().parent();
                product.find('.body-main-cart__total_price span').html(data.total_price);
                product.find('.body-main-cart__price span').html(data.price);
                if (data.max_qty) {
                    $('.cart_products_full').show();
                    $('.cart_products_full span').html(data.max_qty);
                    product.find('input[name="counts-product"]').val(data.max_qty);
                    setTimeout(function run() {
                        $('.cart_products_full').hide();
                    }, 3000);
                }

            }
        },
        error: function (data) {
            console.log(data); // выводим ошибку в консоль
        }
    });
}

$('.cart').on('click', '.quantity__button_plus', function (e) {
    product_qty_calk_basket($(this));
});
$('.cart').on('click', '.quantity__button_minus', function (e) {
    product_qty_calk_basket($(this));
});
$('.cart').on('change', 'input[name="counts-product"]', function (e) {
    product_qty_calk_basket($(this));
});

$('body').on('click', '.body-main-cart__delete', function (e) {
    var button = $(this);
    var rowid = button.parent().parent().data('rowid');
    $.ajax({
        url: '/cart/delete/', // путь к обработчику
        type: 'POST', // метод отправки,
        dataType: 'json',
        data: {rowid: rowid},
        success: function (data) {
            if (data.status == 'ok') {
                $('.main-header__cart span').html(data.cart_total);
                $('.total_price_cart span').html(data.cart_total);
                $('.delivery_cart span').html(data.delivery_price);
                $('.option_price span').html(data.price_options);
                $('.total-sidebar-cart__price span').html(data.total);
                $('.total-sidebar-cart__tax span').html(data.TVA);
                button.parent().parent().remove();
                if (data.total_items < 1){
                    let lang = $('html').attr('lang');
                    window.location.href = "/"+lang;
                }
            }
        },
        error: function (data) {
            console.log(data); // выводим ошибку в консоль
        }
    });
});
$('body').on('click', '.add_to_cart', function (e) {
    var button = $(this);
    var product_id = button.data('prod_id');
    var quantity = 1;
    $.ajax({
        url: '/cart_add/', // путь к обработчику
        type: 'POST', // метод отправки,
        dataType: 'json',
        data: {product_id: product_id, quantity: quantity,option:''},
        success: function (data) {
            if (data.status == 'ok') {
                let basket = $('.main-header__cart');
                if (!(basket.children('span').length > 0)) {
                    basket.html('<span>' + data.cart_total + '</span>' + basket.data('curs'));
                    basket.attr('href', basket.data('uri'));
                } else {
                    $('.main-header__cart span').html(data.cart_total);
                }
                if (data.max_qty) {
                    $('.cart_products_full').show();
                    $('.cart_products_full span').html(data.max_qty);
                    setTimeout(function run() {
                        $('.cart_products_full').hide();
                    }, 3000);
                }


            }
        },
        error: function (data) {
            console.log(data); // выводим ошибку в консоль
        }
    });
});

$('body').on('click', '.other-info-card__to-cart', function (e) {
    e.preventDefault();
    var button = $(this);
    var product_id = button.data('prod_id');
    var quantity = $('input[name="qty_add"]').val();

    let option_input = $('.option_input:checked');
    let option = '';
    option_input.each(function () {
        if (option) {
            option = option + ',' + $(this).data('options');
        } else {
            option = $(this).data('options');
        }
    });
    $.ajax({
        url: '/cart_add/', // путь к обработчику
        type: 'POST', // метод отправки,
        dataType: 'json',
        data: {product_id: product_id, quantity: quantity, option: option},
        success: function (data) {
            if (data.status == 'ok') {
                let basket = $('.main-header__cart');
                if (!(basket.children('span').length > 0)) {
                    basket.html('<span>' + data.cart_total + '</span>' + basket.data('curs'));
                    basket.attr('href', basket.data('uri'));
                } else {
                    $('.main-header__cart span').html(data.cart_total);
                }
                if (data.max_qty) {
                    $('.cart_products_full').show();
                    $('.cart_products_full span').html(data.max_qty);
                    setTimeout(function run() {
                        $('.cart_products_full').hide();
                    }, 3000);
                }


            }
        },
        error: function (data) {
            console.log(data); // выводим ошибку в консоль
        }
    });
});


$('body').on('change', 'input[name="delivery"]', function (e) {
    var delivery = $(this).val();
    var price = $('.info-order__total_content').data('total');
    var pricedelivery = $('.info-order__total_content').data('total-delivery');
    var price_tva = $('.tva').data('tva');
    var pricedelivery_tva = $('.tva').data('tva-delivery');
    if (delivery == 1){
        $('.delivery').hide();
        $('.info-order__total_content').find('.info-order__total_value span').html(price);
        $('.tva').html(price_tva);
    } else {
        $('.delivery').show();
        $('.info-order__total_content').find('.info-order__total_value span').html(pricedelivery);
        $('.tva').html(pricedelivery_tva);
    }
});

$('body').on('click', '.info-order__button', function (e) {
    if (!$('input:radio[name="delivery"]:checked').val()){
        e.preventDefault();
        $('.delivery_row').addClass('_error');
        $('html, body').animate({
            scrollTop: $("._error").offset().top - 50
        }, 1000);

    } else {
        $('.delivery_row').removeClass('_error');
    }
});
$('body').on('click', '.footer-invoice-popup__cancel', function (e) {
    $('.invoice-popup input').val('');
});

