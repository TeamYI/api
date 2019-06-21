<?php

class CartModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function insertCart($data){

        $this->db->insert("cart",$data);
    }

    function selectAllCart($user_id){
        $query = $this->db->query("select a.cart_code, a.product_code, a.product_amount, a.sum_price, b.product_name, b.product_price, b.product_img
                                   from cart as a join product as b
                                   on a.product_code = b.product_code
                                   where user_id='$user_id' ");
        return $query->result();
    }

    function selectCart($user_id,$code){

        $query = $this->db->query("select * from cart where user_id = '$user_id' and product_code = '$code'");

        if($query->num_rows()){
            $query = $this->db->query("select product_amount from cart where user_id = '$user_id' and product_code = '$code'");
            $row = $query->row();
            return $row->product_amount ;

        }else{
          return 0;
        }

    }

    function updateCart($user_id,$code,$amount_ck,$amount,$price){

        $sum = ($amount_ck+$amount)*$price;

        $query = $this->db->query("update cart set product_amount = '$amount_ck' + '$amount'
                                   where user_id='$user_id' and product_code='$code'");

        $query = $this->db->query("update cart set sum_price = '$sum'
                                   where user_id='$user_id' and product_code='$code'");

    }

    function deleteCart($cartCode){
        $query = $this->db->query("delete from cart where cart_code = '$cartCode'");

    }

    function deleteBuyProduct($user_id,$product_code){
        $query = $this->db->query("delete from cart where user_id = '$user_id' and product_code = '$product_code'");
    }



}

?>
