<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    var $module_js = ['profil'];
    var $app_data = [''];
    public function __construct()
    {
        parent::__construct();
        $this->_init();
        if (!$this->is_logged_in()) {
            redirect('Auth');
        }
    }
    public function is_logged_in()
    {
        $this->session->userdata('logged_in') === TRUE;
    }
    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }
    public function index()
    {
        $data['title'] = 'Profil';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('fasilitas/profil');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_profil()
    {
        $query = [
            'select' => 'a.id, a.id_credential, a.kode, a.nama, a.username, a.password, b.name as credential',
            'from' => 'tuser a',
            'join' => [
                'app_credential b, b.id = a.id_credential'
            ],
            'where' => [
                'a.username' => $this->session->userdata('username')
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
}
