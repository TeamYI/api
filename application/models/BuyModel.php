<?php

class BuyModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function insertNoUserBuy($data){

        $this->db->insert("buy",$data);
    }



}

?>
