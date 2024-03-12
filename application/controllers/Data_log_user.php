<?php defined("BASEPATH") or exit("No direct script access allowed");

class Data_log_user extends CI_Controller
{
    var $module_js = ['log-user'];
    var $app_data = [];

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
    { //load menu helper
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['title'] = 'Data Log User';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('fasilitas/log_user');
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_data()
    {
        $result = $this->data->get_all('tlog')->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $result = $this->data->find('tlog', $where)->result();
        echo json_encode($result);
    }
    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $deleted = $this->data->delete('tlog', $where);
        if (!$deleted) {
            $response['errors'] = 'Data gagal dihapus';
        } else {
            $response['success'] = 'Berhasil menghapus data';
        }
        echo json_encode($response);
    }
}
