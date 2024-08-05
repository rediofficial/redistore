<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function check_role($required_role_id) {
    $CI =& get_instance();
    $CI->load->library('session');

    if (!$CI->session->userdata('id_user')) {
        redirect('login/authen');
        exit();
    }

    $user_role_id = $CI->session->userdata('role_id');

    if ($user_role_id != $required_role_id) {
        show_error('Access denied!', 403, 'Forbidden');
    }
}
?>
