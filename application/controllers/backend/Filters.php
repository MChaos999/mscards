<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters extends BackEndController {
    protected $add;
    protected $index_title;
    protected $title;
    protected $success_add;
    protected $success_update_order;
    protected $success_edit;
    protected $success_delete;

    public function __construct() {
        parent::__construct(__CLASS__);

        $this->index_title = lang('Filters');
        $this->add = lang('Add');
        $this->success_update_order = lang('You have successfully updated display order!');
        $this->success_add = lang('You have successfully added an object');
        $this->success_edit = lang('You have successfully updated the object');
        $this->success_delete = lang('You have successfully deleted the object');

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('filters_model');
        $this->load->model('filter_groups_model');
    }

    public function index() {
        $objects = $this->filters_model->find();
        $filter_groups = $this->filter_groups_model->find();

        $this->data['inner_view'] = $this->index_view;
        $this->data['objects'] = $objects;
        $this->data['filter_groups'] = $filter_groups;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function put() {
        check_if_POST();
        $post = array();
        try {
            foreach ($_POST as $index => $item) {
                $post[$index] = $this->input->post($index, TRUE);
            }

            if (!$this->filters_model->put($post)) {
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

        $this->load->model('filters_model');

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception(lang('Error in received data!'));
            }

            if (!$this->filters_model->update_sorder($post)) {
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

        $item = $this->filters_model->find_first($id);
        if (empty($item)) throw_on_404();

        $filter_groups = $this->filter_groups_model->find();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }

                if (!$this->filters_model->update($post, $id)) {
                    throw new Exception(lang('Error writing data to table') . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = lang('Exception thrown') . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->filters_model->find_first($id);
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = lang('Edit') . $item->{'title'.get_language_for_admin(true)};
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;
        $this->data['filter_groups'] = $filter_groups;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false) {
        $id = (int)$id;

        $item = $this->filters_model->find_first($id);
        if (empty($item)) throw_on_404();

        try {
            if (!$this->filters_model->delete($id)) {
                throw new Exception(lang('Error deleting data from table') . $this->main_page);
            }
            // stergem din toate tabelele unde avem filter_id
            $this->db->where("filter_id", $id)->delete("product_filters_value");
            $this->db->where("filter_id", $id)->delete("product_filters_value_cached");
            $this->db->where("filter_id", $id)->delete("category_filters");

            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = lang('Exception thrown') . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }
}
