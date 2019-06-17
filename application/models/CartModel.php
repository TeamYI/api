<?php

class CartModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function insertCart($data){

        $this->db->insert("cart",$data);
    }

    function selectAllCart($user_id){
        $query = $this->db->query("select a.product_code, a.product_amount, a.sum_price, b.product_name, b.product_price, b.product_img
                                   from cart as a join product as b
                                   on a.product_code = b.product_code
                                   where user_id='$user_id' ");
        return $query->result();
    }



}

?>
