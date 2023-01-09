<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_images_model extends BaseModel
{
    protected $tblname = 'product_images';

    public function __construct()
    {
        parent::__construct();
    }
    public function get_media_for_product($product_id = false) {
        if (empty($product_id)) return false;
        return $this->db->select("
            id as id, 
            img as img,
            sorder as sorder,
        ")
        ->where('product_id', $product_id)
        ->order_by("sorder asc")
        ->get($this->tblname)
        ->result();
    }


    public function delete_media_for_product($product_id = false) {

        if (empty($product_id)) return false;

        return $this->db->delete($this->tblname, array('product_id' => $product_id));
    }
}
