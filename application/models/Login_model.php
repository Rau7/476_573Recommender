<?php 
    class Login_model extends CI_Model {
        
        function getAdmin($data){

            return $this->db->query("SELECT * FROM admin WHERE admin_name=".$this->db->escape($data['user'])." AND admin_password='".md5($data['password'])."' AND admin_status='1'  LIMIT 1")->row_array(0,"array");
        }

    }
?>