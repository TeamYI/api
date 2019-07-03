<?php

class ReviewModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function insertBuy($data){

        $this->db->insert("buy",$data);
    }

    function selectBuy($user_id,$cartCode){
        $query = $this->db->query("select a.cart_code, a.product_code, a.product_amount, a.sum_price, b.product_name, b.product_price, b.product_img
                                   from cart as a join product as b
                                   on a.product_code = b.product_code
                                   where user_id='$user_id' and cart_code = '$cartCode'");
        return $query->row();
    }

    function reviewWrite($user_id,$product_code,$buy_code, $content, $star){



      $query = $this->db->query("INSERT INTO review (product_code, grade, user_id, buy_code)
                                VALUE('$product_code', '$grade', '$user_id', '$buy_code')");

                                
      if($query){
        return true;
      }else{
        return false;
      }

    }
}

?>
