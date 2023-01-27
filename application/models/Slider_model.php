<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends BaseModel
{
    protected $tblname = 'slider';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_sliders($lang = false){
        if (empty($lang)) {
            return false;
        }

        $this->db->select("
            id, 
            title$lang as title,
            img$lang as img
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }
}
