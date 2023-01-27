<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontEndController extends CI_Controller
{
    protected $uri1;
    protected $uri2;
    protected $uri3;
    protected $uri4;
    protected $uri5;
    protected $uri6;
    protected $uri7;
    protected $data;
    protected $layout_path;
    protected $langs;
    protected $lclang;
    protected $clang;
    protected $site_url;
    protected $without_get_url;
    protected $full_url;
    protected $breadcrumbs;

    private function _define_constants()
    {
        $this->load->model('constants_model');
        $constants = $this->constants_model->find();
        $lang = get_language(TRUE);
        foreach ($constants as $constant) {
            if (!defined($constant->name)) {
                define($constant->name, $constant->$lang);
            }
        }
    }

    protected function _generate_bc_data($title = '', $url = false)
    {
        $result['title'] = $title;
        if (!empty($url)) {
            $result['url'] = $url;
        }
        return $result;
    }

    public function __construct()
    {
        parent::__construct();

        @session_start();
        $this->load->library(['cart']);

        date_default_timezone_set('Europe/Bucharest');
        header('Content-type: text/html; charset=utf-8');
        header('X-XSS-Protection: 1; mode=block');
        header('X-Content-Type-Options: nosniff');
        header('Strict-Transport-Security: max-age=31536000');
        header('X-Frame-Options: deny');
        header("Cache-Control: max-age=31536000");
        header("Referrer-Policy: same-origin");
        header("Feature-Policy: microphone 'none'; geolocation 'none';");

        $this->uri1 = uri(1);
        $this->uri2 = uri(2);
        $this->uri3 = uri(3);
        $this->uri4 = uri(4);
        $this->uri5 = uri(5);
        $this->uri6 = uri(6);
        $this->uri7 = uri(7);

        if (empty($_SESSION['lang'])) get_prefered_language();

        assign_language($this->uri1);

        $this->_define_constants();

        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->output->set_header('X-Content-Type-Options: nosniff');

        $this->layout_path = 'pages/index';
        $this->langs = array_map('strtoupper', language(true));
        $this->lclang = get_language(FALSE);
        $this->clang = get_language(TRUE);
        $this->site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
        $this->without_get_url = $this->site_url . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $this->full_url = $this->site_url . $_SERVER['REQUEST_URI'];
        $this->breadcrumbs = array();

        $this->load->model('menu_model');

        $menu = $this->menu_model->get_menu($this->clang);

        $this->load->library('user_agent');
        $this->data['is_mobile'] = $this->agent->is_mobile();

        $this->categories_nav();

        //        cart
        $this->data['total_items_cart'] = $this->cart->total_items();
        $this->data['total_price_cart'] = $this->cart->total();

        $this->data['uri1'] = $this->uri1;
        $this->data['uri2'] = $this->uri2;
        $this->data['uri3'] = $this->uri3;
        $this->data['uri4'] = $this->uri4;
        $this->data['uri5'] = $this->uri5;
        $this->data['uri6'] = $this->uri6;
        $this->data['uri7'] = $this->uri7;
        $this->data['langs'] = $this->langs;
        $this->data['lclang'] = $this->lclang;
        $this->data['clang'] = $this->clang;
        $this->data['site_url'] = $this->site_url;
        $this->data['without_get_url'] = $this->without_get_url;
        $this->data['full_url'] = $this->full_url;
        $this->data['menu'] = $menu;

        $this->ilab_info();
    }

    protected function _render()
    {
        $this->load->vars($this->data);
        $this->load->view($this->layout_path);
    }

    private function ilab_info(){
        if ($this->clang == 'RU') {
            $ilab = 'Разработка сайта - ilab.ro';
            $ilab_linc = 'https://ilab.ro/';
        } elseif ($this->clang == 'EN'){
            $ilab = 'Site development - ilab.ro';
            $ilab_linc = 'https://ilab.ro/en';
        } else {
            $ilab = 'Elaborarea siteului - ilab.ro';
            $ilab_linc = 'https://ilab.ro';
        }
        $this->data['ilab'] = $ilab;
        $this->data['ilab_linc'] = $ilab_linc;
    }

    private function categories_nav(){
        $this->load->model('categories_model');

        //        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
//        if(!$categories = $this->cache->get('categories'.$this->clang)) {
//            $categories = $this->categories_model->get_category_menu($this->clang);
//            $categories = categories_map($categories);
//            $this->cache->save('categories'.$this->clang, $categories, 60 * 60 * 6);
//        }

        $categories = $this->categories_model->get_category_menu($this->clang);
        $categories_onPromotion = $this->categories_model->get_category_onPromotion($this->clang);
        $categories = categories_map($categories);
        $this->data['categories'] = $categories;
        $this->data['categories_onPromotion'] = $categories_onPromotion;

    }
}
