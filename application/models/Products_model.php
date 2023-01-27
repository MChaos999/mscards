<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends BaseModel
{
    protected $tblname = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_products($lang)
    {
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

    public function get_products_promo($lang)
    {

        if (empty($lang)) return false;

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where("$this->tblname.promoInfo$lang !=", '');
        $this->db->limit(10);
        $response = $this->db->get("$this->tblname")->result();
//        dump($this->db->last_query());
        foreach ($response as $product) {
            $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
            if (!empty($price)) $product->price = $price->price;
        }
        return $response;
    }

    public function findFirstCart($id)
    {
        $id = (int)$id;
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.qty as qty,
            $this->tblname.category_id as category_id,
            $this->tblname.uriRO as uriRO,
            $this->tblname.titleRO as titleRO,   
            $this->tblname.isShown as isShown, 
        ");
        $item = $this->db->where('id', $id)->get($this->tblname)->row();
        if (!empty($item)) {
            return $item;
        } else {
            return false;
        }
    }

    public function product_item_cart($lang = false, $rowid)
    {
        $product_id = $this->db->select('product_id')->where('rowid', $rowid)->get('shop_cart_items')->row();

        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri, 
            $this->tblname.title$lang as title,
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.qty as qty,       
            $this->tblname.isShown as isShown,  
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        $this->db->where('isShown', 1);
        $this->db->where("id", $product_id->product_id);
        $product = $this->db->get($this->tblname)->row();
        $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
        if (!empty($price)) $product->price = $price->price;
        return $product;
    }

    public function get_product_by_uri($lang, $uri)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.uriRO as uriRO,
            $this->tblname.uriEN as uriEN,
            $this->tblname.title$lang as title,   
            $this->tblname.text$lang as text,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.qty as qty,   
            $this->tblname.pdf$lang as pdf,   
            $this->tblname.isShown as isShown, 
            $this->tblname.seoTitle$lang as seo_title,
            $this->tblname.seoKeywords$lang as seo_keywords,
            $this->tblname.seoDesc$lang as seo_desc,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        $this->db->where('isShown', 1);
        $this->db->where_in("uri$lang", $uri);
        $product = $this->db->get($this->tblname)->row();
        $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
        if (!empty($price)) $product->price = $price->price;
        return $product;
    }

    public function get_products_options($lang, $id)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select(" 
        id as id,
        product_id as product_id,
        title$lang as title,
        price as price,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('product_id', $id);
        $product = $this->db->get('products_options')->result();
        return $product;
    }

    public function get_option_info($id)
    {
        $this->db->select(" id as id, price as price");
        $this->db->where('id', $id);
        $option = $this->db->get('products_options')->row();
        return $option;
    }

    public function get_products_prices($id)
    {
        $this->db->select("*");
        $this->db->where('product_id', $id);
        $product = $this->db->get('product_prices')->result();
        return $product;
    }

    public function get_products_related($lang, $id)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("");
        $this->db->where('product_id', $id);
        $related_products = $this->db->get('related_products')->result();
        $ids = array();
        foreach ($related_products as $pr) {
            $ids[] = $pr->related_id;
        }

        if (!empty($ids)) {
            $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
            $this->db->where("$this->tblname.isShown", 1);
            $this->db->where_in("$this->tblname.id", $ids);
            $this->db->offset(0);
            $this->db->limit(10);
            $this->db->order_by("sorder ASC, id DESC");

            $products = $this->db->get($this->tblname)->result();
            foreach ($products as $product) {
                $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
                if (!empty($price)) $product->price = $price->price;
            }
            return $products;
        } else {
            return false;
        }
    }

    public function get_products_more($lang, $id)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("");
        $this->db->where('product_id', $id);
        $related_products = $this->db->get('products_more')->result();
        $ids = array();
        foreach ($related_products as $pr) {
            $ids[] = $pr->related_id;
        }

        if (!empty($ids)) {
            $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
            $this->db->where("$this->tblname.isShown", 1);
            $this->db->where_in("$this->tblname.id", $ids);
            $this->db->offset(0);
            $this->db->limit(10);
            $this->db->order_by("sorder ASC, id DESC");

            $products = $this->db->get($this->tblname)->result();
            foreach ($products as $product) {
                $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
                if (!empty($price)) $product->price = $price->price;
            }
            return $products;
        } else {
            return false;
        }
    }


    public function get_all_products()
    {
        $this->db->select("id,category_id");
        $this->db->where('isShown', 1);
        return $this->db->get($this->tblname)->result();
    }
    public function get_products_pag($lang, $offset, $limit, $sort = '')
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->offset($offset);
        $this->db->limit($limit);

        if (!empty($sort)) {
            if ($sort == 2) {
                $this->db->order_by("views DESC, sorder ASC");
            } elseif ($sort == 3) {
                $this->db->order_by("created_at DESC, sorder ASC");
            } else {
                $this->db->order_by("price ASC, sorder ASC");
            }
        } else {
            $this->db->order_by("sorder ASC, id DESC");
        }

        $products = $this->db->get($this->tblname)->result();
        foreach ($products as $product) {
            $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
            if (!empty($price)) $product->price = $price->price;
        }

        return $products;
    }

    public function get_all_products_search($search)
    {
        $this->db->select("id,category_id");
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like("$this->tblname.titleRO", $search);
            $this->db->or_like("$this->tblname.titleEN", $search);
            $this->db->or_like("$this->tblname.code", $search);
            $this->db->group_end();
        }
        $this->db->where('isShown', 1);
        return $this->db->get($this->tblname)->result();
    }
    public function get_products_pag_search($lang, $offset, $limit, $sort = 4, $search)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like("$this->tblname.titleRO", $search);
            $this->db->or_like("$this->tblname.titleEN", $search);
            $this->db->or_like("$this->tblname.code", $search);
            $this->db->group_end();
        }
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->offset($offset);
        $this->db->limit($limit);

        if ($sort == 1) {
            $this->db->order_by("price ASC, $this->tblname.sorder ASC");
        } elseif ($sort == 2) {
            $this->db->order_by("price DESC, $this->tblname.sorder ASC");
        } elseif ($sort == 3) {
            $this->db->order_by("$this->tblname.promoInfo$lang DESC, $this->tblname.sorder ASC");
        } else {
            $this->db->order_by("$this->tblname.isPopular DESC, $this->tblname.sorder ASC");
        }

        $products = $this->db->get($this->tblname)->result();
        foreach ($products as $product) {
            $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
            if (!empty($price)) $product->price = $price->price;
        }

        return $products;
    }

    public function get_all_category_products($categories_id = array())
    {
        $this->db->select("id,category_id");
        $this->db->where('isShown', 1);
        $this->db->where_in('category_id', $categories_id);
        return $this->db->get($this->tblname)->result();
    }
    public function get_category_products_pag($lang, $categories_id = array(), $offset, $limit, $sort = '')
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where_in('category_id', $categories_id);
        $this->db->offset($offset);
        $this->db->limit($limit);

        if (!empty($sort)) {
            if ($sort == 2) {
                $this->db->order_by("views DESC, sorder ASC");
            } elseif ($sort == 3) {
                $this->db->order_by("created_at DESC, sorder ASC");
            } else {
                $this->db->order_by("price ASC, sorder ASC");
            }
        } else {
            $this->db->order_by("sorder ASC, id DESC");
        }

        $products = $this->db->get($this->tblname)->result();
        foreach ($products as $product) {
            $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
            if (!empty($price)) $product->price = $price->price;
        }
        return $products;
    }

    public function get_all_category_products_filter($lang, $categories_id = array(),$features = array(), $search = false)
    {
        $this->db->select("$this->tblname.id,$this->tblname.category_id");
        if (!empty($features)) {
            $this->db->join("product_filters_value", "product_filters_value.product_id=$this->tblname.id");
            $this->db->where_in("product_filters_value.value$lang", $features);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like("$this->tblname.titleRO", $search);
            $this->db->or_like("$this->tblname.titleEN", $search);
            $this->db->or_like("$this->tblname.code", $search);
            $this->db->group_end();
        }
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where_in("$this->tblname.category_id", $categories_id);
        $this->db->group_by("$this->tblname.id");
        return $this->db->get($this->tblname)->result();
    }
    public function get_category_products_pag_filter($lang, $categories_id = array(), $offset, $limit, $features = array(), $sort = 4, $search = false)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
             (SELECT product_prices.price FROM product_prices WHERE product_prices.product_id=$this->tblname.id LIMIT 1) as price,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");
        if (!empty($features)) {
            $this->db->join("product_filters_value", "product_filters_value.product_id=$this->tblname.id");
            $this->db->where_in("product_filters_value.value$lang", $features);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like("$this->tblname.titleRO", $search);
            $this->db->or_like("$this->tblname.titleEN", $search);
            $this->db->or_like("$this->tblname.code", $search);
            $this->db->group_end();
        }
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->where_in("$this->tblname.category_id", $categories_id);
        $this->db->offset($offset);
        $this->db->limit($limit);
        if ($sort == 1) {
            $this->db->order_by("price ASC, $this->tblname.sorder ASC");
        } elseif ($sort == 2) {
            $this->db->order_by("price DESC, $this->tblname.sorder ASC");
        } elseif ($sort == 3) {
            $this->db->order_by("$this->tblname.promoInfo$lang DESC, $this->tblname.sorder ASC");
        } else {
            $this->db->order_by("$this->tblname.isPopular DESC, $this->tblname.sorder ASC");
        }
        $this->db->group_by("$this->tblname.id");
        $products = $this->db->get($this->tblname)->result();
        foreach ($products as $product) {
            $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
            if (!empty($price)) $product->price = $price->price;
        }
        return $products;
    }

    public function get_all_filter_products($lang, $categories_id = array(), $features = array(), $search = false)
    {

        $this->db->select("$this->tblname.id,$this->tblname.category_id"); 
        if (!empty($features)) {
            $this->db->join("product_filters_value", "product_filters_value.product_id=$this->tblname.id");
            $this->db->where_in("product_filters_value.value$lang", $features);
        }
        if (!empty($categories_id)) {
            $this->db->where_in("$this->tblname.category_id", $categories_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like("$this->tblname.titleRO", $search);
            $this->db->or_like("$this->tblname.titleEN", $search);
            $this->db->or_like("$this->tblname.code", $search);
            $this->db->group_end();
        }
        $this->db->where("$this->tblname.isShown", 1);
        $this->db->group_by("$this->tblname.id");
        return $this->db->get($this->tblname)->result();
    }
    public function get_filter_products_pag($lang, $categories_id = array(), $offset, $limit, $features = array(), $sort = 4, $search = false)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            $this->tblname.id as id,
            $this->tblname.code as code,
            $this->tblname.category_id as category_id,
            $this->tblname.uri$lang as uri,
            $this->tblname.title$lang as title,   
            $this->tblname.promoInfo$lang as promoInfo,   
            $this->tblname.isShown as isShown,
            (SELECT product_prices.price FROM product_prices WHERE product_prices.product_id=$this->tblname.id LIMIT 1) as price,
             (SELECT product_images.img FROM product_images WHERE product_images.product_id=$this->tblname.id LIMIT 1) as img,
             (SELECT categories.uri$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_uri,
             (SELECT categories.title$lang FROM categories WHERE categories.id=$this->tblname.category_id) as cat_title,
        ");

        if (!empty($features)) {
            $this->db->join("product_filters_value", "product_filters_value.product_id=$this->tblname.id");
            $this->db->where_in("product_filters_value.value$lang", $features);
        }
        if (!empty($categories_id)) {
            $this->db->where_in("$this->tblname.category_id", $categories_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like("$this->tblname.titleRO", $search);
            $this->db->or_like("$this->tblname.titleEN", $search);
            $this->db->or_like("$this->tblname.code", $search);
            $this->db->group_end();
        }
        $this->db->where("$this->tblname.isShown", 1);

        $this->db->offset($offset);
        $this->db->limit($limit);

        if ($sort == 1) {
            $this->db->order_by("price ASC, $this->tblname.sorder ASC");
        } elseif ($sort == 2) {
            $this->db->order_by("price DESC, $this->tblname.sorder ASC");
        } elseif ($sort == 3) {
            $this->db->order_by("$this->tblname.promoInfo$lang DESC, $this->tblname.sorder ASC");
        } else {
            $this->db->order_by("$this->tblname.isPopular DESC, $this->tblname.sorder ASC");
        }
        $this->db->group_by("$this->tblname.id");
        $products = $this->db->get($this->tblname)->result();
        foreach ($products as $product) {
            $price = $this->db->select("price as price")->where('product_id', $product->id)->get('product_prices')->row();
            if (!empty($price)) $product->price = $price->price;
        }
        return $products;
    }

}
