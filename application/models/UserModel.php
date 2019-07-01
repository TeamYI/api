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

    function userCheck($user_id){
        $query = $this->db->query("select * from user where user_id = '$user_id' ");

        return $query->num_rows();

    }

    function userJoin($data){
        $this->db->insert("user",$data);
    }

    function userInfo($user_id){
        $query = $this->db->query("select * from user where user_id = '$user_id' ");

        return $query->result();
    }

    function userInfoChange($data,$user_id){
        $query = $this->db->update('user', $data, "user_id = '$user_id'");

        if($query){
          return true;
        }else{
          return false;
        }
    }

}

?>
