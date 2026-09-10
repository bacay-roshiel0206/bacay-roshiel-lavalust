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

            // Ginamit ang get_one() sa halip na get()->row()
            $user = $this->db->table('auth')->where('username', $username)->get_one();

            if($user && password_verify($password, $user['password'])) {
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