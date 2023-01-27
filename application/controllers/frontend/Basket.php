<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basket extends FrontEndController
{
    private $page_id;

    public function __construct()
    {
        parent::__construct();
        $this->page_id = 11;
        $this->load->model('products_model');
        $this->load->model('orders_model');
    }

    private function _init_seo_data($page)
    {
        $this->data['page_title'] = (!empty($page->seo_title)) ? $page->seo_title : "";
        $this->data['page_name'] = $page->title;
        $this->data['text_for_layout'] = $page->text;
        $this->data['keywords_for_layout'] = (!empty($page->seo_keywords)) ? $page->seo_keywords : "";
        $this->data['description_for_layout'] = (!empty($page->seo_desc)) ? $page->seo_desc : "";
        $this->data['otitle'] = $page->seo_title;
        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $this->data['lang_urls'][$lang] = $this->{$array};
        }

        $this->data['breadcrumbs'] = $this->breadcrumbs;
    }

    private function loadOGImgData($page, $dir = 'menu')
    {
        if (!empty($page->img)) {
            $this->data['og_img'] = newthumbs($page->img, $dir, 500, 300, 'og500x300x1', 1);
            $this->data['og_img_width'] = 500;
            $this->data['og_img_height'] = 300;
        } else {
            $this->data['og_img'] = newthumbs('og.png', 'i', 50, 50, 'og50x50x1', 1);
            $this->data['og_img_width'] = 214;
            $this->data['og_img_height'] = 51;
        }
    }

    public function index()
    {
        $page = $this->menu_model->get_page_data_by_id($this->clang, $this->page_id);
        if (empty($page)) throw_on_404();

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);


        $this->data['inner_view'] = 'pages/basket/index';
        $this->data['page'] = $page;
        $this->data['home_page'] = 1;

        $this->data['class_page'] = '';


        $this->data['cart_items'] = $this->cart->contents();

        if (!empty($this->data['cart_items'])) {
            $this->data['option_price'] = 0;
            $this->data['price_delivery'] = 0;
            foreach ($this->data['cart_items'] as $key => $item) {
                $this->data['cart_items'][$key]['products'] = $this->products_model->product_item_cart($this->clang, $item['rowid']);
                if (!empty($item['options'])) {
                    $option = $this->products_model->get_products_options($this->clang, $item['id']);
                    if (!empty($option)) {
                        $option_select = explode(",", $item['options']);
                        foreach ($option as $value) {
                            foreach ($option_select as $sel_value) {
                                if ($value->id == $sel_value) {
                                    $this->data['cart_items'][$key]['option'][] = $value;
                                    $this->data['option_price'] = $this->data['option_price'] + ($value->price * $item['qty']);
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }
        $this->loadOGImgData($page);
        $this->_init_seo_data($page);
        $this->_render();
    }

    public function success()
    {
        $page = $this->menu_model->get_page_data_by_id($this->clang, 14);
        if (empty($page)) throw_on_404();

        if (empty($_GET['order'])) {
            redirect('/' . $this->lclang);
        }

        $order_id = ilabCrypt($_GET['order'], false);
        $order = $this->db->where('id', $order_id)->get('orders')->row();
        $this->data['order'] = $order;

        $this->data['products'] = $this->orders_model->orderProducts($order->id, 'RU');

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        $this->data['inner_view'] = 'pages/basket/success';
        $this->data['page'] = $page;

        $this->data['class_page'] = '';

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);
        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }
        $this->loadOGImgData($page);
        $this->_init_seo_data($page);
        $this->_render();
    }

    public function checkout()
    {
        $page = $this->menu_model->get_page_data_by_id($this->clang, 12);
        if (empty($page)) throw_on_404();

        if (empty($this->data['total_items_cart'])) {
            redirect('/' . $this->lclang . '/' . $this->data['menu']['all'][11]->uri);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $item) {
                $post[$index] = $this->input->post($index, true);
            }

            $data['total_items_cart'] = $this->cart->total_items();
            if (empty($post['name']) && empty($post['email']) && empty($data['phone'])) {
                redirect('/' . $this->lclang . '/' . $this->data['menu']['all'][11]->uri);
            }
            if (empty($post['pay'])) $post['pay'] = 1;
            if (empty($post['comment'])) $post['comment'] = '';


            if ($this->cart->total() < (int)FREE_SHIPPING_VALUE) {
                $delivery_price = (int)SHIPPING_PRICE;
            } else {
                $delivery_price = 0;
            }
            if ($post['delivery'] == 1){
                $delivery_price = 0;
            }


            $data = array(
                'status' => 'new',
                'order_id' => $this->getOrderId(),
                'total' => $this->cart->total(),
                'delivery_price' => $delivery_price,
                'name' => $post['name'],
                'email' => $post['email'],
                'phone' => $post['phone'],
                'payment' => $post['pay'],
                'delivery' => $post['delivery'],
                'address' => $post['address'],
                'notes' => $post['comment'],
                'ip' => $_SERVER['REMOTE_ADDR'],
                'added' => date("Y-m-d H:i:s")
            );
            $this->db->insert('orders', $data);
            $order_id = $this->db->insert_id();

            if (!empty($post['invoice']['name'])){
                $post['invoice']['order_id'] = $order_id;
                $this->db->insert('orders_invoice', $post['invoice']);
            }

            $this->data['cart_items'] = $this->cart->contents();

            if (!empty($order_id)) {
                foreach ($this->data['cart_items'] as $item) {
                    if (!empty($item)) {
                        $product = array(
                            'order_id' => $order_id,
                            'product_id' => $item['id'],
                            'qty' => $item['qty'],
                            'price' => $item['price'],
                            'options' => $item['options'],
                            'total' => $item['price'] * $item['qty'],
                        );
                        $this->db->insert('orders_products', $product);
                    }
                }
            }

            $this->email_order($data);

            $this->cart->destroy();
            redirect('/' . $this->lclang . '/' . $this->data['menu']['all'][14]->uri . '?order=' . ilabCrypt($order_id));
        }

        $this->data['cart_items'] = $this->cart->contents();

        if (!empty($this->data['cart_items'])) {
            $this->data['option_price'] = 0;
            $this->data['price_delivery'] = 0;
            foreach ($this->data['cart_items'] as $key => $item) {
                $this->data['cart_items'][$key]['products'] = $this->products_model->product_item_cart($this->clang, $item['rowid']);
                if (!empty($item['options'])) {
                    $option = $this->products_model->get_products_options($this->clang, $item['id']);
                    if (!empty($option)) {
                        $option_select = explode(",", $item['options']);
                        foreach ($option as $value) {
                            foreach ($option_select as $sel_value) {
                                if ($value->id == $sel_value) {
                                    $this->data['cart_items'][$key]['option'][] = $value;
                                    $this->data['option_price'] = $this->data['option_price'] + ($value->price * $item['qty']);
                                }
                            }
                        }
                    }
                }
            }
            if ((int)FREE_SHIPPING_VALUE > $this->data['total_price_cart']) {
                $this->data['price_delivery'] = (int)SHIPPING_PRICE;
            }
            $tva = (($this->data['total_price_cart'] + $this->data['price_delivery']) * (float)TVA_RATE)/100;

        }

        $this->data['page'] = $page;

        $this->data['inner_view'] = 'pages/basket/checkout';

        $this->data['class_page'] = '';

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);
        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }
        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->_render();

    }

    protected function getOrderId()
    {
        $order_random_id = rand(10000, 99999);

        $order = $this->db->where('order_id', $order_random_id)->get('orders')->row();
        if (!empty($order)) {
            $this->getOrderId();
        } else {
            return $order_random_id;
        }
    }

    function email_registration($post)
    {
        $this->load->library('parser');
        $link = 'https://' . $_SERVER['HTTP_HOST'] . '/registration_active?token=' . ilabCrypt($post['email'], true);
        $parse = [
            'link' => $link,
            'password' => $post['phone'],
            'REGISTR_SUCCESS_TEXT' => REGISTR_SUCCESS_TEXT,
            'REGISTR_EMAIL_SUBJECT' => REGISTR_EMAIL_SUBJECT,
            'email' => $post['email']
        ];
        $tx = $this->parser->parse('layouts/email/registration_order', $parse, true);
        //            EMAIL TO SERVER
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('no-reply@' . $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
        $this->email->to($post['email']);
        $this->email->subject(REGISTR_EMAIL_SUBJECT);
        $this->email->message($tx);
        $this->email->send();
    }

    function email_order($order_id)
    {
        $this->load->library('parser');

        $text_info = str_replace("{id}", $order_id['order_id'], ORDER_INFO);
        $text_info = str_replace("{suma}", $order_id['total'] + $order_id['delivery_price'], $text_info);
        $parse = [
            'TITLE_EMAIL' => TITLE_EMAIL,
            'ORDER_INFO' => $text_info,
            'ORDER_INFO_SERVICE' => ORDER_INFO_SERVICE,
            'ORDER_EMAIL_SUPPORT' => ORDER_EMAIL_SUPPORT,
            'ORDER_EMAIL_FOOTER' => ORDER_EMAIL_FOOTER,
        ];
        $tx = $this->parser->parse('layouts/email/order', $parse, true);

        //            EMAIL TO SERVER
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('no-reply@' . $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
        $this->email->to($order_id['email']);
        $this->email->subject('Plata cu succes pe site ' . $_SERVER['HTTP_HOST']);
        $this->email->message($tx);
        $this->email->send();
    }
}
