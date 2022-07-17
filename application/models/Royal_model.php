<?php
class Royal_model extends CI_Model
{
    public $table = 'royal';
    public $id = 'royal.id';
    public function get($id = null)
    {
        if ($id == null){
            return $this->db->get($this->table)->result_array();
        }else{
            return $this->db->get_where($this->table, ['id' =>$id])->result_array();
        }
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update($this->table, $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}