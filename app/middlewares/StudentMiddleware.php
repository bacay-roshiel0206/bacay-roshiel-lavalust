<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle($next)
    {
         
        $_lava = lava_instance();
        $_lava->call->library('session');

        $access = $_lava->session->userdata('student_access');

        if ($access === true) {
            return $next();
        }

        header('Location: /student');
        exit;
    }
}