
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_warehouse extends CI_Controller
{
    var $module_js = ['project-warehouse'];
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
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['title'] = 'Project Warehouse';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/project_warehouse');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data()
    {
        $query = [
            'select' => 'a.id, a.nota, a.tgl, b.kodeb, b.namab, a.keluar, a.satuan, a.keluar1, a.no ',
            'from' => 'tproject_d a',
            'join' => [
                'tbarang b, b.kodeb = a.kodeb, left'
            ],
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $id = $this->input->post('id');
        $query = [
            'select' => 'a.id, a.nota, a.tgl, b.kodeb, b.namab, a.keluar, a.satuan, a.keluar1, a.no ',
            'from' => 'tproject_d a',
            'join' => [
                'tbarang b, b.kodeb = a.kodeb, left'
            ],
            'where' => ['a.id' => $id],
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $deleted = $this->data->delete('tproject_d', $where);
        if ($deleted) {
            $response['success'] = 'Data berhasil dihapus';
        } else {
            $response['error'] = 'Gagal menghapus data';
        }
        echo json_encode($response);
    }
}
