<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {

    public function index() {

        $_lava = lava_instance();
        $_lava->call->library('session');
        $_lava->session->set_userdata('student_access', true);

        $student = [
            'name'       => 'BACAY, ROSHIEL P.',
            'course'     => 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY',
            'year'       => '3RD YEAR',
            'section'    => 'F2'
        ];

        $this->call->view('student', $student);
    }

    public function profile() {

        $student = [
            'student_id' => 'MCC2024-00101',
            'name'       => 'BACAY, ROSHIEL P.',
            'course'     => 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY',
            'year'       => '3RD YEAR',
            'section'    => 'F2',
            'email'      => 'bacay.roshelp@minsu.edu.ph',
            'contact'    => '09494272889',
            'hobby'      => 'Motorcycling'
        ];

        $this->call->view('student_profile', $student);
    }
}
?>