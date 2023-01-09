<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_images extends BackEndController
{
    protected $add;
    protected $index_title;
    protected $title;
    protected $success_add;
    protected $success_update_order;
    protected $success_edit;
    protected $success_delete;

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->add = lang('Add');
        $this->success_update_order = lang('You have successfully updated display order!');
        $this->success_add = lang('You have successfully added an object');
        $this->success_edit = lang('You have successfully updated the object');
        $this->success_delete = lang('You have successfully deleted the object');

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('product_images_model');
    }

    public function update_order() {
        check_if_POST();

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception(lang('Error in received data!'));
            }

            foreach($post as $key => $value) {
                $sorder[$value] = $key;
            }

            if (!$this->product_images_model->update_sorder($sorder)) {
                throw new Exception(lang('Error writing data to table') . $this->main_page);
            }

            $result = array(
                "ErrorCode" => 0,
                "ErrorMessage" => $this->success_update_order
            );

        } catch (Exception $e) {
            $errors[] = lang('Exception thrown') . $e->getMessage();

            $result = array(
                "ErrorCode" => 500,
                "ErrorMessage" => $errors
            );
        }

        echo json_encode($result, true);
    }
}
