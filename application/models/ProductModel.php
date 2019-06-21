<?php

class ProductModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function selectAllProduct(){
        $query = $this->db->query("SELECT * FROM product order by product_date desc");

        return $query->result();
    }

    function selectProduct($code){

        $query = $this->db->query("SELECT * FROM product WHERE product_code='$code'");
        return $query->row();


    }

    function selectCategory($category_code){
        $query = $this->db->query("SELECT * FROM product where category_code='$category_code' order by product_date desc");

        return $query->result_array();
    }



}

?>
