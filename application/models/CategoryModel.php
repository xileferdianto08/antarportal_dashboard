<?php
defined('BASEPATH') or exit('No direct script access allowed');

class categoryModel extends CI_Model
{
    //Show all category
    public function getAllCategory()
    {
        $query = $this->db->get('category');
        return $query->result_array();
    }

    
    public function categoryPerId($id)
    {
        $query = $this->db->get('category')->where("categoryId = $id");
        return $query->result_array();
    }

    public function getCatName($id)
    {
        $this->db->select('categoryName');
        $this->db->where('categoryId', $id);
        $query = $this->db->get('category');

        if($query->num_rows() != 1){
            return false;
        }
        return $query->row()->categoryName;
    }

    public function detail($id)
    {
        $this->db->trans_begin();
        $query = $this->db->select('*')->from('category')->where('categoryId', $id)->get();
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }else
        {
            return $query->result_array();
        }
    }

    public function checkCatIsExist($name)
    {
        return $this->db->get_where('category', ['categoryName' => $name]);
    }

    public function addCategory($name)
    {
        $data = array(
            'categoryId' => NULL,
            'categoryName' => str_replace(array("\r","\n",'\r','\n', "'"), "", $name)
        );

        $this->db->insert('category', $data);
    }

    public function editCategory($id, $name)
    {
        $this->db->set('categoryName', str_replace(array("\r","\n",'\r','\n', "'"), "", $name));

        $this->db->where('categoryId', $id);
        $this->db->update('category');
    }
    
    public function deleteCategory($id)
    {
        $this->db->where('categoryId', $id);
        $this->db->delete('category');
    }
}