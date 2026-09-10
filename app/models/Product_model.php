<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model {

    public function all() {
        // Direktang kinukuha ang lahat ng rows mula sa products table
        $query = $this->db->raw("SELECT * FROM products ORDER BY id DESC");
        
        if (is_object($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return is_array($query) ? $query : [];
    }

    public function find($id) {
        $query = $this->db->raw("SELECT * FROM products WHERE id = ?", array($id));
        if (is_object($query)) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;
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