<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hak_akses extends CI_Controller
{
    var $module_js = ['hak-akses'];
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
        //load menu helper
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['title'] = 'Hak Akses';
        // Load view hak akses
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('fasilitas/hak_akses');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data()
    {
        $result = $this->data->get_all('app_credential')->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $result = $this->data->find('app_credential', $where)->result();
        echo json_encode($result);
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('nama', 'Nama Hak Akses', 'trim|required|is_unique[app_credential.name]');


        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $nama = $this->input->post('nama');
            $data = array('name' => $nama,);

            $this->data->insert('app_credential', $data);
            $response['success'] = 'Data ditambahkan';
        }
        echo json_encode($response);
    }
    public function edit_data()
    {
        $this->form_validation->set_rules('nama', 'Nama Hak Akses', 'trim|required|is_unique[app_credential.name]');


        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $data = array('name' => $nama,);

            $where = array('id' => $id);
            $this->data->update('app_credential', $where, $data);
            $response['success'] = 'Data diubah';
        }
        echo json_encode($response);
    }
    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);

        $count_credential = $this->data->count_where('tuser', 'id_credential', $id);

        if ($count_credential > 0) {
            $response['errors'] = 'GAGAL, terdapat hak akses pada user';
        } else {
            $deleted = $this->data->delete('app_credential', $where);
            if (!$deleted) {
                $response['errors'] = 'Gagal menghapus data';
            } else {
                $response['success'] = 'Data berhasil dihapus';
            }
        }
        echo json_encode($response);
    }
}
