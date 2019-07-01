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

}

?>
