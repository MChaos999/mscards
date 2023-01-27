<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use JasonGrimes\Paginator;
class Search extends FrontEndController
{
    private $page_id;
    private $per_page;

    public function __construct() {
        parent::__construct();
        $this->page_id = 10;
        $this->per_page = 18;

        $this->load->model('products_model');
        $this->load->model('product_images_model');
        $this->load->model('categories_model');
    }

    private function _init_seo_data($page) {
        $this->data['page_title'] = (!empty($page->seo_title)) ? $page->seo_title : "";
        $this->data['page_name'] = $page->title;
        $this->data['text_for_layout'] = $page->text;
        $this->data['keywords_for_layout'] = (!empty($page->seo_keywords)) ? $page->seo_keywords : "";
        $this->data['description_for_layout'] = (!empty($page->seo_desc)) ? $page->seo_desc : "";
        $this->data['otitle'] = $page->seo_title;
        foreach(language(true) as $lang){
            $array = $lang.'_urls';
            $this->data['lang_urls'][$lang] = $this->{$array};
        }

        $this->data['breadcrumbs'] = $this->breadcrumbs;
    }

    private function loadOGImgData($page, $dir = 'menu') {
        if (!empty($page->img)) {
            $this->data['og_img'] = newthumbs($page->img, $dir, 500, 300, 'og500x300x1', 1);
            $this->data['og_img_width'] = 500;
            $this->data['og_img_height'] = 300;
        } else {
            $this->data['og_img'] = newthumbs('og.png', 'i', 50, 50, 'og50x50x1', 1);
            $this->data['og_img_width'] = 214;
            $this->data['og_img_height'] = 51;
        }
    }

    public function index() {

        $page = $this->menu_model->get_page_data_by_id($this->clang, $this->page_id);
        if (empty($page)) throw_on_404();

        if (empty($_GET['search'])) $_GET['search'] = false;

        $pagination_nr = @$_GET['page'];
        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;

        $product_all = $this->products_model->get_all_products_search($_GET['search']);
        $products = $this->products_model->get_products_pag_search($this->clang, $start, $this->per_page, 4, $_GET['search']);
        $count = count($product_all);

        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $string = '';

        $urlPattern = $uri_parts[0] . '?' . $string . 'page=(:num)';
        $paginator = new Paginator(
            $count,
            $this->per_page,
            $pagination_nr,
            $urlPattern
        );
        $paginator->setMaxPagesToShow(5);
        $this->data['page_url'] = '/' . $this->uri1 . '/' . $this->uri2;
        $this->data['paginator'] = $paginator;

        $this->data['products'] = $products;
        $this->data['count_products'] = $count;


        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach(language(true) as $lang){
            $array = $lang.'_urls';
            $uri = 'uri'.strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->data['inner_view'] = 'pages/catalog/search';
        $this->data['page'] = $page;

        $this->_render();
    }

    public function search() {

        check_if_POST();
    }
}
