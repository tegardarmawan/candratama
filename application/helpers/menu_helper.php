<!-- // application/helpers/sidebar_helper.php -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_sidebar_menu')) {
    function generate_sidebar_menu()
    {
        $CI = &get_instance();

        $CI->load->database();

        $menus = $CI->db->query("SELECT * FROM app_menu WHERE type IN ('1', '2') AND is_sidebar_menu = '1'")->result_array();

        return $menus;
    }
}
?>