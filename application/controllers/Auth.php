<?php defined("BASEPATH") or exit("No direct script access allowed");

class Auth extends CI_Controller
{
    var $module_js = ['auth'];
    var $app_data = [];
    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }
    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('Admin');
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required', ['required' => 'Username harus diisi']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Password harus diisi']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Admin';
            $this->load->view('header', $data);
            $this->load->view('auth/login', $this->app_data);
            $this->load->view('footer', $this->app_data);
            $this->load->view('js-costum', $this->app_data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $hash = hash("sha256", $password . config_item('encryption_key'));

            $user = $this->db->where(['username' => $username])->get('tuser')->row_array();


            //jika usernya ada
            if ($user) {
                //verify password
                if ($hash == $user['password']) {
                    $data = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'id_credential' => $user['id_credential'],
                    ];
                    //simpan $data pada session
                    $this->session->set_userdata($data);
                    $this->session->set_userdata('id', $user_id);
                    $this->session->set_userdata('logged_in', TRUE);
                    redirect('Admin');
                } else {
                    // Jika verifikasi kata sandi gagal, tampilkan pesan kesalahan
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR,  </strong>Password Salah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR,  </strong>Username yang anda masukkan tidak terdaftar
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('auth');
            }
        }
    }
    public function logout()
    {

        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Anda telah logout,  </strong>Terima kasih sudah menggunakan sistem ini
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('auth');
    }
}
