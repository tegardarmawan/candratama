<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    var $module_js = ['profil'];
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

        $data['title'] = 'Profil';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('fasilitas/profil');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_profil()
    {
        $query = [
            'select' => 'a.id, a.id_credential, a.kode, a.nama, a.username, a.password, b.name as credential',
            'from' => 'tuser a',
            'join' => [
                'app_credential b, b.id = a.id_credential'
            ],
            'where' => [
                'a.username' => $this->session->userdata('username')
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
    // controller edit profil
    public function edit_profil()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password Baru', 'trim|alpha_numeric|min_length[8]');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $where = array('username' => $this->session->userdata('username'));
            $user = $this->data->find('tuser', $where)->row_array();

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = $this->input->post('password1');

            // Hash password if provided
            $hash = '';
            if (!empty($password)) {
                $hash = hash("sha256", $password . config_item('encryption_key'));
            }

            $timestamp = date('Y-m-d H:i:s');

            $dataToUpdate = array(
                'nama' => $nama,
                'username' => $username,
                'updated_date' => $timestamp,
                'updated_by' => $user['id'],
            );

            // Update password if provided
            if (!empty($hash)) {
                $dataToUpdate['password'] = $hash;
            }

            $where = array('id' => $id);
            $this->data->update('tuser', $where, $dataToUpdate);
            $response['success'] = 'Data user diubah';
        }
        echo json_encode($response);
    }
}
