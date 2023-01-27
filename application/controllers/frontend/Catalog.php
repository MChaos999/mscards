<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use JasonGrimes\Paginator;
class Catalog extends FrontEndController
{
    private $page_id;
    private $per_page;

    public function __construct() {
        parent::__construct();
        $this->page_id = 3;
        $this->per_page = 18;

        $this->load->model('products_model');
        $this->load->model('product_images_model');
        $this->load->model('categories_model');
        $this->load->model('filters_model');
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

        $pagination_nr = @$_GET['page'];
        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;

        $product_all = $this->products_model->get_all_products();
        $products = $this->products_model->get_products_pag($this->clang, $start, $this->per_page);
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

        $this->data['inner_view'] = 'pages/catalog/index';
        $this->data['page'] = $page;

        $this->_render();
    }

    public function category() {
        $page = $this->menu_model->get_page_data_by_id($this->clang, $this->page_id);
        if (empty($page)) throw_on_404();

        $category = $this->categories_model->get_category_by_uri($this->clang, $this->uri3);
        if (empty($category)) throw_on_404();

        $categories_id[] = $category->id;
        $children = $this->categories_model->get_category_children($this->clang, $category->id);

        if (!empty($children)) {
            foreach ($children as $child) {
                $categories_id[] = $child->id;
                $ch = $this->categories_model->get_category_children($this->clang, $child->id);
                if (!empty($ch)) {
                    $child->children = $ch;
                    foreach ($ch as $c) {
                        $categories_id[] = $c->id;
                    }
                }
            }
            $this->data['filter_category'] = $children;
            $this->data['parent_category'] = true;
        } else {
            $this->data['filter_category'] = $this->categories_model->get_category_children($this->clang, $category->parent_id);
        }

        $pagination_nr = @$_GET['page'];

        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;

        if (!empty($_GET['sort'])){
            if (!empty($_GET['fl'])) $features = $_GET['fl']; else $features = array();
            if (!empty($_GET['view'])) $this->per_page = $_GET['view'];

            $product_all = $this->products_model->get_all_category_products_filter($this->clang, $categories_id, $features);
            $products = $this->products_model->get_category_products_pag_filter($this->clang, $categories_id, $start, $this->per_page, $features, $_GET['sort']);
        } else {
            $product_all = $this->products_model->get_all_category_products($categories_id);
            $products = $this->products_model->get_category_products_pag($this->clang, $categories_id, $start, $this->per_page);
        }

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
        $this->data['page_url'] = '/' . $this->uri1 . '/' . $this->uri2 . '/' . $this->uri3;
        $this->data['paginator'] = $paginator;
        $this->data['products'] = $products;
        $this->data['count_products'] = $count;

        $category_filters = $this->filters_model->get_category_filters($this->clang, $categories_id);
        $this->data['category_filters'] = $category_filters;

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach(language(true) as $lang){
            $array = $lang.'_urls';
            $uri = 'uri'.strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->loadOGImgData($category);
        $this->_init_seo_data($category);

        $this->data['inner_view'] = 'pages/catalog/category';
        $this->data['page'] = $page;
        $this->data['category'] = $category;

        $this->_render();
    }

    public function item() {
        $page = $this->menu_model->get_page_data_by_id($this->clang, $this->page_id);
        if (empty($page)) throw_on_404();

        $category = $this->categories_model->get_category_by_uri($this->clang, $this->uri3);
        if (empty($category)) throw_on_404();

        $category = $this->categories_model->get_category_by_uri($this->clang, $this->uri3);
        if (empty($category)) throw_on_404();
        $this->data['category'] = $category;

        $product = $this->products_model->get_product_by_uri($this->clang, $this->uri4);
        if (empty($product)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index);
            }
            if (!empty($post['email'])) {

                $tx = 'Page site: <a href="'.$_SERVER['HTTP_HOST'].'/'.$this->uri1.'/'.$this->uri2.'/'.$this->uri3.'/'.$this->uri4.'">'.$product->title . '</a><br>';
                $tx = 'Name: '.$post['name'] . '<br>';
                $tx .= 'Phone: '.$post['phone'] . '<br>';
                $tx .= 'E-mail: '.$post['email'] . '<br>';
                $tx .= 'Message: '.$post['message'] . '<br>';

                //            EMAIL TO SERVER
                $this->load->library('email');
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('no-reply@' . $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
                $this->email->to(SEND_EMAIL);
                $this->email->subject('Contact message ' . $_SERVER['HTTP_HOST']);
                $this->email->message($tx);
                if ($this->email->send()) {
                    $this->data['messaje'] = CONTACT_SEND_SUCCESS;
                }

            }
        }

        if (!empty($category->parent_id)) {
            $cat_parent1 = $this->categories_model->get_category_by_id($this->clang, $category->parent_id);
            $this->data['cat_parent1'] = $cat_parent1;
        }

        $product->slider = $this->product_images_model->get_media_for_product($product->id);
        $product->prices = $this->products_model->get_products_prices($product->id);

        $product->option = $this->products_model->get_products_options($this->clang, $product->id);
        $product->filters = $this->filters_model->get_product_filters_value($this->clang, $product->id);

        $products_related = $this->products_model->get_products_related($this->clang, $product->id);
        $this->data['products_related'] = $products_related;

        $products_more = $this->products_model->get_products_more($this->clang, $product->id);
        $this->data['products_more'] = $products_more;

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach(language(true) as $lang){
            $array = $lang.'_urls';
            $uri = 'uri'.strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->data['product'] = $product;

        $this->loadOGImgData($product);
        $this->_init_seo_data($product);

        $this->data['inner_view'] = 'pages/catalog/item';
        $this->data['page'] = $page;

        $this->_render();
    }

    public function filter() {

        check_if_POST();

        $filters_get = explode('&', $_POST['filter']);
        $features = array();
        $categories_id = array();
        $page = 1;
        $sort = 1;
        $search = false;
        foreach ($filters_get as $fl) {
            $filters[] = explode('=', $fl);
        }
        foreach ($filters as $key => $filter) {
            if ($filter[0] == 'category_id') {
                $category_id = $filter[1];
            } elseif ($filter[0] == 'sort') {
                $sort = $filter[1];
            } elseif ($filter[0] == 'view') {
                $view = $filter[1];
            } elseif ($filter[0] == 'search') {
                $search = $filter[1];
            } elseif ($filter[0] == 'fl%5B%5D') {
                $features[] = urldecode($filter[1]);
            }
        }


        $this->per_page = $view;
        $pagination_nr = $page;

        $category = $this->categories_model->get_category_by_id($this->clang, $category_id);
        if (!empty($category)){
            $this->data['class_catalog'] = 'catalog-market__product';
            $categories_id[] = $category->id;
            $children = $this->categories_model->get_category_children($this->clang, $category->id);

            if (!empty($children)) {
                foreach ($children as $child) {
                    $categories_id[] = $child->id;
                    $ch = $this->categories_model->get_category_children($this->clang, $child->id);
                    if (!empty($ch)) {
                        $child->children = $ch;
                        foreach ($ch as $c) {
                            $categories_id[] = $c->id;
                        }
                    }
                }
                $this->data['filter_category'] = $children;
                $this->data['parent_category'] = true;
            } else {
                $this->data['filter_category'] = $this->categories_model->get_category_children($this->clang, $category->parent_id);
            }
        } else {
            $this->data['class_catalog'] = 'specials__product';
        }

        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;

        $product_all = $this->products_model->get_all_filter_products($this->clang, $categories_id, $features, $search);
        $products = $this->products_model->get_filter_products_pag($this->clang, $categories_id, $start, $this->per_page, $features, $sort, $search);

        $count = count($product_all);
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

        $_POST['filter'] = str_replace("page=", "page_prev=", $_POST['filter']);
        $string = $_POST['filter'] . '&';
        $this->data['page_url'] = '/' . $this->uri1 . '/' . $this->data['menu']['all'][3]->uri;

        if (!empty($category)){
            $this->data['page_url'] .= '/' . $category->uri;
        }


        $urlPattern = $uri_parts[0] . '?' . $string . 'page=(:num)';
        $paginator = new Paginator(
            $count,
            $this->per_page,
            $pagination_nr,
            $urlPattern
        );
        $paginator->setMaxPagesToShow(5);
        $this->data['page_url'] = '/' . $this->uri1 . '/' . $this->uri2 . '/' . $this->uri3;
        $this->data['paginator'] = $paginator;
        $this->data['products'] = $products;
        $this->data['count_products'] = $count;

        $html = $this->load->view('pages/catalog/_filter', $this->data, true);

        $response['html'] = $html;
        $response['count'] = $count;

        echo json_encode($response);

    }

}
