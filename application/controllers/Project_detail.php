<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_detail extends CI_Controller
{
    var $module_js = ['project-detail'];
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
        return $this->session->userdata('logged_in') === TRUE;
    }
    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }
    public function index($nota = null)
    {
        $this->app_data['namacust'] = $this->data->get_all('tcust')->result();
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        if ($nota) {
            $query = [
                'select' => 'a.nota, a.kodec, b.namac, a.tgl',
                'from' => 'tproject a',
                'where' => ['a.nota' => $nota],
                'join' => [
                    'tcust b, a.kodec = b.kodec, left'
                ],
                'group_by' => 'a.nota, a.kodec, b.namac, a.tgl',
            ];
            $this->app_data['project_info'] = $this->data->get($query)->row();
        } else {
            $this->app_data['project_info'] = null;
        }
        $this->app_data['nota'] = $nota;

        $data['title'] = 'Project Detail';
        $data['menus'] = generate_sidebar_menu();
        $this->app_data['notaProject'] = $this->data->generateNotaProject();
        $this->app_data['projectCount'] = $this->data->count('tproject');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('project_interior/project_detail', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }

    public function get_data($nota = null)
    {
        if ($nota) {
            $query = [
                'select' => 'project',
                'from' => 'tproject',
                'where' => ['nota' => $nota],
            ];
            $result = $this->data->get($query)->result();
            if (empty($result)) {
                echo json_encode(['error' => 'No Data Found']);
                return;
            }
        }
        echo json_encode($result);
    }
    public function get_kode_customer()
    {
        $nama_customer = $this->input->post('nama_customer');
        if (!$nama_customer) {
            echo json_encode(['error' => 'Nama customer tidak diterima']);
            return;
        }

        $query = [
            'select' => 'kodec',
            'from' => 'tcust',
            'where' => ['namac' => $nama_customer]
        ];

        $result = $this->data->get($query)->row();
        if ($result) {
            echo json_encode(['kode_customer' => $result->kodec]);
        } else {
            echo json_encode(['error' => 'Kode Customer Tidak Ditemukan']);
        }
    }
}
