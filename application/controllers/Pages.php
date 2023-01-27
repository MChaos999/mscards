<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends FrontEndController
{
    private $page_id;

    public function __construct()
    {
        parent::__construct();
        $this->page_id = 1;
        $this->load->model('slider_model');
        $this->load->model('benefits_model');
        $this->load->model('articles_model');
        $this->load->model('products_model');
    }

    private function _init_seo_data($page)
    {
        $this->data['page_title'] = (!empty($page->seo_title)) ? $page->seo_title : "";
        $this->data['page_name'] = $page->title;
        $this->data['text_for_layout'] = $page->text;
        $this->data['keywords_for_layout'] = (!empty($page->seo_keywords)) ? $page->seo_keywords : "";
        $this->data['description_for_layout'] = (!empty($page->seo_desc)) ? $page->seo_desc : "";
        $this->data['otitle'] = $page->seo_title;
        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $this->data['lang_urls'][$lang] = $this->{$array};
        }

        $this->data['breadcrumbs'] = $this->breadcrumbs;
    }

    private function loadOGImgData($page, $dir = 'menu')
    {
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

    public function index()
    {
        $page = $this->menu_model->get_page_data_by_id($this->clang, $this->page_id);
        if (empty($page)) throw_on_404();

        $sliders = $this->slider_model->get_sliders($this->clang);
        $this->data['sliders'] = $sliders;

        $home_categories = $this->categories_model->get_categories_home($this->clang);
        $this->data['home_categories'] = $home_categories;

        $products_promo = $this->products_model->get_products_promo($this->clang);
        $this->data['products_promo'] = $products_promo;
//        dump($products_promo);

        $benefits = $this->benefits_model->get_benefits($this->clang);
        $this->data['benefits'] = $benefits;

        $articles = $this->articles_model->get_articles_home($this->clang);
        $this->data['articles'] = $articles;


        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->data['inner_view'] = 'pages/main/index';
        $this->data['page'] = $page;

        $this->_render();
    }

    public function about_us()
    {
        $page = $this->menu_model->get_page_data_by_id($this->clang, 4);
        if (empty($page)) throw_on_404();

        $benefits = $this->benefits_model->get_benefits($this->clang);
        $this->data['benefits'] = $benefits;

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->data['inner_view'] = 'pages/main/about';
        $this->data['page'] = $page;

        $this->_render();
    }

    public function contacts()
    {
        $page = $this->menu_model->get_page_data_by_id($this->clang, 6);
        if (empty($page)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index);
            }
            if (!empty($post['email'])) {

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

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->data['inner_view'] = 'pages/main/contacts';
        $this->data['page'] = $page;

        $this->_render();
    }

    public function text_pages()
    {
        $page = $this->menu_model->get_page_data($this->clang, $this->uri2);
        if (empty($page)) throw_on_404();

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->data['inner_view'] = 'pages/main/text';
        $this->data['page'] = $page;

        $this->_render();
    }
}
