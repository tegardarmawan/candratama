<?php defined("BASEPATH") or exit("No direct script access allowed");

class Auth extends CI_Controller
{
    var $module_js = ['auth'];
    var $app_data = [''];
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
        $this->form_validation->set_rules('username', 'Username', 'trim|required', ['required' => 'Username harus diisi']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Password harus diisi']);

        if ($this->form_validation->run() == false) {
            $this->load->view('header');
            $this->load->view('auth/login', $this->app_data);
            $this->load->view('footer');
            $this->load->view('js-costum', $this->app_data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('tuser', ['nama' => $username])->row_array();


            //jika usernya ada
            if ($user) {
                //verify password
                if ($password == $user['pass']) {
                    // Jika verifikasi kata sandi berhasil, lanjutkan ke halaman Admin
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
        $data['user'] = $this->db->get_where('tuser', ['email' => $this->session->userdata('email')])->row_array();

        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Anda telah logout,  </strong>Terima kasih sudah menggunakan sistem ini
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('auth');
    }
}
