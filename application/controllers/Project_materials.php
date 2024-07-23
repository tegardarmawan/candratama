<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_materials extends CI_Controller
{
    var $module_js = ['project-materials'];
    var $app_data = [];
    public function __construct()
    {
        parent::__construct();
        $this->_init();
        if (!$this->logged_in()) {
            redirect('Auth');
        }
    }
    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }
    public function logged_in()
    {
        return $this->session->userdata('logged_in') === TRUE;
    }
    public function index($nota = null)
    {
        $this->load->helper('menu_helper');
        $data['menus'] = generate_sidebar_menu();
        if ($nota) {
            $query = [
                'select' => 'a.nota, a.kodec, b.namac, a.tgl',
                'from' => 'tproject a',
                'where' => ['a.nota' => $nota],
                'join' => [
                    'tcust b, a.kodec = b.kodec, left'
                ],
                'group_by' => 'a.nota, a.kodec, b.namac, a.tgl',
            ];
            $this->app_data['project'] = $this->data->get($query)->row();
        } else {
            $this->app_data['project'] = [];
        }
        $this->app_data['nota'] = $nota;
        $data['title'] = 'Project Materials';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('masterwarehouse/project_materials', $this->app_data);
        $this->load->view('templates/footer');
        $this->load->view('js-costum', $this->app_data);
    }
    public function get_project($nota = null)
    {
        if ($nota) {
            $query = [
                'select' => 'project',
                'from' => 'tproject',
                'where' => ['nota' => $nota],
            ];
            $result = $this->data->get($query)->result();
            if (empty($result)) {
                echo json_encode(['error' => 'No Data Found']);
                return;
            }
        }
        echo json_encode($result);
    }
    public function get_data($nota = null)
    {
        if ($nota === null || empty($nota)) {
            echo json_encode(['error' => 'Nota parameter is missing']);
            return;
        }

        $start_date = $this->input->get('start_date');
        if (!empty($start_date)) {
            $tgl_parts = explode('-', $start_date);
            $start_date = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
        }
        $end_date = $this->input->get('end_date');
        if (!empty($end_date)) {
            $tgl_parts = explode('-', $end_date);
            $end_date = $tgl_parts[2] . '-' . $tgl_parts[1] . '-' . $tgl_parts[0];
        }

        $where = ['nota' => $nota];

        if (!empty($start_date) && !empty($end_date)) {
            $where['tgl >='] = $start_date;
            $where['tgl <='] = $end_date;
        }

        $result = $this->data->find('tproject_d', $where)->result();

        if (empty($result)) {
            echo json_encode(['error' => 'No data found']);
            return;
        }

        echo json_encode($result);
    }


    public function save_session_data()
    {
        $formData = $this->input->post();
        $this->session->set_userdata($formData);
        echo json_encode(['status' => 'success']);
    }

    public function generate_data()
    {
        $sessionData = $this->session->userdata();

        if (!isset($sessionData['nota'])) {
            echo json_encode(['status' => 'error', 'message' => 'Nilai nota tidak ditemukan dalam sesi.']);
            return;
        }

        $nota = $sessionData['nota'];
        $namac = isset($sessionData['namac']) ? $sessionData['namac'] : '';
        $project = isset($sessionData['project']) ? $sessionData['project'] : '';

        $data['nota'] = $nota;
        $data['namac'] = $namac;
        $data['project'] = $project;
        $data['tableData'] = isset($sessionData['tableData']) ? json_decode($sessionData['tableData'], true) : [];
        $username = array('username' => $this->session->userdata('username'));
        $data['user'] = $this->data->find('tuser', $username)->row_array();

        $this->load->library('pdfgenerator');
        $data['title'] = "Nota $nota";
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('project_materials_pdf', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
