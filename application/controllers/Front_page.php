<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Front_page extends CI_Controller
{
    var $module_js = [];
    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }
    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    public function index()
    {
        $welcome = [
            'select' => 'a.title, a.sub_title, b.file_name',
            'from' => 'web_content a',
            'join' => ['web_content_has_image b, b.id_web_content = a.id'],
        ];

        $project = [
            'select' => 'a.title, a.sub_title, a.content, b.file_name',
            'from' => 'web_content a',
            'join' => ['web_content_has_image b, b.id_web_content = a.id'],
            'where' => [
                'a.id_menu' => '39'
            ]
        ];
        $this->app_data['welcome'] = $this->data->get($welcome)->result();
        $this->load->view('front_page/header');
        $this->load->view('front_page/index');
        $this->load->view('front_page/footer');

        //pagination config
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/Candratama/Front_page/index';
        $config['total_rows'] = 6;
        $config['per_page'] = 3;
        //initialize
        $this->pagination->initialize($config);
    }
}
