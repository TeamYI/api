<?php

class ReviewModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function reviewWrite($user_id,$product_code,$buy_code, $content, $star){



        $query = $this->db->query("INSERT INTO review (product_code, grade, user_id, buy_code,review_content)
                                  VALUE('$product_code', '$star', '$user_id', '$buy_code','$content')");


        if($query){
          return true;
        }else{
          return false;
        }

    }

    function reviewCheck($buyCode){
        $query = $this->db->query("select a.product_code,a.buy_code from review as a  join buy as b on a.buy_code = b.buy_code where a.buy_code = '$buyCode'and a.product_code=b.product_code group by a.product_code order by product_code ;");

        return $query->result_array();
    }

    function reviewProduct($product_code){
        // $query =

        $query = $this->db->query("select c.product_code, b.user_name,c.grade ,c.review_content, DATE_FORMAT(c.review_date, '%Y-%m-%d') as date
                                   from buy as a join buydetail as b
                                   on a.buy_code = b.buy_code
                                   left join review as c
                                   on a.buy_code = c.buy_code
                                   where c.product_code ='$product_code' group by c.review_date order by c.review_date desc;");
        return $query->result_array();
    }
}

?>
