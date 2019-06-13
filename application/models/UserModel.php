<?php

class UserModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function login_check($user_id,$user_pw){
      // return $this->db->get_where("user",array("user_id" => $user_id))
      // ->num_rows();
      // $sql = "SELECT * FROM user WHERE user_id = '" .$user_id. "' and user_pw = '".$user_pw."';
      $this->db->select("*")
              ->from("user")
              ->where("user_id",$user_id)
              ->where("user_pw", $user_pw);


      $query = $this->db->get();

      return $query->result();
      // return $this->db->query($sql)
      //                 ->result();

    }

}

?>
