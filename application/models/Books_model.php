<?php 
    class Books_model extends CI_Model {
        
        function get_books(){
            return $this->db->query("SELECT * FROM books")->result_array();
        }



    }
?>