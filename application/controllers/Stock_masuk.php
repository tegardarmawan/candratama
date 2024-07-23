<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_masuk extends CI_Controller
{

    var $module_js = ['stock-masuk'];

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
    public function index()
    {
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();
        $data['barang'] = $this->data->get_all('tbarang')->result();

        $data['title'] = 'Stock Masuk';
        $data['nota'] = $this->data->generateNota();
        $where = array('id_divisi' => 2);
        $data['tukang'] = $this->data->find('tkaryawan', $where)->result();
        $query = [
            'select' => 'namac, nota',
            'from' => 'tproject',
            'group_by' => 'namac, nota',
            'order_by' => 'nota desc',
        ];
        $data['project'] = $this->data->get($query)->result();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/stock_masuk_new', $data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function insert_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'trim');
        $this->form_validation->set_rules('namat', 'Nama Tukang', 'trim');
        $this->form_validation->set_rules('project', 'Nama Project', 'trim');
        $this->form_validation->set_rules('value[]', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('namab[]', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('masuk[]', 'Qty', 'trim|required|numeric');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $kodeb = $this->input->post('value[]');
            $namab = $this->input->post('namab[]');
            $masuk = $this->input->post('masuk[]');
            $nota = $this->input->post('nota');
            $tgl = $this->input->post('tgl');
            if (!empty($tgl)) {
                $tgl_parts = explode('/', $tgl);
                $tgl = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
            }
            $ket = ucwords($this->input->post('ket'));
            $namat = $this->input->post('namat');
            $project = $this->input->post('project');
        }

        $count = count($kodeb);
        for ($i = 0; $i < $count; $i++) {
            $data = array(
                'nota' => $nota,
                'tgl' => $tgl,
                'ket' => $ket,
                'namat' => $namat,
                'projectt' => $project,
                'kodeb' => $kodeb[$i],
                'namab' => $namab[$i],
                'masuk' => $masuk[$i],
                'tipe' => 1,
            );
            $inserted = $this->data->insert('tstock', $data);
            $where = array('kodeb' => $kodeb[$i]);
            $this->data->update_stock_increment('tbarang', $where, $masuk[$i]);
        }
        if ($inserted) {
            $response['success'] = 'Data berhasil ditambahkan';
        } else {
            $response['error'] = 'Gagal menambah data';
        }
        echo json_encode($response);
    }
}
