<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends BaseModel
{
    protected $tblname = 'orders';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_($lang)
    {
        if (empty($lang)) return false;

    }

    public function orderProducts($id, $lang)
    {

        $products = $this->db->select('*')->where('order_id', $id)->get('orders_products')->result();

        if (!empty($products)) {
            foreach ($products as $key => $product) {
                if (!empty($product->options)){
                    $products[$key]->product = $this->db->select('uri' . $lang . ' AS uri, code, title' . $lang . ' AS title')->where('id', $product->product_id)->get('products')->row();
                    $products[$key]->product->options = $this->db->select('*')->where('id', $product->options)->get('products_options')->row();
                } else{
                    $products[$key]->product = $this->db->select('uri' . $lang . ' AS uri, code, title' . $lang . ' AS title')->where('id', $product->product_id)->get('products')->row();
                    $products[$key]->product->img = $this->db->select('id, img')->where('product_id', $product->product_id)->get('product_images')->row();
                }

            }
        }
        return $products;
    }

    public function get_client_orders($client_id,$lang){
        $orders = $this->db->select('id,order_id,client_id,total,delivery,added')->where('client_id', $client_id)->get($this->tblname)->result();
        if (!empty($orders)){
            foreach ($orders as $order){
                $order->products = $this->orderProducts($order->id,$lang);
            }
        }
        return $orders;
    }
}