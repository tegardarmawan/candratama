<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    var $module_js = ['project'];
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
    public function index()
    {
        $this->app_data['namacust'] = $this->data->get_all('tcust')->result();
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['title'] = 'Project';
        $data['menus'];
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('project_interior/project', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_kode_customer($nama_customer)
    {
        $nama_customer = urldecode($nama_customer);
        $query = [
            'select' => 'kodec',
            'from' => 'tcust',
            'where' => ['namac' => $nama_customer]
        ];

        $result = $this->data->get($query)->row();
        if ($result) {
            //jika data ditermukan, maka kirimkan respon JSON
            //kode_customer merupakan variabel yang akan dipanggil pada js
            echo json_encode(['kode_customer' => $result->kodec]);
        } else {
            //jika data tidak ditemukan, maka kirimkan respon error
            echo json_encode(['error' => 'Kode Customer Tidak Ditemukan']);
        }
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id, a.nota, b.kodec, b.namac, a.project, a.kontrak, a.user',
            'from' => 'tproject a',
            'join' => [
                'tcust b, b.kodec = a.kodec',
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $id = $this->input->post('id');
        $query = [
            'select' => 'a.id, a.nota, b.kodec, b.namac, a.project, a.kontrak, a.user',
            'from' => 'tproject a',
            'join' => [
                'tcust b, b.kodec = a.kodec',
            ],
            'where' => ['a.id' => $id],
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
    public function insert_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required|is_unique[tcust.nota]');
        $this->form_validation->set_rules('project', 'Nama Project', 'trim|required');
        $this->form_validation->set_rules('kontrak', 'Kontrak perjanjian', 'trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('kodec'))) {
                $response['errors'] = 'Kode customer harus dipilih';
            }
        } else {
            $nota = $this->input->post('nota');
            $kodec = $this->input->post('kodec');
            $namac = $this->input->post('namac');
            $project = $this->input->post('project');
            $kontrak = $this->input->post('kontrak');
            if (empty($kodec)) {
                $response['errors'] = 'Kode customer harus dipilih';
            }
            $data = array(
                'nota' => $nota,
                'kodec' => $kodec,
                'namac' => $namac,
                'project' => $project,
                'kontrak' => $kontrak,
            );
            $this->data->insert('tcust', $data);
            $response['success'] = 'Data berhasil ditambahkan';
        }
        echo json_encode($response);
    }
    public function edit_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required|is_unique[tcust.nota]');
        $this->form_validation->set_rules('project', 'Nama Project', 'trim|required');
        $this->form_validation->set_rules('kontrak', 'Kontrak perjanjian', 'trim|required');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('kodec'))) {
                $response['errors'] = 'Kode customer harus dipilih';
            }
        } else {
            $id = $this->input->post('id');
            $nota = $this->input->post('nota');
            $kodec = $this->input->post('kodec');
            $namac = $this->input->post('namac');
            $project = $this->input->post('project');
            $kontrak = $this->input->post('kontrak');
            if (empty($kodec)) {
                $response['errors'] = 'Kode customer harus dipilih';
            }
            $where = $id;
            $data = array(
                'nota' => $nota,
                'kodec' => $kodec,
                'namac' => $namac,
                'project' => $project,
                'kontrak' => $kontrak,
            );
            $this->data->update('tcust', $where, $data);
            $response['success'] = 'Data berhasil ditambahkan';
        }
        echo json_encode($response);
    }
}
