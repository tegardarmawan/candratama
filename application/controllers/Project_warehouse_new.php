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

        $data['barang'] = $this->data->get_all('tbarang')->result();
        $data['project'] = $this->data->get_all('tproject')->result();
        $data['title'] = 'Project Warehouse';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/project_warehouse_new', $data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }

    public function get_customer($nota)
    {
        $nota = urldecode($nota);
        $query = [
            'select' => 'namac, project',
            'from' => 'tproject',
            'where' => ['nota' => $nota]
        ];
        $result = $this->data->get($query)->row();
        if ($result) {
            echo json_encode([
                'nama_customer' => $result->namac,
                'project_customer' => $result->project
            ]);
        } else {
            echo json_encode([
                'nama_customer' => 'Nama customer tidak tercantum',
                'project_customer' => 'Project belum ditulis'
            ]);
        }
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('value[]', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('namab[]', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('stock[]', 'Stock Barang', 'trim');
        $this->form_validation->set_rules('keluar[]', 'Barang Keluar', 'trim|required');
        $this->form_validation->set_rules('satuan[]', 'Satuan Barang', 'trim|required');
        $this->form_validation->set_rules('keluar1[]', 'Sisa Barang', 'trim');
        $this->form_validation->set_rules('no', 'No', 'trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $value = $this->input->post('value[]');
            $namab = $this->input->post('namab[]');
            $stock = $this->input->post('stock[]');
            $nota = $this->input->post('nota');
            $tgl = $this->input->post('tgl');
            if (!empty($tgl)) {
                $tgl_parts = explode('/', $tgl);
                $tgl = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
            }
            $keluar = $this->input->post('keluar[]');
            $satuan = $this->input->post('satuan[]');
            $keluar1 = $this->input->post('keluar1[]');
            $masuk = $this->input->post('masuk');
            $no = $this->input->post('no');

            $count = count($value);
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'nota' => $nota,
                    'tgl' => $tgl,
                    'kodeb' => $value[$i],
                    'namab' => $namab[$i],
                    'keluar' => $keluar[$i],
                    'satuan' => $satuan[$i],
                    'keluar1' => $keluar1[$i],
                    'masuk' => $masuk,
                    'no' => $no,
                );
                $inserted = $this->data->insert('tproject_d', $data);
                for ($i = 0; $i < $count; $i++) {
                    $stock = array('stock' => $stock);
                };
                $where = array('kodeb' => $value);
                $this->data->update('tbarang', $where, $stock);
            }
            if ($inserted) {
                $response['success'] = 'Data berhasil ditambahkan';
            } else {
                $response['error'] = 'Gagal menghapus data';
            }
        }
        echo json_encode($response);
    }
}
