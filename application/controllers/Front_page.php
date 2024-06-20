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
            'select' => '*',
            'from' => 'web_content',
            'where' => ['id' => 8],
        ];
        $data['greeting'] = $this->data->get($welcome)->result();

        $project = [
            'select' => 'a.title, a.sub_title, a.content, b.file_name',
            'from' => 'web_content a',
            'join' => ['web_content_has_image b, b.id_web_content = a.id'],
            'where' => [
                'a.id_menu' => '39'
            ]
        ];
        // pengelolaan visi misi
        $wherevisi = [
            'id_menu' => 44
        ];
        $data['visi'] = $this->data->find('web_content', $wherevisi)->result();
        // pengelolaan layanan
        $wherelayanan = [
            'id_menu' => 45,
            'content' => NULL,
        ];
        $data['layanan'] = $this->data->find('web_content', $wherelayanan)->result();
        // pengelolaan testimonials pelanggan
        $wherepelanggan = ['id_menu' => 46];
        $data['testi'] = $this->data->find('web_content', $wherepelanggan)->result();
        // pengelolaan portofolio
        $data['category'] = $this->data->get_all('project_category')->result();
        $portofolio = [
            'select' => 'a.title, a.description, b.name, a.file_name',
            'from' => 'project_image a',
            'join' => ['project_category b, b.id = a.id_category'],
        ];
        $data['portofolio'] = $this->data->get($portofolio)->result();

        $data['company'] = $this->data->get_all('company_profile')->result();
        $data['social'] = $this->data->get_all('social_media')->result();
        $data['title'] = 'Candratama Granites';
        $data['client'] = $this->data->count('tcust');
        $data['project'] = $this->data->count('tproject');
        $data['karyawan'] = $this->data->count('tkaryawan');
        $this->app_data['welcome'] = $this->data->get($welcome)->result();
        $this->load->view('front_page/header', $data);
        $this->load->view('front_page/index', $data);
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
