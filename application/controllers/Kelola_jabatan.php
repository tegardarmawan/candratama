<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_jabatan extends CI_Controller
{

    var $module_js = ['kelola-jabatan'];
    var $app_data = [''];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
        if (!$this->is_logged_in()) {
            redirect('Auth');
        }
        //mengambil id dari user
        $this->user_id = $this->session->userdata('id');
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

        $data['title'] = 'Master Jabatan';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('karyawan/kelola_jabatan');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data()
    {
        $result = $this->data->get_all('tjabatan')->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $result = $this->data->find('tjabatan', $where);
        echo json_encode($result);
    }
    public function insert_data()
    {
        $this->form_validation->set_rules('nama', 'Nama Jabatan', 'trim|required|is_unique[tjabatan.nama]');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $nama = ucwords($this->input->post('nama'));
            // $user_id = $this->user_id;
            // $time = date('Y-m-d H:i:s');
            $data = array(
                'nama' => $nama,
            );
            $inserted = $this->data->insert('tjabatan', $data);
            if ($inserted) {
                $response['success'] = 'Data ditambahkan';
            } else {
                $response['error'] = 'Data gagal ditambahkan';
            }
        }
        echo json_encode($response);
    }
    public function edit_data()
    {
        $this->form_validation->set_rules('nama', 'Nama Jabatan', 'trim|required|is_unique[tjabatan.nama]');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $nama = ucwords($this->input->post('nama'));
            $user_id = $this->user_id;
            $time = date('Y-m-d H:i:s');
            $data = array(
                'nama' => $nama,
                'updated_by' => $user_id,
                'updated_date' => $time,
            );
            $where = array('id' => $this->input->post('id'));
            $inserted = $this->data->update('tjabatan', $where, $data);
            if ($inserted) {
                $response['success'] = 'Data diperbarui';
            } else {
                $response['error'] = 'Data gagal diperbarui';
            }
        }
        echo json_encode($response);
    }
    public function delete_data()
    {
        $where = array('id' => $this->input->post('id'));
        $deleted = $this->data->delete('tjabatan', $where);
        if ($deleted) {
            $response['success'] = 'Data dihapus';
        } else {
            $response['error'] = 'Data gagal dihapus';
        }
        echo json_encode($response);
    }
}
