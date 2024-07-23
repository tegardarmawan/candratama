<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    var $module_js = ['project'];
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
        $this->app_data['namacust'] = $this->data->get_all('tcust')->result();
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();

        $data['title'] = 'Project';
        $data['menus'];
        $this->app_data['notaProject'] = $this->data->generateNotaProject();
        $this->app_data['project'] = $this->data->count('tproject');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('project_interior/project', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }

    public function get_data()
    {
        $subquery = "(SELECT MAX(id) as id FROM tproject GROUP BY nota) as sub";
        $this->db->select('a.id, a.nota, a.kodec, b.namac, a.project');
        $this->db->from('tproject a');
        $this->db->join($subquery, 'a.id = sub.id', 'inner');
        $this->db->join('tcust b', 'a.kodec = b.kodec', 'left');
        $this->db->where('a.is_deleted', 0);
        $this->db->order_by('a.id', 'DESC');
        $result = $this->db->get()->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id');
        $query = [
            'select' => 'a.id, a.nota, a.kodec, b.namac, a.project, a.kontrak, a.user',
            'from' => 'tproject a',
            'where' => ['a.id' => $id],
            'join' => [
                'tcust b, a.kodec = b.kodec, left'
            ],
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }
}
