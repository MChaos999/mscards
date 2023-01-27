<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cards extends FrontEndController
{
    private $page_id;

    public function __construct()
    {
        parent::__construct();
        $this->page_id = 15;
        $this->load->model('articles_model');
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

        $this->breadcrumbs[] = $this->_generate_bc_data($page->title, $page->uri);

        foreach (language(true) as $lang) {
            $array = $lang . '_urls';
            $uri = 'uri' . strtoupper($lang);
            $this->{$array}[] = $page->{$uri};
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index);
            }
            if (!empty($post['email'])) {
                $tx = 'Размеры: ' . $post['size'] . '<br>';
                $tx .= 'Тип карты: ' . $post['type-card'] . '<br>';
                $tx .= 'Покрытие: ' . $post['coating'] . '<br>';
                $tx .= 'Дополнительно: ' . $post['add'] . '<br>';
                $tx .= 'Карт холдеры: ' . $post['card-holder'] . '<br>';
                $tx .= 'Имя: ' . $post['name'] . '<br>';
                $tx .= 'Телефон: ' . $post['phone'] . '<br>';
                $tx .= 'E-mail: ' . $post['email'] . '<br>';
                $tx .= 'Сообщение: ' . $post['messages'] . '<br>';

                //            EMAIL TO SERVER
                $this->load->library('email');
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('no-reply@' . $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
                $this->email->to(SEND_EMAIL);
                $this->email->subject('Заказ новой карты с сайта ' . $_SERVER['HTTP_HOST']);
                $this->email->message($tx);
                if ($this->email->send()) {
                    $this->data['messaje'] = CONTACT_SEND_SUCCESS;
                }

            }
        }
        $this->loadOGImgData($page);
        $this->_init_seo_data($page);

        $this->data['inner_view'] = 'pages/cards/index';
        $this->data['page'] = $page;

        $this->_render();
    }
}
