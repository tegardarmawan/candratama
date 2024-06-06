<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_barang_masuk extends CI_Controller
{

    var $module_js = ['barang-masuk'];

    var $app_data = [];

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
    public function index($kodeb = null)
    {
        //load menu helper
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        if ($kodeb) {
            $data['barang_masuk'] = $this->data->find('tbarang', ['kodeb' => $kodeb])->result();
        } else {
            $data['barang_masuk'] = [];
        }
        $data['group'] = $this->data->get_all('tgroup')->result();
        $data['satuan'] = $this->data->get_all('tsatuan')->result();
        $data['project'] = $this->data->get_all('tproject')->result();
        $data['title'] = 'Kelola Data Barang';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/data_barang_masuk', $data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function edit_data()
    {
        // kodeg kodest status1 project => form select
        $this->form_validation->set_rules('kodeb', 'Kode', 'trim|required');
        $this->form_validation->set_rules('namab', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('hbeli', 'Harga Beli', 'trim|required');
        $this->form_validation->set_rules('hpokok', 'Harga Pokok', 'trim|required');
        $this->form_validation->set_rules('hjual', 'Harga Jual', 'trim|required');
        $this->form_validation->set_rules('stockmin', 'Stock Minimal', 'trim|required');
        $this->form_validation->set_rules('namat', 'Nama Terang', 'trim|required');
        if (empty($this->input->post('kodeg'))) {
            $response['errors']['kodeg'] = "Kode group harus dipilih";
        }
        if (empty($this->input->post('satuan'))) {
            $response['errors']['satuan'] = "Satuan harus dipilih";
        }

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $id = $this->input->post('id');
            $kodeg = $this->input->post('kodeg');
            $kodeb = $this->input->post('kodeb');
            $nama = ucwords($this->input->post('namab'));
            $kodest = $this->input->post('satuan');
            $hargab = $this->input->post('hbeli');
            $hargap = $this->input->post('hpokok');
            $hargaj = $this->input->post('hjual');
            $stockmin = $this->input->post('stockmin');
            $namat = ucwords($this->input->post('namat'));
            $project = $this->input->post('project');

            if (empty($kodeg)) {
                $response['errors']['kodeg'] = "Kode group harus dipilih";
            }
            if (empty($kodest)) {
                $response['errors']['kodest'] = "Kode satuan harus dipilih";
            } else {
                $data = array(
                    'kodeg' => $kodeg,
                    'kodeb' => $kodeb,
                    'namab' => $nama,
                    'satuan' => $kodest,
                    'hbeli' => $hargab,
                    'hpokok' => $hargap,
                    'hjual' => $hargaj,
                    'stockmin' => $stockmin,
                    'namat' => $namat,
                    'projectt' => $project,
                );
                $where = array('id' => $id);
                $this->data->update('tbarang', $where, $data);
                $response['success'] = "Data berhasil diperbarui";
            }
        }
        echo json_encode($response);
    }
}
