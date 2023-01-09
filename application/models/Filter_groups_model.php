<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_groups_model extends BaseModel {
    protected $tblname = 'filter_groups';

    public function __construct() {
        parent::__construct();
    }

    public function get_filter_groups($lang) {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            title$lang as title,
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, ID DESC');
        return $this->db->get($this->tblname)->result();
    }
}
