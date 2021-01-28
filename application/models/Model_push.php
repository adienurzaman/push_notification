<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_push extends CI_Model
{

    public function get_data(string $table = null, array $where = [])
    {
        if (empty($where)) {
            return $this->db->get($table);
        } else {
            return $this->db->get_where($table, $where);
        }
    }

    public function save(string $table = null, array $data = [], array $where = [])
    {
        if (empty($where)) {
            return $this->db->insert($table, $data);
        } else {
            return $this->db->update($table, $data, $where);
        }
    }
}

/* End of file Model_push.php */
