<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model {

    public function all() {
        $result = $this->db->table('products')->get();

        if (empty($result)) {
            return [];
        }

        // Kung numerical index 0 ang unang susi (halimbawa $result[0]), ibig sabihin listahan na ito ng multiple records
        if (isset($result[0]) && is_array($result[0])) {
            return $result;
        }

        // Kung associative array lang ang pinalabas (iisang record), i-wrap ito sa listahan
        return [$result];
    }

    public function find($id) {
        $result = $this->db->table('products')->where('id', $id)->get();
        if (empty($result)) {
            return null;
        }

        // Kung nasa loob ng indexed array [[...]], kunin ang unang item
        if (isset($result[0]) && is_array($result[0])) {
            return $result[0];
        }

        return $result;
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