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
    public function index($nota = null)
    {
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
            $data['project_details'] = $this->data->get($query)->row();
        } else {
            $data['project_details'] = null;
        }
        $data['nota'] = $nota;
        $where = array('id_divisi' => 2);
        $data['tukang'] = $this->data->find('tkaryawan', $where)->result();
        $data['barang'] = $this->data->get_all('tbarang')->result();
        $data['project'] = $this->data->get_all('tproject')->result();
        $data['title'] = 'Project Warehouse';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/project_warehouse_new', $data);
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

    public function get_data_id()
    {
        $id = $this->input->post('id');
        $query = [
            'select' => 'a.id, a.nota, a.kodec, a.namac, a.project',
            'from' => 'tproject a',
            'where' => ['a.id' => $id],
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
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
        $this->form_validation->set_rules('namat', 'Nama Tukang', 'trim');

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
            $namac = $this->input->post('namac');
            $namat = $this->input->post('namat');

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
                );
                $inserted = $this->data->insert('tproject_d', $data);
                //melakukan update pada stock barang
                if (is_array($stock) && isset($stock[$i]) && is_array($value) && isset($value[$i])) {
                    $stockData = array('stock' => $stock[$i]);
                    $whereData = array('kodeb' => $value[$i]);
                    $this->data->update('tbarang', $whereData, $stockData);
                }
                $notakeluar = $this->data->generateNota();
                if (is_array($stock) && isset($stock[$i]) && is_array($value) && isset($value[$i])) {
                    $datakeluar = array(
                        'nota' => $notakeluar,
                        'tgl' => $tgl,
                        'ket' => 'Barang project ' . $nota,
                        'kodeb' => $value[$i],
                        'namab' => $namab[$i],
                        'keluar' => $keluar[$i],
                        'projectt' => $namac,
                        'namat' => $namat,
                        'tipe' => 2,
                    );
                    $this->data->insert('tstock', $datakeluar);
                }
            }
            if ($inserted) {
                $response['success'] = 'Data berhasil ditambahkan';
            } else {
                $response['error'] = 'Gagal menambah data';
            }
        }
        echo json_encode($response);
    }
}
