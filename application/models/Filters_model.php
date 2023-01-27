<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters_model extends BaseModel {
    protected $tblname = 'filters';

    public function __construct() {
        parent::__construct();
    }

    /*public function get_filters($lang) {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            filter_group_id as filter_group_id,
            title$lang as title,
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, ID DESC');
        return $this->db->get($this->tblname)->result();
    }*/

    public function get_filters_by_filter_group_id($lang, $filter_group_id) {
        if (empty($lang) || empty($filter_group_id)) return false;

        $this->db->select("
            id as id,
            filter_group_id as filter_group_id,
            title$lang as title,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('filter_group_id', $filter_group_id);
        $this->db->order_by('sorder ASC, ID DESC');
        return $this->db->get($this->tblname)->result();
    }

    function get_filters_cache($lang, $category_id) {
        $query = $this->db->select("
			title$lang as title,
			values$lang as values,
			valuesRO as valuesRO,
			filter_id as filter_id,
			opened as opened,
			type as type,
		")
            ->from('category_filters')
            ->where('category_id', $category_id)
            ->order_by('sorder asc')
            ->get()->result();

        $result = array();
        foreach($query as $row) {
            $result[$row->filter_id]=$row;
        }

        return $result;
    }

    function get_cached_attribute_values_ro($category_id, $filter_ids, $product_ids) {
        $query = $this->db->select("
			valueRO as value,
			filter_id,
			product_id
		")
            ->from('product_filters_value_cached')
            ->where_in('category_id', (is_array($category_id) ? $category_id : array($category_id)))
            ->where_in('filter_id', $filter_ids)
            ->where_in('product_id', $product_ids)
            ->get();

        $result = $query->result();

        $data=array();
        foreach($result as $row) {
            $data[$row->product_id][$row->filter_id][$row->value] = $row->value;
        }

        return $data;
    }

    public function get_product_filters_value($lang, $product_id){
        if (empty($lang) || empty($product_id)) return false;
        $this->db->select("
            filter_id as filter_id,
            product_id as product_id,
            value$lang as value,
            (SELECT filters.title$lang FROM filters WHERE filters.id=product_filters_value.filter_id LIMIT 1) as filter_title,
        ");
        $this->db->where('product_id', $product_id);
        return $this->db->get('product_filters_value')->result();
    }

    public function get_category_filters($lang, $category_id){
        if (empty($lang) || empty($category_id)) return false;

        $this->db->select("
            category_id as category_id, 
            filter_id as filter_id, 
            title$lang as title,
            values$lang as values,
        ");
        $this->db->where_in('category_id', $category_id);
        $this->db->order_by('sorder ASC');
        return $this->db->get('category_filters')->result();

    }
}
