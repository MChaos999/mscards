<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends BaseModel {
    protected $tblname = 'products';

    public function __construct() {
        parent::__construct();
    }
    public function get_products($lang) {
        if (empty($lang)) return false;
        $this->db->select("
            id as id,
            code as code,
            category_id as category_id,
            uri$lang as uri,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as seo_title,
            seoKeywords$lang as seo_keywords,
            seoDesc$lang as seo_desc,
            isShown as isShown,
        ");
        $this->db->where('isShown', 1);
        $this->db->where("price > 0");
        $this->db->where("qty > 0");
        $this->db->order_by('sorder ASC, ID DESC');
        $response = $this->db->get('products')->result();

        return $response;
    }

    public function get_main_products($lang) {
        if (empty($lang)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,
            $this->tblname.desc$lang as desc,
            $this->tblname.text$lang as text,
            $this->tblname.price as price,
            $this->tblname.discounted_price as discounted_price,
            $this->tblname.isToday as isToday,
            $this->tblname.isPopular as isPopular,
            $this->tblname.isNew as isNew,
            $this->tblname.onMain as onMain,
            $this->tblname.isShown as isShown,
        ");
        $this->db->join("categories", "categories.id = $this->tblname.category_id", "right");
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where("$this->tblname.onMain", 1);
        $this->db->where("$this->tblname.price > 0");
        $this->db->where("$this->tblname.qty > 0");
        $this->db->limit(6);
        $this->db->order_by("$this->tblname.sorder ASC, $this->tblname.ID DESC");
        $response = $this->db->get($this->tblname)->result();

        return $response;
    }

    public function get_products_for_cateogry($lang, $category_id = 0, $ids = array(), $conditions=array()) {
        if ((empty($category_id) && empty($ids)) || empty($lang)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,
            $this->tblname.desc$lang as desc,
            $this->tblname.text$lang as text,
            $this->tblname.seoTitle$lang as seo_title,
            $this->tblname.seoKeywords$lang as seo_keywords,
            $this->tblname.seoDesc$lang as seo_desc,
            $this->tblname.price as price,
            $this->tblname.discounted_price as discounted_price,
            $this->tblname.isToday as isToday,
            $this->tblname.isPopular as isPopular,
            $this->tblname.isNew as isNew,
            $this->tblname.isShown as isShown,
            $this->tblname.onMain as onMain,
            $this->tblname.sorder as sorder,
        ");
        $this->db->join("categories", "categories.id = $this->tblname.category_id", "left");
        $this->db->where("categories.isShown", 1);
        $this->db->where("$this->tblname.price > 0");
        $this->db->where("$this->tblname.qty > 0");
        $this->db->where("$this->tblname.isShown", 1);
        if(!empty($category_id)) {
            $this->db->where_in("$this->tblname.category_id", (is_array($category_id) ? $category_id : array($category_id)));
        }
        if(!empty($ids)) {
            $this->db->where_in("$this->tblname.id", $ids);
        }

        if (!empty($conditions['min_price'])) {
            $this->db->where( "$this->tblname.price >=", $conditions['min_price']);
        }
        if (!empty($conditions['max_price'])) {
            $this->db->where( "$this->tblname.price <=" ,$conditions['max_price']);
        }

        if(!empty($conditions['limit'])) {
            $this->db->limit($conditions['limit'], $conditions['start']);
        }
        if(!empty($conditions['sort'])) {
            $this->db->order_by($conditions['sort']);
        }

        $this->db->group_by("$this->tblname.id");
        return $this->db->get($this->tblname)->result();
    }

    public function get_products_count($category_id = 0, $ids = array(), $conditions=array()) {
        if ( empty($category_id) && empty($ids) ) return false;

        $this->db->select("
            $this->tblname.id as id,
        ");
        $this->db->join("categories", "categories.id = $this->tblname.category_id", "left");
        $this->db->where("categories.isShown", 1);
        if(!empty($category_id)) {
            $this->db->where_in("$this->tblname.category_id", (is_array($category_id) ? $category_id : array($category_id)));
        }

        if(!empty($ids)) {
            $this->db->where_in("$this->tblname.id", $ids);
        }
        if (!empty($conditions['min_price'])) {
            $this->db->where( "$this->tblname.price >=", $conditions['min_price']);
        }
        if (!empty($conditions['max_price'])) {
            $this->db->where( "$this->tblname.price <=" ,$conditions['max_price']);
        }
        $this->db->group_by("$this->tblname.id");
        $result = $this->db->get($this->tblname);
        $count = $result->num_rows();
        return $count;
    }

    public function get_product_count_for_subcategories($category_ids) {
        $this->db->where_in("$this->tblname.category_id", $category_ids);
        $result = $this->db->get($this->tblname);
        $count = $result->num_rows();
        return $count;
    }

    public function get_match($match) {
        return $this->db->select('*')->like('title'.get_language_for_admin(true), $match)->order_by("sorder asc, id desc")->get($this->tblname)->result();
    }

    public function get_product_by_uri($lang, $uri) {
        if (empty($lang) || empty($uri)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.uriRO as uriRO,
            $this->tblname.uriRU as uriRU,
            $this->tblname.uriEN as uriEN,
            $this->tblname.title$lang as title,
            $this->tblname.desc$lang as desc,
            $this->tblname.text$lang as text,
            $this->tblname.seoTitle$lang as seo_title,
            $this->tblname.seoKeywords$lang as seo_keywords,
            $this->tblname.seoDesc$lang as seo_desc,
            $this->tblname.price as price,
            $this->tblname.discounted_price as discounted_price,
            $this->tblname.isToday as isToday,
            $this->tblname.isPopular as isPopular,
            $this->tblname.isNew as isNew,
            $this->tblname.onMain as onMain,
            $this->tblname.isShown as isShown,
        ");
        $this->db->where("$this->tblname.price > 0");
        $this->db->where("$this->tblname.qty > 0");
        $this->db->where("$this->tblname.uri$lang", $uri);

        $product = $this->db->get($this->tblname)->row();

        if(!empty($product)) {
            $filters = $this->db->select("
                            product_filters_value.filter_id as filter_id, 
                            product_filters_value.value$lang as value, 
                            filters.title$lang as title,
                            filters.filter_group_id as filter_group_id")
                ->where('product_id', $product->id)
                ->join('filters', 'product_filters_value.filter_id = filters.id', 'inner')
                ->get('product_filters_value')
                ->result();

            $new = array();
            foreach ($filters as $filter) {
                $new[$filter->filter_id] = array(
                    'filter_id' => $filter->filter_id,
                    'value' => (isset($new[$filter->filter_id]['value'])) ? $new[$filter->filter_id]['value'].', '.$filter->value : $filter->value,
                    'title' => $filter->title,
                    'filter_group_id' => $filter->filter_group_id,
                );
            }

            $product->filters = $new;
        }

        return $product;
    }

    public function get_product_by_id($lang, $id) {
        if (empty($lang) || empty($id)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.uriRO as uriRO,
            $this->tblname.uriRU as uriRU,
            $this->tblname.uriEN as uriEN,
            $this->tblname.title$lang as title,
            $this->tblname.desc$lang as desc,
            $this->tblname.text$lang as text,
            $this->tblname.seoTitle$lang as seo_title,
            $this->tblname.seoKeywords$lang as seo_keywords,
            $this->tblname.seoDesc$lang as seo_desc,
            $this->tblname.price as price,
            $this->tblname.discounted_price as discounted_price,
            $this->tblname.isToday as isToday,
            $this->tblname.isPopular as isPopular,
            $this->tblname.isNew as isNew,
            $this->tblname.onMain as onMain,
            $this->tblname.isShown as isShown,
        ");
        $this->db->where("$this->tblname.price > 0");
        $this->db->where("$this->tblname.qty > 0");
        $this->db->where("$this->tblname.id", $id);

        $product = $this->db->get($this->tblname)->row();

        return $product;
    }

    public function get_if_exist_product($id) {
        if (empty($id)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.category_id as category_id,
        ");
        $this->db->where("$this->tblname.id", $id);

        $product = $this->db->get($this->tblname)->row();

        return $product;
    }

    public function get_recomended_products($lang, $ids) {
        if (empty($lang) || empty($ids)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,
            $this->tblname.desc$lang as desc,
            $this->tblname.text$lang as text,
            $this->tblname.seoTitle$lang as seo_title,
            $this->tblname.seoKeywords$lang as seo_keywords,
            $this->tblname.seoDesc$lang as seo_desc,
            $this->tblname.price as price,
            $this->tblname.discounted_price as discounted_price,
            $this->tblname.isToday as isToday,
            $this->tblname.isPopular as isPopular,
            $this->tblname.isNew as isNew,
            $this->tblname.onMain as onMain,
            $this->tblname.isShown as isShown,
        ");
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where("$this->tblname.price > 0");
        $this->db->where_in("$this->tblname.id", $ids);
//        $this->db->where("$this->tblname.category_id", $category_id);
//        $this->db->where("$this->tblname.id !=", $product_id);
//        $this->db->order_by('rand()');
        $this->db->limit(4);
        $response = $this->db->get('products')->result();

        return $response;
    }

    public function get_next_product($lang, $category_id, $product_id) {
        if (empty($lang) || empty($category_id) || empty($product_id)) return false;

        $query = $this->db->select("uri$lang as uri")
            ->where("id >", $product_id)
            ->where("isShown", 1)
            ->where("price > 0")
            ->where("category_id", $category_id)
            ->order_by('id asc')
            ->get('products')->row();

        if(empty($query)) {
            $query = $this->db->select("uri$lang as uri")
                ->where("id <", $product_id)
                ->where("isShown", 1)
                ->where("price > 0")
                ->where("category_id", $category_id)
                ->order_by('id asc')
                ->get('products')->row();
        }

        return $query;


    }

    public function get_prev_product($lang, $category_id, $product_id) {
        if (empty($lang) || empty($category_id) || empty($product_id)) return false;

        $query = $this->db->select("uri$lang as uri")
            ->where("id <", $product_id)
            ->where("isShown", 1)
            ->where("price > 0")
            ->where("category_id", $category_id)
            ->order_by('id desc')
            ->get('products')->row();

        if(empty($query)) {
            $query = $this->db->select("uri$lang as uri")
                ->where("id >", $product_id)
                ->where("isShown", 1)
                ->where("price > 0")
                ->where("category_id", $category_id)
                ->order_by('id desc')
                ->get('products')->row();
        }

        return $query;
    }

    public function get_products_by_match($lang, $match) {

        if(empty($lang) || empty($match)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,
            $this->tblname.desc$lang as desc,
            $this->tblname.text$lang as text,
            $this->tblname.seoTitle$lang as seo_title,
            $this->tblname.seoKeywords$lang as seo_keywords,
            $this->tblname.seoDesc$lang as seo_desc,
            $this->tblname.price as price,
            $this->tblname.discounted_price as discounted_price,
            $this->tblname.isToday as isToday,
            $this->tblname.isPopular as isPopular,
            $this->tblname.isNew as isNew,
            $this->tblname.onMain as onMain,
            $this->tblname.isShown as isShown,
        ");
        $this->db->join("categories", "categories.id = $this->tblname.category_id", "right");
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where("$this->tblname.price > 0");
        $this->db->like("$this->tblname.title$lang", $match);
        $this->db->or_like("$this->tblname.code", $match);
        $this->db->limit(10);
        $response = $this->db->get("$this->tblname")->result();

        return $response;
    }
    public function update_nomenclatura($EAN, $price, $qty)
    {
        $data = [
            'price' => $price,
            'qty' => $qty,
        ];
        $this->db->where('EAN13', $EAN)->update($this->tblname, $data);
        return $data;
    }

}
