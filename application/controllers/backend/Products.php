<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends BackEndController {
    protected $add;
    protected $index_title;
    protected $title;
    protected $success_add;
    protected $success_update_order;
    protected $success_edit;
    protected $success_delete;

    public function __construct() {
        parent::__construct(__CLASS__);

        $this->index_title = lang('Products');
        $this->add = lang('Add');
        $this->success_update_order = lang('You have successfully updated display order!');
        $this->success_add = lang('You have successfully added an object');
        $this->success_edit = lang('You have successfully updated the object');
        $this->success_delete = lang('You have successfully deleted the object');

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('products_model');
        $this->load->model('product_images_model');
        $this->load->model('categories_model');
        $this->load->model('filter_groups_model');
        $this->load->model('filters_model');
        $this->load->model('bulks_model');
    }

    public function index() {
        init_load_img($this->main_page);
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $products = $this->products_model->get_match($_GET['search']);
        } else {
            $products = $this->products_model->find();
        }
        $categories = $this->categories_model->find();
        $filter_groups = $this->filter_groups_model->find();
        $bulks = $this->bulks_model->find();

        $this->data['inner_view'] = $this->index_view;
        $this->data['products'] = $products;
        $this->data['categories'] = $categories;
        $this->data['filter_groups'] = $filter_groups;
        $this->data['bulks'] = $bulks;
        $this->data['categories_json'] = admin_categories_json($categories, 0);

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function put() {
        check_if_POST();

        $post = array();
        if (!empty($this->input->post('related_products', true))) {
            $related_products = $this->input->post('related_products', true);
            unset($_POST['related_products']);
        }

        if (!empty($this->input->post('product_prices', true))) {
            $product_prices = $this->input->post('product_prices', true);
            unset($_POST['product_prices']);
        }


        init_load_img($this->main_page);

        try {
            foreach ($_POST as $index => $item) {
                $post[$index] = $this->input->post($index, TRUE);
            }

            if (!$this->products_model->put($post)) {
                throw new Exception(lang('Error writing data to table') . $this->main_page);
            }

            $id = $this->db->insert_id();

            foreach(language(true) as $lang){
                $post['uri'.strtoupper($lang)] = (!empty($post['title'.strtoupper($lang)])) ? $id.'-'.transliteration($post['title'.strtoupper($lang)]) : '';
            }

            if (!$this->products_model->update($post, $id)) {
                throw new Exception(lang('Error writing data to table') . $this->main_page);
            }

            if (!empty($related_products)) {
                foreach ($related_products as $s => $k) {
                    $ins = array(
                        'product_id' => $id,
                        'related_id' => $k
                    );
                    $this->db->insert('related_products', $ins);
                }
            }

            if (!empty($product_prices)) {
                foreach ($product_prices as $s => $k) {
                    $ins = array(
                        'product_id' => $id,
                        'bulk_id' => $k['qty'],
                        'price' => $k['price']
                    );
                    $this->db->insert('product_prices', $ins);
                }
            }

            $_SESSION['success'] = $this->success_add;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            $errors[] = lang('Exception thrown') . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function update_order() {
        check_if_POST();

        $this->load->model('products_model');

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception(lang('Error in received data!'));
            }

            if (!$this->products_model->update_sorder($post)) {
                throw new Exception(lang('Error writing data to table') . $this->main_page);
            }

            $_SESSION['success'] = $this->success_update_order;
        } catch (Exception $e) {
            $errors[] = lang('Exception thrown') . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function item($id = 0) {

        if(!isset($_SESSION['tab_id'])) $_SESSION['tab_id'] = 1;

        $id = (int)$id;

        $item = $this->products_model->find_first($id);
        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {

                if (!empty($this->input->post('related_products', true))) {
                    $new_related_products = $this->input->post('related_products', true);
                    unset($_POST['related_products']);
                    $this->db->where('product_id', $id)->delete('related_products');
                    foreach ($new_related_products as $k => $y) {
                        $this->db->insert('related_products', ['product_id' => $id, 'related_id' => $y ]);
                    }
                }

                if (!empty($this->input->post('product_prices', true))) {
                    $new_product_prices = $this->input->post('product_prices', true);
                    unset($_POST['product_prices']);
                    $this->db->where('product_id', $id)->delete('product_prices');
                    foreach ($new_product_prices as $k => $y) {
                         if($y['price']>0) $this->db->insert('product_prices', ['product_id' => $id, 'bulk_id' => $y['qty'], 'price' => $y['price'] ]);
                    }
                }

                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }

                foreach(language(true) as $lang){
                    $post['uri'.strtoupper($lang)] = (!empty($post['title'.strtoupper($lang)])) ? $item->id.'-'.transliteration($post['title'.strtoupper($lang)]) : '';
                }

                if(!empty($post['filters'])) {
                    $new_product_filters_value = array();
                    foreach($post['filters'] as $key1=>$values) {
                        foreach ($values as $key2 => $value) {
                            $new_product_filters_value[$key1.$key2]["filter_id"] = $key1;
                            $new_product_filters_value[$key1.$key2]["product_id"] = $item->id;

                            foreach (language(true) as $lang) {
                                $new_product_filters_value[$key1.$key2]["value".strtoupper($lang)] = $value["value".strtoupper($lang)];
                            }
                        }
                    }

                    if(!empty($new_product_filters_value)) {
                        $this->db->where("product_id", $item->id)->delete("product_filters_value");

                        foreach ($new_product_filters_value as $ins) {
                            $this->db->insert("product_filters_value", $ins);
                        }
                    }
                }

                unset($post['filters']);

                if (!empty($_FILES['media']['name'][0])) {

                    $lastwo = substr($id, -2);
                    init_load_img("product_images/$lastwo/$id");

                    $files = $_FILES['media'];

                    $cpt = count($_FILES['media']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['media']['name'] = $files['name'][$i];
                        $_FILES['media']['type'] = $files['type'][$i];
                        $_FILES['media']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['media']['error'] = $files['error'][$i];
                        $_FILES['media']['size'] = $files['size'][$i];

                        $this->upload->do_upload('media');
                        $file_data = $this->upload->data();
                        $file = $file_data['file_name'];

                        if(verify_img_extension($file_data['file_ext']))  {
                            $data = array(
                                'product_id' => $id,
                                'img' => $file,
                                'sorder' => '99'
                            );
                            $queryResult = $this->product_images_model->put($data);
                            if (!$queryResult) {
                                throw new Exception(lang('Error writing data to table'). 'products_images');
                            }
                        }
                    }
                }

                if (!$this->products_model->update($post, $id)) {
                    throw new Exception(lang('Error writing data to table') . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = lang('Exception thrown') . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->products_model->find_first($id);
        }

        $categories = $this->categories_model->find();
        $media = $this->product_images_model->get_media_for_product($id);
        $filter_groups = $this->filter_groups_model->find();
        $filters = $this->filters_model->get_filters_by_filter_group_id(get_language_for_admin(true), $item->filter_group_id);
        $bulks = $this->bulks_model->find();

        $related_products = array();
        $related_products_result = $this->db->where('product_id', $id)->get('related_products')->result();
        if (!empty($related_products_result)) {
            foreach ($related_products_result as $related_products_row) {
                $related_products[$related_products_row->related_id] = $related_products_row->related_id;
            }
        }

        $product_prices = array();
        $product_prices_result = $this->db->where('product_id', $id)->get('product_prices')->result();
        if (!empty($product_prices_result)) {
            foreach ($product_prices_result as $product_prices_row) {
                $product_prices[$product_prices_row->bulk_id] = $product_prices_row->price;
            }
        }

        $product_filters_value = array();
        $query = $this->db->where("product_id", $item->id)->get("product_filters_value")->result_array();
        if(!empty($query)) {
            foreach ($query as $key => $value) {
                $product_filters_value[$value['filter_id']][] = $value;
            }
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = lang('Edit') . $item->{'title'.get_language_for_admin(true)};
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;
        $this->data['filter_groups'] = $filter_groups;
        $this->data['filters'] = $filters;
        $this->data['bulks'] = $bulks;
        $this->data['product_filters_value'] = $product_filters_value;
        $this->data['related_products'] = $related_products;
        $this->data['product_prices'] = $product_prices;
        $this->data['media'] = $media;
        $this->data['categories_json'] = admin_categories_json($categories, 0, $item->category_id, null);

        $products = $this->db->order_by("title".get_language_for_admin(true)." ASC")->get('products')->result();
        $this->data['products'] = $products;
        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function filter($id = 0) {
        $id = (int)$id;

        $item = $this->products_model->find_first($id);
        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }

                if(!empty($post['filters'])) {
                    $new_product_filters_value = array();
                    foreach($post['filters'] as $key1=>$values) {
                        foreach ($values as $key2 => $value) {
                            $new_product_filters_value[$key1.$key2]["filter_id"] = $key1;
                            $new_product_filters_value[$key1.$key2]["product_id"] = $item->id;
                            foreach (language(true) as $lang) {
                                $new_product_filters_value[$key1.$key2]["value".strtoupper($lang)] = trim($value["value".strtoupper($lang)]);
                            }
                        }
                    }

                    if(!empty($new_product_filters_value)) {
                        $this->db->where("product_id", $item->id)->delete("product_filters_value");

                        foreach ($new_product_filters_value as $ins) {
                            $this->db->insert("product_filters_value", $ins);
                        }
                    }
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = lang('Exception thrown') . $e->getMessage();
                $_SESSION['error'] = $errors;
            }
        }

        $this->update_attributes($item->category_id);
        redirect($this->e_path.$id);
    }

    public function delete($id = false) {
        $id = (int)$id;

        $item = $this->products_model->find_first($id);
        if (empty($item)) throw_on_404();

        $media = $this->product_images_model->get_media_for_product($id);
        $images = array_map(function($md) {return $md->img;}, $media);

        $lastwo = substr($id, -2);
        unlink_files("product_images/$lastwo/$id", $images);

        try {
            if (!$this->products_model->delete($id)) {
                throw new Exception(lang('Error deleting data from table') . $this->main_page);
            }
            if (!$this->product_images_model->delete_media_for_product($id)) {
                throw new Exception(lang('Error deleting data from table') . 'product_images');
            }

            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = lang('Exception thrown') . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function update_attributes($category_id) {
        $query = $this->db->select('distinct(filter_group_id) as filter_group_id')->where('category_id', $category_id)->get('products')->result();
        $query2 = $this->db->select('distinct(id) as product_id')->where('category_id', $category_id)->get('products')->result();
        $filter_groups_ids = array_map( function($item) { return $item->filter_group_id; } ,$query);
        $product_ids = array_map( function($item) { return $item->product_id; } ,$query2);
        if(!empty($filter_groups_ids)){
            $filter_groups = admin_get_filters_by_category($filter_groups_ids, $product_ids);
            $inserter = array();
            foreach($filter_groups as $filter_group) {
                foreach($filter_group->filters as $filter) {
                    if (!empty($filter->values)) {
                        foreach(language(true) as $lang){
                            ${'vals_a_'.$lang} = array();
                        }
                        foreach($filter->values as $row) {
                            foreach(language(true) as $lang){
                                ${'vals_a_'.$lang}[]=array(
                                    'value'=>$row->{'value'.strtoupper($lang)},
                                    'count'=>$row->count
                                );
                                ${'vals_'.$lang}=json_encode(${'vals_a_'.$lang}, JSON_UNESCAPED_UNICODE);
                            }
                        }
                    } else {
                        foreach(language(true) as $lang){
                            ${'vals_'.$lang} ='';
                        }
                    }
                    $ins = array();
                    foreach(language(true) as $lang){
                        $ins['title'.strtoupper($lang)] = $filter->{'title'.strtoupper($lang)};
                        $ins['values'.strtoupper($lang)]= ${'vals_'.$lang};
                    }
                    $ins['category_id'] = $category_id;
                    $ins['filter_id'] = $filter->id;
                    $ins['type'] = '';
                    $ins['sorder'] = intval(@$_POST['attr_sorder'][$filter->id]);
                    $ins['checked'] = 1;
                    $ins['opened'] = intval(@$_POST['attr_isopen'][$filter->id]);

                    $inserter[]=$ins;
                    $attrList[]=$filter->id;
                }
            }
            $this->db->where('category_id',$category_id)->delete('category_filters');
            if (!empty($inserter)) $this->db->insert_batch('category_filters', $inserter);
        }
        if (!empty($attrList)) {
            $attr_val_cache = array();
            $list = $this->db->where_in('product_id',$product_ids)->where_in('filter_id',$attrList)->get('product_filters_value')->result();
            foreach($list as $item) {

                $ins = array();

                $ins['category_id'] = $category_id;
                $ins['product_id'] = $item->product_id;
                $ins['filter_id'] = $item->filter_id;
                foreach(language(true) as $lang) {
                    $ins['value'.strtoupper($lang)] = $item->{'value'.strtoupper($lang)};
                }

                $attr_val_cache[]=$ins;
            }
            $this->db->where('category_id',$category_id)->delete('product_filters_value_cached');
            if (!empty($attr_val_cache)) $this->db->insert_batch('product_filters_value_cached', $attr_val_cache);
        }
    }
}
