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

    public function get_data_kodeb($nama_barang)
    {
        $nama_barang = urldecode($nama_barang);
        $query = [
            'select' => 'kodeb',
            'from' => 'tbarang',
            'where' => [
                'namab' => $nama_barang
            ]
        ];
        $result = $this->data->get($query)->row();
        if ($result) {
            echo json_encode(['kode_barang' => $result->kodeb]);
        } else {
            echo json_encode(['kode_barang' => 'barang belum memiliki kode']);
        }
    }

    public function get_data_stock_satuan($kode_barang)
    {
        $kode_barang = urldecode($kode_barang);
        $query = [
            'select' => 'a.satuan, b.stock',
            'from' => 'tproject_d a',
            'where' => ['a.kodeb' => $kode_barang],
            'join' => [
                'tbarang b, b.kodeb = a.kodeb, left',
            ],
        ];
        $result = $this->data->get($query)->row();
        if ($result) {
            echo json_encode(
                [
                    'stock' => $result->stock,
                    'satuan' => $result->satuan
                ]
            );
        } else {
            echo json_encode([
                'stock' => 'error',
                'satuan' => 'error'
            ]);
        }
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('value[]', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('namab[]', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('keluar[]', 'Barang Keluar', 'trim|required');
        $this->form_validation->set_rules('satuan[]', 'Satuan Barang', 'trim|required');
        $this->form_validation->set_rules('keluar1[]', 'Sisa Barang', 'trim');
        $this->form_validation->set_rules('no', 'No', 'trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $value = $this->input->post('value[]');
            $namab = $this->input->post('namab[]');
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
            }
            if ($inserted) {
                $response['success'] = 'Data berhasil ditambahkan';
            } else {
                $response['error'] = 'Gagal menghapus data';
            }
        }
        echo json_encode($response);
    }
    // public function edit_data()
    // {
    //     $this->form_validation->set_rules('nota', 'Nota', 'trim|required|is_unique[tproject_d.nota]');
    //     $this->form_validation->set_rules('tglproject', 'Tanggal', 'trim|required|');
    //     $this->form_validation->set_rules('kodeb', 'Kode Barang', 'trim|required');
    //     $this->form_validation->set_rules('namab', 'Nama Barang', 'trim|required');
    //     $this->form_validation->set_rules('keluar', 'Barang Keluar', 'trim|required|numeric');
    //     $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required');
    //     $this->form_validation->set_rules('keluar1', 'Sisa Barang', 'trim|required');
    //     $this->form_validation->set_rules('masuk', 'Barang Masuk', 'trim');
    //     $this->form_validation->set_rules('no', 'No', 'trim');

    //     if ($this->form_validation->run() == false) {
    //         $response['errors'] = $this->form_validation->error_array();
    //     } else {
    //         $id = $this->input->post('id');
    //         $nota = $this->input->post('nota');
    //         $tglproject = $this->input->post('tglproject');
    //         if (!empty($tglproject)) {
    //             $tgl_parts = explode('/', $tgl);
    //             $tglproject = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
    //         }
    //         $kodeb = $this->input->post('kodeb');
    //         $namab = $this->input->post('namab');
    //         $keluar = $this->input->post('keluar');
    //         $satuan = $this->input->post('satuan');
    //         $keluar1 = $this->input->post('keluar1');
    //         $masuk = $this->input->post('masuk');
    //         $no = $this->input->post('no');

    //         $data = array(
    //             'nota' => $nota,
    //             'tgl' => $tglproject,
    //             'kodeb' => $kodeb,
    //             'namab' => $namab,
    //             'keluar' => $keluar,
    //             'satuan' => $satuan,
    //             'keluar1' => $keluar1,
    //             'masuk' => $masuk,
    //             'no' => $no,
    //         );

    //         $this->data->update('tproject_d', $id, $data);
    //         $response['success'] = 'Data berhasil diperbarui';
    //     }
    //     echo json_encode($response);
    // }
}
