<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends BaseModel
{
    protected $tblname = 'categories';

    public function __construct() {
        parent::__construct();
    }

    public function get_category_menu($lang)
    {
        if (empty($lang)) return false;
        $this->db->select("            
            id as id,
            parent_id as parent_id,
            level as level,
            onMain as onMain,
            title$lang as title,
            uri$lang as uri,
            img as img,
            ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_category_onPromotion($lang)
    {
        if (empty($lang)) return false;
        $this->db->select("            
            id as id,
            parent_id as parent_id,
            level as level,
            onMain as onMain,
            title$lang as title,
            uri$lang as uri,
            img as img,
            ");
        $this->db->where('isShown', 1);
        $this->db->where('onPromotion', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_categories($lang = false) {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            parent_id as parent_id,
            uri$lang as uri,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as seo_title,
            seoKeywords$lang as seo_keywords,
            seoDesc$lang as seo_desc,
            isShown as isShown,
            img as img,
            size_img$lang as size_img,
            min_price as min_price,
            level as level,
            onMain as onMain,
        ");
        $this->db->where('isShown', 1);
        $this->db->where("has_products", 1);
        $this->db->order_by('sorder ASC, ID DESC');
        $response = $this->db->get('categories')->result();

        return $response;
    }

    public function get_categories_home($lang = false) {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            parent_id as parent_id,
            level as level,
            onMain as onMain,
            title$lang as title,
            uri$lang as uri,
            img as img,
        ");
        $this->db->where('isShown', 1);
        $this->db->where("onMain", 1);
        $this->db->order_by('sorder ASC, ID DESC');
        $response = $this->db->get('categories')->result();

        return $response;
    }

    public function get_categories_by_parent($lang = false, $parent) {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            parent_id as parent_id,
            uri$lang as uri,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as seo_title,
            seoKeywords$lang as seo_keywords,
            seoDesc$lang as seo_desc,
            isShown as isShown,
            img as img,
            size_img$lang as size_img,
            min_price as min_price,
            onMain as onMain,
            (SELECT COUNT(id) FROM products WHERE isShown=1 AND qty > 0 AND categories.id = products.category_id) as total_products
        ");
        $this->db->where("parent_id", $parent);
        $this->db->where('isShown', 1);
        $this->db->where("has_products", 1);
        $this->db->order_by('sorder ASC, ID DESC');
        $response = $this->db->get('categories')->result();

        return $response;
    }

    public function get_category_by_uri($lang = false, $uri) {
        if (empty($lang) || empty($uri)) return false;

        $this->db->select("
            id as id,
            parent_id as parent_id,
            uri$lang as uri,
            uriRO as uriRO,
            uriRU as uriRU,
            uriEN as uriEN,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as seo_title,
            seoKeywords$lang as seo_keywords,
            seoDesc$lang as seo_desc,
            isShown as isShown,
            img as img,
            size_img$lang as size_img,
            min_price as min_price,
            level as level,
            onMain as onMain,
        ");
        $this->db->where("uri$lang", $uri);
        $this->db->where('isShown', 1);
        $response = $this->db->get('categories')->row();

        return $response;
    }

    public function get_category_children($lang, $id)
    {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            title$lang as title, 
            uri$lang as uri,
            parent_id as parent_id, 
        ");
        $this->db->where('isShown', 1);
        $this->db->where("parent_id", $id);
        $items =  $this->db->get($this->tblname)->result();
        return $items;
    }

    public function get_category_by_id($lang = false, $id) {
        if (empty($lang) || empty($id)) return false;

        $this->db->select("
            id as id,
            parent_id as parent_id,
            uri$lang as uri,
            uriRO as uriRO,
            uriRU as uriRU,
            uriEN as uriEN,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as seo_title,
            seoKeywords$lang as seo_keywords,
            seoDesc$lang as seo_desc,
            isShown as isShown,
            img as img,
            size_img$lang as size_img,
            min_price as min_price,
            level as level,
            onMain as onMain,
        ");
        $this->db->where("id", $id);
        $this->db->where('isShown', 1);
        $response = $this->db->get('categories')->row();

        return $response;
    }
}
