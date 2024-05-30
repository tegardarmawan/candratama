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
            $this->app_data['project'] = $this->data->find('tproject', ['nota' => $nota])->result();
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
    public function get_data($nota = null)
    {
        if ($nota === null || empty($nota)) {
            echo json_encode(['error' => 'Nota parameter is missing']);
            return;
        }

        $result = $this->data->find('tproject_d', ['nota' => $nota])->result();

        // Jika tidak ada data yang ditemukan, kirim pesan error
        if (empty($result)) {
            echo json_encode(['error' => 'No data found']);
            return;
        }
        // Kirim data dalam format JSON
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
        $nota = $sessionData['nota'];
        $namac = $sessionData['namac'];
        $project = $sessionData['project'];

        if ($nota) {
            $data['nota'] = $nota;
            $data['namac'] = $namac;
            $data['project'] = $project;
            $data['tableData'] = json_decode($sessionData['tableData'], true);

            $this->load->library('pdfgenerator');
            $data['title'] = "Nota $nota";
            $file_pdf = $data['title'];
            $paper = 'A4';
            $orientation = "landscape";
            $html = $this->load->view('project_materials_pdf', $data, true);
            $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        } else {
            // Jika tidak ada nilai nota, tampilkan error atau lakukan tindakan lain
            echo json_encode(['status' => 'error', 'message' => 'Nilai nota tidak ditemukan.']);
        }
    }
}
