<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->model('Product_model');
        $this->call->database('main');

        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['products'] = $this->Product_model->all();
        $this->call->view('product_list', $data);
    }

    public function view($id) {
        $data['product'] = $this->Product_model->find($id);
        $this->call->view('product_detail', $data);
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'product_name' => $this->io->post('product_name') ?? '',
                'description'  => $this->io->post('description') ?? '',
                'price'        => $this->io->post('price') ?? 0,
                'quantity'     => $this->io->post('quantity') ?? 0
            );
            $this->Product_model->insert($data);
            redirect('product');
        }

        $data['product'] = array('id' => '', 'product_name' => '', 'description' => '', 'price' => '', 'quantity' => '');
        $this->call->view('product_form', $data);
    }

    public function edit($id) {
        $data['product'] = $this->Product_model->find($id);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $update_data = array(
                'product_name' => $this->io->post('product_name') ?? '',
                'description'  => $this->io->post('description') ?? '',
                'price'        => $this->io->post('price') ?? 0,
                'quantity'     => $this->io->post('quantity') ?? 0
            );
            $this->Product_model->update($id, $update_data);
            redirect('product/view/' . $id);
        }

        $this->call->view('product_form', $data);
    }

    public function delete($id) {
        $this->Product_model->delete($id);
        redirect('product');
    }
}