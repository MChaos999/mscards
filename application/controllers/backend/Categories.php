<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends BackEndController {
    protected $add;
    protected $index_title;
    protected $title;
    protected $success_add;
    protected $success_update_order;
    protected $success_edit;
    protected $success_delete;

    public function __construct() {
        parent::__construct(__CLASS__);
        $this->index_title = lang('Product categories');
        $this->add = lang('Add');
        $this->success_update_order = lang('You have successfully updated display order!');
        $this->success_add = lang('You have successfully added an object');
        $this->success_edit = lang('You have successfully updated the object');
        $this->success_delete = lang('You have successfully deleted the object');
        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('categories_model');
    }

    public function index() {
        init_load_img($this->main_page);

        $objects = $this->categories_model->find();

        $this->data['inner_view'] = $this->index_view;
        $this->data['objects'] = $objects;
        $this->data['categories_json'] = admin_categories_json($objects, 0);

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function put() {
        check_if_POST();

        $post = array();

        init_load_img($this->main_page);

        $objects = $this->categories_model->find();
        $categories = array();
        foreach($objects as $obj) { $categories[$obj->id] = $obj->level; }

        try {
            foreach ($_POST as $index => $item) {
                $post[$index] = $this->input->post($index, TRUE);
            }

            $post['level'] = ($post['parent_id']==0) ? 0 : $categories[$post['parent_id']];
            $post['level']++;

            if (!empty($_FILES['img']['name'])) {
                $this->upload->do_upload('img');
                $file_data = $this->upload->data();
                $file = $file_data['file_name'];
                if(verify_img_extension($file_data['file_ext']))  $post['img'] = $file;
            }

            foreach(language(true) as $lang){
                if (!empty($_FILES['size_img'.strtoupper($lang)]['name'])) {
                    $this->upload->do_upload('size_img'.strtoupper($lang));
                    $file_data = $this->upload->data();
                    $file = $file_data['file_name'];
                    if(verify_img_extension($file_data['file_ext']))  $post['size_img'.strtoupper($lang)] = $file;
                }
            }

            if (!$this->categories_model->put($post)) {
                throw new Exception(lang('Error writing data to table') . $this->main_page);
            }

            $id = $this->db->insert_id();

            foreach(language(true) as $lang){
                $post['uri'.strtoupper($lang)] = (!empty($post['title'.strtoupper($lang)])) ? $id.'-'.transliteration($post['title'.strtoupper($lang)]) : '';
            }

            if (!$this->categories_model->update($post, $id)) {
                throw new Exception(lang('Error writing data to table') . $this->main_page);
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

        $this->load->model('categories_model');

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception(lang('Error in received data!'));
            }

            if (!$this->categories_model->update_sorder($post)) {
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
        $id = (int)$id;

        init_load_img($this->main_page);
        $item = $this->categories_model->find_first($id);
        if (empty($item)) throw_on_404();

        $objects = $this->categories_model->find();
        $categories = array();
        foreach($objects as $obj) { $categories[$obj->id] = $obj->level; }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {


                // modificam atributs

                $this->update_attributes($objects, $item->id);

                if(isset($_POST['attr_isshow'])) unset($_POST['attr_isshow']);
                if(isset($_POST['attr_isopen'])) unset($_POST['attr_isopen']);
                if(isset($_POST['attr_sorder'])) unset($_POST['attr_sorder']);

                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }

                foreach(language(true) as $lang){
                    $post['uri'.strtoupper($lang)] = (!empty($post['title'.strtoupper($lang)])) ? $item->id.'-'.transliteration($post['title'.strtoupper($lang)]) : '';
                }

                $post['level'] = ($post['parent_id']==0) ? 0 : $categories[$post['parent_id']];
                $post['level']++;

                if (!empty($_FILES['img']['name'])) {
                    unlink_files($this->main_page, $item->img);
                    $this->upload->do_upload('img');
                    $file_data = $this->upload->data();
                    $file = $file_data['file_name'];
                    if(verify_img_extension($file_data['file_ext']))  $post['img'] = $file;
                }

                foreach(language(true) as $lang){
                    if (!empty($_FILES['size_img'.strtoupper($lang)]['name'])) {
                        unlink_files($this->main_page, $item->{'size_img'.strtoupper($lang)});
                        $this->upload->do_upload('size_img'.strtoupper($lang));
                        $file_data = $this->upload->data();
                        $file = $file_data['file_name'];
                        if(verify_img_extension($file_data['file_ext']))  $post['size_img'.strtoupper($lang)] = $file;
                    }
                }

                if (!$this->categories_model->update($post, $id)) {
                    throw new Exception(lang('Error writing data to table') . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = lang('Exception thrown') . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->categories_model->find_first($id);
            $objects = $this->categories_model->find();
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = lang('Edit') . $item->{'title'.get_language_for_admin(true)};
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;
        $this->data['objects'] = $objects;
        $this->data['categories_json'] = admin_categories_json($objects, 0, $item->parent_id, $item->id);

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false) {
        $id = (int)$id;

        $item = $this->categories_model->find_first($id);
        if (empty($item)) throw_on_404();

        unlink_files($this->main_page, $item->img);

        foreach(language(true) as $lang){
            unlink_files($this->main_page, $item->{'size_img'.strtoupper($lang)});
        }

        try {
            if (!$this->categories_model->delete($id)) {
                throw new Exception(lang('Error deleting data from table') . $this->main_page);
            }

            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = lang('Exception thrown') . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function update_attributes($objects, $category_id) {

        $result = array();

        $cat_family_ids = categories_family_ids($objects, $category_id);

        $query = $this->db->select('distinct(filter_group_id) as filter_group_id')->where_in('category_id', $cat_family_ids)->get('products')->result();
        $query2 = $this->db->select('distinct(id) as product_id')->where_in('category_id', $cat_family_ids)->get('products')->result();
        $filter_groups_ids = array();
        $product_ids = array();
        $filter_groups_ids = array_map( function($item) { return $item->filter_group_id; } ,$query);
        $product_ids = array_map( function($item) { return $item->product_id; } ,$query2);

        if(!empty($filter_groups_ids)){

            $filter_groups = admin_get_filters_by_category($filter_groups_ids, $product_ids);

            $inserter = array();
            foreach($filter_groups as $filter_group) {
                foreach($filter_group->filters as $filter) {
                    if (!empty($_POST['attr_isshow'][$filter->id])) {
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
