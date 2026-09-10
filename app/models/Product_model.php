<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model {

    public function all() {
        $result = $this->db->table('products')->get();
        
        if (empty($result)) {
            return [];
        }

        // Kung single row array ang ibinalik (may 'id' key na agad sa top-level array),
        // i-wrap ito sa loob ng panibagong array para maging list of rows [[...]]
        if (isset($result['id'])) {
            return [$result];
        }

        return $result;
    }

    public function find($id) {
        $result = $this->db->table('products')->where('id', $id)->get();
        if (is_array($result) && !empty($result)) {
            return isset($result['id']) ? $result : reset($result);
        }
        return null;
    }

    public function insert($data) {
        return $this->db->table('products')->insert($data);
    }

    public function update($id, $data) {
        return $this->db->table('products')->where('id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table('products')->where('id', $id)->delete();
    }
}