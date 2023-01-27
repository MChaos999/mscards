<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benefits_model extends BaseModel
{
    protected $tblname = 'benefits';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_benefits($lang)
    {
        if (empty($lang)) return false;
        $this->db->select("            
            id as id, 
            title$lang as title, 
            img as img,
            ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }
}
