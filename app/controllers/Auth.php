<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->database('main'); 
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->io->post('username') ?? '';
            $password = $this->io->post('password') ?? '';

            $query_result = $this->db->table('auth')->where('username', $username)->get();

            // Ligtas na pagkuha ng user row:
            // Kung multi-dimensional array (list ng rows), kunin ang unang element gamit ang reset()
            // Kung null o empty, gagawing null
            $user = null;
            if (is_array($query_result) && !empty($query_result)) {
                // Kung associative array na mismo ang ibinalik (iisang row):
                if (isset($query_result['username'])) {
                    $user = $query_result;
                } else {
                    // Kung indexed array ng rows:
                    $user = reset($query_result);
                }
            }

            if($user && isset($user['password']) && password_verify($password, $user['password'])) {
                $this->session->set_userdata(array(
                    'logged_in' => TRUE,
                    'username'  => $user['username']
                ));
                redirect('product');
            } else {
                $data['error'] = 'Invalid username or password';
                $this->call->view('login', $data);
            }
        } else {
            $this->call->view('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}