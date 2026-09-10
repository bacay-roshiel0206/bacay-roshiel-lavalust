<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends ORM {
    public $table = 'products';

    public function __construct() {
        parent::__construct();
    }
}
?>