<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {

    protected $table = 'users';
    protected $primary_key = 'id';

    public function get_all_users() {
        return $this->db->table($this->table)->get_all();
    }
}
?>