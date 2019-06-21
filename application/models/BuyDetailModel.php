<?php

class BuyDetailModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function insertBuyDetail($data){

        $this->db->insert("buyDetail",$data);
    }

    // function selectLastNoUser(){
    //
    //     $query = $this->db->query("select nouser_code from nouser order by nouser_code desc limit 1");
    //     $row = $query->row();
    //     return $row->nouser_code ;
    // }

}

?>
