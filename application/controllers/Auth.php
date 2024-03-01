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
        // if ($this->session->userdata('email')) {
        //     redirect('Admin');
        // }
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
            $hash = hash("sha256", $password . config_item('encryption_key'));

            $user = $this->db->where(['nama' => $username])->get('tuser')->row_array();

            //jika usernya ada
            if ($user) {
                if ($hash == $user['password']) {
                    $data = [
                        'id' => $user['id'],
                        'nama' => $user['nama']
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_userdata('logged_in', true);
                    redirect('Admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR,  </strong>Username yang anda masukkan tidak terdaftar
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                    redirect('auth');
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
