<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_divisi extends CI_Controller
{

    var $module_js = ['kelola-divisi'];
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
        $this->load->view('karyawan/kelola_divisi');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data()
    {
        $where = array('is_deleted' => 0);
        $result = $this->data->find('tdivisi', $where)->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $where = array('id' => $this->input->post('id'));
        $result = $this->data->find('tdivisi', $where)->result();
        echo json_encode($result);
    }
    public function insert_data()
    {
        $this->form_validation->set_rules('nama', 'Nama Divisi', 'trim|required|is_unique[tdivisi.nama_divisi]');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $where = array('username' => $this->session->userdata('username'));
            $data['user'] = $this->data->find('tuser', $where)->row_array();
            $timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;
            $nama = ucwords($this->input->post('nama'));
            $data = array(
                'nama_divisi' => $nama,
                'created_date' => $timestamp,
                'created_by' => $data['user']['id'],
            );
            $inserted = $this->data->insert('tdivisi', $data);
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
        $this->form_validation->set_rules('nama', 'Nama Divisi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $where = array('username' => $this->session->userdata('username'));
            $data['user'] = $this->data->find('tuser', $where)->row_array();
            $timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;
            $nama = ucwords($this->input->post('nama'));
            $data = array(
                'nama_divisi' => $nama,
                'updated_date' => $timestamp,
                'created_by' => $data['user']['id'],
            );
            $id = array('id' => $this->input->post('id'));
            $inserted = $this->data->update('tdivisi', $id, $data);
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
        $data = array('is_deleted' => 1);
        $deleted = $this->data->update('tdivisi', $where, $data);
        if ($deleted) {
            $response['success'] = 'Data dihapus';
        } else {
            $response['erros'] = 'Data gagal dihapus';
        }
        echo json_encode($response);
    }
}
