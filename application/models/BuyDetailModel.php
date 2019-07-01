<?php

class BuyDetailModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function insertBuyDetail($data){

        $this->db->insert("buydetail",$data);
    }

    function nouserBuyhisCheck($name,$email){

      $query = $this->db->query("select * from buydetail where user_name='$name' and email='$email' and user_id='' ");

      return $query->num_rows();
    }

    function nouserBuyhis($name,$email){

      $query = $this->db->query("select count(*) as count, c.buy_code, b.product_img, b.product_name ,c.buy_price, DATE_FORMAT(c.buy_date, '%Y-%m-%d') as buy_date from buy as a join product as b
                                 on a.product_code = b.product_code
                                 left join buydetail as c
                                 on a.buy_code = c.buy_code
                                 where user_name='$name' and  email = '$email' and user_id = '' group by c.buy_code HAVING COUNT(count) order by buy_date desc ;  ");

      return $query->result_array();
    }

}

?>
