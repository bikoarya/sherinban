<?php
function is_login() //memvalidasi akses login
{
    $log = get_instance();
    if (!$log->session->userdata('username')) {
        redirect('Auth/Login');
    } else {
        $id_lvl = $log->session->userdata('id_level');
        $akses = $log->uri->segment('1');

        $query = $log->db->get_where('t_user', ['id_level' => $id_lvl])->row_array();
        $menuId = $query['id_level'];

        $level = $log->db->get_where('t_level', [
            'id_level' => $menuId,
            'id_level' => $akses
        ])->row_array();

        // if ($level['id_level'] == 5) {
        //     redirect('Auth/blocked');
        // } else {
            
        // }
    }
}
