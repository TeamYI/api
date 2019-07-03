<?php

class BuyModel extends CI_Model{

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

    function buyHistory($user_id){
        $query = $this->db->query("select count(*) as count, c.buy_code, b.product_img, b.product_name ,c.buy_price, DATE_FORMAT(c.buy_date, '%Y-%m-%d') as date from buy as a join product as b
                                   on a.product_code = b.product_code
                                   left join buydetail as c
                                   on a.buy_code = c.buy_code
                                   where user_id = '$user_id' group by c.buy_code HAVING COUNT(count) order by buy_date desc ;   ") ;

        return $query->result_array();
    }

    function buyHistoryDetPro($buyCode){
        $query = $this->db->query("select a.product_code ,b.product_img , b.product_name, b.product_price , a.product_amount, a.product_amount*b.product_price as sum_price
                                   from buy as a join product as b
                                   on a.product_code = b.product_code
                                   where buy_code = '$buyCode'");

        return $query->result_array();
    }

    function buySuccess($user_id,$buy_code){
        $query = $this->db->query("update buydetail set success = 'O'
                                   where buy_code = '$buy_code' and user_id = '$user_id'");

        if($query){
          return true;
        }else{
          return false;
        }
    }

    function buyHistoryDetAddress($buyCode){
        $query = $this->db->query("select * from buydetail as a join area as b
                                   on a.area_code = b.area_code
                                   left join payment as c
                                   on a.payment_code = c.payment_code
                                   where buy_code = '$buyCode' ");

        return $query->row();
    }

    // admin
    function adminBuyHistory(){
        $query = $this->db->query("select count(*) as count, c.buy_code,c.user_name, c.payment_check, c.buy_price, DATE_FORMAT(c.buy_date, '%Y-%m-%d') as buy_date from buy as a join product as b
                                   on a.product_code = b.product_code
                                   left join buydetail as c
                                   on a.buy_code = c.buy_code
                                   group by c.buy_code HAVING COUNT(count) order by buy_date desc ;   ") ;

        return $query->result_array();
    }
}

?>
