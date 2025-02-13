<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_new extends CI_Controller
{
    var $module_js = ['project_new'];
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

        $data['title'] = 'Project Baru';
        $data['menus'];
        $this->app_data['notaProject'] = $this->data->generateNotaProject();
        $this->app_data['project'] = $this->data->count('tproject');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('project_interior/project_new', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
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
    public function insert_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required');
        $this->form_validation->set_rules('project[]', 'Nama Project', 'trim|required');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('namac'))) {
                $response['errors'] = 'Nama customer harus dipilih';
            }
        } else {
            $nota = $this->input->post('nota');
            $kodec = $this->input->post('kodec');
            $namac = $this->input->post('namac');
            $project = $this->input->post('project[]');
            $project = array_map('strtoupper', $project);
            if (empty($kodec)) {
                $response['errors'] = 'Kode customer harus dipilih';
            }
            $tgl = $this->input->post('tgl');
            if (!empty($tgl)) {
                $tgl_parts = explode('/', $tgl);
                $tgl = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
            }
            $count = count($project);
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'nota' => $nota,
                    'kodec' => $kodec,
                    'namac' => $namac,
                    'project' => $project[$i],
                    'tgl' => $tgl,
                );
                $this->data->insert('tproject', $data);
            }
            $response = [
                'success' => 'Data berhasil ditambahkan',
            ];
        }
        echo json_encode($response);
    }
    public function edit_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required');
        $this->form_validation->set_rules('project', 'Nama Project', 'trim|required');
        $this->form_validation->set_rules('kontrak', 'Kontrak perjanjian', 'trim|required');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('kodec'))) {
                $response['errors'] = 'Nama customer harus dipilih';
            }
        } else {
            $id = $this->input->post('id');
            $nota = $this->input->post('nota');
            $kodec = $this->input->post('kodec');
            $namac = $this->input->post('namac');
            $project = ucwords($this->input->post('project'));
            $kontrak = $this->input->post('kontrak');


            $data = array(
                'nota' => $nota,
                'kodec' => $kodec,
                'namac' => $namac,
                'project' => $project,
                'kontrak' => $kontrak,
            );
            $where = array('id' => $id);
            $this->data->update('tproject', $where, $data);
            $notaproject = $this->data->generateNotaProject();
            $response = [
                'success' => 'Data berhasil diperbarui',
                'notaproject' => $notaproject,
            ];
        }
        echo json_encode($response);
    }
    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $deleted = $this->data->delete('tproject', $where);
        if ($deleted) {
            $notaproject = $this->data->generateNotaProject();
            $response = [
                'success' => 'Data berhasil dihapus',
                'notaproject' => $notaproject,
            ];
        } else {
            $response['error'] = "Data gagal dihapus";
        }
        echo json_encode($response);
    }
}
