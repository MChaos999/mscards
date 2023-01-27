<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
//        @session_start();
        header('Content-type: text/html; charset=utf-8');
//        check_if_POST();
        $this->load->library('session');

        if (empty($_SESSION['lang'])) get_prefered_language();
        $this->lclang = get_language(FALSE);
        $this->clang = get_language(TRUE);
        assign_language(uri(1));
    }

    private function _get_prefered_lang()
    {
        $lang = isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2) : '';
        switch ($lang) {
            case "ru":
                $_SESSION['lang'] = 'ru';
                break;
            case "ro":
                $_SESSION['lang'] = 'ro';
                break;
            default:
                $_SESSION['lang'] = 'ru';
                break;
        }
    }

    private function _define_constants($lang = 'EN')
    {
        $this->load->model('constants_model');
        $lang = mb_strtoupper($lang);
        $constants = $this->constants_model->find();
        foreach ($constants as $constant) {
            if (!defined($constant->name)) {
                define($constant->name, $constant->$lang);
            }
        }
    }

    public function cart_add($add_item = null)
    {
        check_if_POST();
        $this->load->library(['cart']);
        $this->load->model('products_model');
        $this->_define_constants();

        if (!$add_item) {
            $post = $this->input->post();
        } else {
            $post = $add_item;
        }

        if (empty($post['quantity'])) $post['quantity'] = 1;
        $post['quantity'] = (int)$post['quantity'];

        $response['status'] = 'error';
        $response['quantity'] = 0;
        $response['delivery_price'] = SHIPPING_PRICE;
        $response['delivery_free'] = FREE_SHIPPING_VALUE;

        if ($post['product_id']) {
            $product = $this->products_model->findFirstCart($post['product_id']);

            if ($product) {

                if ($post['quantity'] > $product->qty) { $post['quantity'] = $product->qty; $response['max_qty'] = $post['quantity'];}
                $product = $this->price_real_time($post, $product);

                $item = array(
                    'name' => str_replace('=', '', transliteration($product->titleRO)),
                    'id' => $post['product_id'],
                    'price' => $product->price,
                    'qty' => $post['quantity'],
                    'options' => $post['option'],
                );

                $cart_items = $this->cart->contents();

                if ($cart_items) {
                    $row_id = null;
                    $quantity = 0;
                    foreach ($cart_items as $cart_item) {
                        $c_item = $cart_item;
                        $t_item = $item;

                        unset($c_item['rowid'], $c_item['subtotal'], $c_item['qty'], $t_item['qty']);
                        if ($t_item['id'] == $c_item['id'] && $t_item['options'] == $c_item['options']) {
                            $row_id = $cart_item['rowid'];
                            $quantity = $cart_item['qty'] + $item['qty'];


                            if ($quantity > $product->qty) { $quantity = $product->qty; $response['max_qty'] = $quantity;}
                            $post['quantity'] = $quantity;
                            $product = $this->price_real_time($post, $product);

                            $response['quantity'] += $quantity;
                            $response['identical'] = 1;
                        } else {
                            $response['quantity'] += $cart_item['qty'];
                        }

                    }
                    if ($row_id) {
                        if ($quantity <= 0) {
                            $this->cart->remove($row_id);
                        } else {
                            $this->cart->update(array('rowid' => $row_id, 'qty' => $quantity, 'price' => $product->price));
                            $response['quantity'] = $quantity;
                        }
                    } else {
                        $this->cart->insert($item);
                        $row_id = $this->db->insert_id();
                        $cart_items = $this->cart->contents();
                        $cart_items = array_reverse($cart_items);
                        foreach ($cart_items as $key => $value) {
                            $row_id = $value['rowid'];
                            break;
                        }
                    }
                } else {
                    $this->cart->insert($item);
                    $row_id = $this->db->insert_id();
                    $cart_items = $this->cart->contents();
                    $cart_items = array_reverse($cart_items);
                    foreach ($cart_items as $key => $value) {
                        $row_id = $value['rowid'];
                        break;
                    }
                }

                $response['status'] = 'ok';


                if ($this->cart->total() < 0) {
                    $response['delivery_price'] = 0;
                    $delivery_price = 0;
                } else {
                    $delivery_price = 0;
                    $response['delivery_price'] = '0 MDL';
                }

                $response['total_items'] = $this->cart->total_items();
                $response['row_id'] = $row_id;
                $response['cart_total'] = number_format($this->cart->total() + $delivery_price, 2, '.', '');

            }
        }


        if (!$add_item) {
            echo json_encode($response);
        } else {
            return $response;
        }
    }

    protected function cart_contents()
    {
        $cart_products = $this->cart->contents();
        foreach ($cart_products as $key => $product) {
            $this->load->model('products_model');
            $cart_products[$key]['product'] = $this->products_model->product_item_cart($this->clang, $product['rowid']);
        }
        return $cart_products;
    }

    public function cart_update()
    {
        check_if_POST();
        $this->load->library(['cart']);
        $this->_define_constants();
        $this->load->model('products_model');
        $rowid = $this->input->post('rowid');
        $qty = $post['quantity'] = (int)$this->input->post('quantity');

        $response['status'] = 'error';
        $response['delivery_price'] = (int)SHIPPING_PRICE;
        $response['delivery_free'] = (int)FREE_SHIPPING_VALUE;
        if ($rowid) {
            $item = $this->cart->get_item($rowid);
            $product = $this->products_model->findFirstCart($item['id']);
            $post['option'] = $item['options'];
            if ($product) {

                if ($qty > $product->qty) { $qty = $product->qty; $response['max_qty'] = $qty;}
                $product = $this->price_real_time($post, $product);

                if ($qty > 0) {
                    if ($qty > $product->qty) { $qty = $product->qty; $response['max_qty'] = $qty;}
                    $this->cart->update(array('rowid' => $rowid, 'qty' => $qty, 'price' => $product->price));
                } else {
                    $this->cart->remove($rowid);
                }

                $cart_items = $this->cart_contents();
                $price_options = 0;
                foreach ($cart_items as $cart_pr){
                    if (!empty($cart_pr['options'])){
                        $option_select = explode(",", $cart_pr['options']);
                        foreach ($option_select as $op){
                            $option = $this->products_model->get_option_info($op);
                            if (!empty($option)){
                                $price_options = $price_options + ($option->price*$cart_pr['qty']);
                            }
                        }
                    }
                }
                $response['price'] = $product->price;
                $response['status'] = 'ok';
                $response['product_qty'] = $qty;

                if ($this->cart->total() < $response['delivery_free']) {
                    $delivery_price = $response['delivery_price'];
                } else {
                    $response['delivery_price'] = 0;
                    $delivery_price = 0;
                }

                $response['total_items'] = $this->cart->total_items();
                $response['row_id'] = $rowid;
                $response['cart_total'] = number_format($this->cart->total(), 2, '.', '');
                $response['total_price'] = ''.number_format($response['price'] * $qty, 2, '.', '');
                $response['total'] = number_format($response['cart_total'] + $response['delivery_price'], 2, '.', '');

                $response['TVA'] = ' '.number_format(($response['total']* (float)TVA_RATE)/100, 2, '.', '');
                $response['price_options'] = ' '.number_format($price_options, 2, '.', '');
                $response['total'] = ' '.($response['total'] + $response['TVA']);
                $response['price'] = ' '.$response['price'];
                $response['cart_total'] = ' '.$response['cart_total'];
            }
        }

        echo json_encode($response);
    }

    public function cart_delete()
    {
        check_if_POST();
        $this->load->library(['cart']);
        $this->_define_constants();
        $rowid = $this->input->post('rowid');

        $response['status'] = 'error';
        $response['delivery_price'] = (int)SHIPPING_PRICE;
        $response['delivery_free'] = (int)FREE_SHIPPING_VALUE;
        if ($rowid) {
            $response['status'] = 'ok';
            $this->cart->remove($rowid);
            $response['cart_subtotal'] = $this->cart->total();
        }

        $cart_items = $this->cart_contents();
        $price_options = 0;
        foreach ($cart_items as $cart_pr){
            if (!empty($cart_pr['options'])){
                $option_select = explode(",", $cart_pr['options']);
                foreach ($option_select as $op){
                    $option = $this->products_model->get_option_info($op);
                    if (!empty($option)){
                        $price_options = $price_options + ($option->price*$cart_pr['qty']);
                    }
                }
            }
        }
        $response['status'] = 'ok';

        if ($this->cart->total() < $response['delivery_free']) {
            $delivery_price = $response['delivery_price'];
        } else {
            $response['delivery_price'] = 0;
            $delivery_price = 0;
        }

        $response['total_items'] = $this->cart->total_items();
        $response['row_id'] = $rowid;
        $response['cart_total'] = number_format($this->cart->total(), 2, '.', '');
        $response['total'] = number_format($response['cart_total'] + $response['delivery_price'], 2, '.', '');
        $response['TVA'] = ' '.number_format(($response['total']* (float)TVA_RATE)/100, 2, '.', '');
        $response['price_options'] = ' '.number_format($price_options, 2, '.', '');
        $response['total'] = ' '.($response['total'] + $response['TVA']);
        $response['cart_total'] = ' '.$response['cart_total'];

        echo json_encode($response);
    }

    private function price_real_time($post,$product){
        $product->prices = $this->products_model->get_products_prices($product->id);
        $product->option = $this->products_model->get_products_options($this->clang, $product->id);

        if (!empty($product->prices)){
            $product->price = $product->prices['0']->price;
            foreach ($product->prices as $price){
                if ($post['quantity'] >= $price->bulk_id){
                    $product->price = $price->price;
                }
            }
        } else {
            $product->price = 999;
        }


        if (!empty($product->option)){
            $option_select = explode(",", $post['option']);
            foreach ($product->option as $value){
                foreach ($option_select as $sel_value){
                    if ($value->id == $sel_value){
                        $product->price = $product->price + $value->price;
                    }
                }
            }
        }
        return $product;
    }

}