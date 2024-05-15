<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_warehouse_new extends CI_Controller
{
    var $module_js = ['project-new'];
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
        return $this->session->userdata('logged_in') ===  TRUE;
    }
    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }
    public function index()
    {

        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['project'] = $this->data->get_all('tproject')->result();
        $data['title'] = 'Project Warehouse';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/project_warehouse_new', $data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }

    public function get_nota($nama_customer)
    {
        $nama_customer = urldecode($nama_customer); //urldecode untuk memecah kode yang dikirimkan dari ajax untuk menerima data agar sesuai dengan data yang diinput
        $query = [
            'select' => 'nota',
            'from' => 'tproject',
            'where' => ['namac' => $nama_customer]
        ];
        $result = $this->data->get($query)->row();
        if ($result) {
            echo json_encode(['nota' => $result->nota]);
        } else {
            echo json_encode(['nota' => 'Nota masih kosong!']);
        }
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required|is_unique[tproject_d.nota]');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required|');
        $this->form_validation->set_rules('kodeb', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('namab', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('keluar', 'Barang Keluar', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required');
        $this->form_validation->set_rules('keluar1', 'Sisa Barang', 'trim|required');
        $this->form_validation->set_rules('masuk', 'Barang Masuk', 'trim|required');
        $this->form_validation->set_rules('no', 'No', 'trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $nota = $this->input->post('nota');
            $tgl = $this->input->post('tgl');
            $kodeb = $this->input->post('kodeb');
            $namab = $this->input->post('namab');
            $keluar = $this->input->post('keluar');
            $satuan = $this->input->post('satuan');
            $keluar1 = $this->input->post('keluar1');
            $masuk = $this->input->post('masuk');
            $no = $this->input->post('no');

            $data = array(
                'nota' => $nota,
                'tgl' => $tgl,
                'kodeb' => $kodeb,
                'namab' => $namab,
                'keluar' => $keluar,
                'satuan' => $satuan,
                'keluar1' => $keluar1,
                'masuk' => $masuk,
                'no' => $no,
            );
            $this->data->insert('tproject_d', $data);
            $response['success'] = 'Data berhasil ditambahkan';
        }
        echo json_encode($response);
    }
    public function edit_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required|is_unique[tproject_d.nota]');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required|');
        $this->form_validation->set_rules('kodeb', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('namab', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('keluar', 'Barang Keluar', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required');
        $this->form_validation->set_rules('keluar1', 'Sisa Barang', 'trim|required');
        $this->form_validation->set_rules('masuk', 'Barang Masuk', 'trim|required');
        $this->form_validation->set_rules('no', 'No', 'trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $id = $this->input->post('id');
            $nota = $this->input->post('nota');
            $tgl = $this->input->post('tgl');
            $kodeb = $this->input->post('kodeb');
            $namab = $this->input->post('namab');
            $keluar = $this->input->post('keluar');
            $satuan = $this->input->post('satuan');
            $keluar1 = $this->input->post('keluar1');
            $masuk = $this->input->post('masuk');
            $no = $this->input->post('no');

            $data = array(
                'nota' => $nota,
                'tgl' => $tgl,
                'kodeb' => $kodeb,
                'namab' => $namab,
                'keluar' => $keluar,
                'satuan' => $satuan,
                'keluar1' => $keluar1,
                'masuk' => $masuk,
                'no' => $no,
            );
            $this->data->update('tproject_d', $data);
            $response['success'] = 'Data berhasil diperbarui';
        }
        echo json_encode($response);
    }
}
