<?php

class LoginController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("UserModel");
  }

  public function aa(){

    $this->load->view("aa");

  }

  public function bb(){

      $b = 0 ;
      $A = $_POST["check"];

      for($i=0; $i<count($A); $i++){
          $b += 1 ;
      }

      echo $b;

  }

  public function index(){

    $this->load->view("login");

  }

  public function join(){

    $this->load->view("join");

  }

  public function userJoin(){
    $id = $_POST["id"] ;
    $pw = $_POST["pw"] ;
    $name = $_POST["name"] ;
    $post = $_POST["post"] ;
    $area = $_POST["area"] ;
    $city = $_POST["city"] ;
    $addr1 = $_POST["addr1"] ;
    $addr2 = $_POST["addr2"] ;
    $addr3 = $_POST["addr3"] ;
    $tel = $_POST["tel"] ;
    $email = $_POST["email"] ;


    $data = array(
                "user_id"=>$id,
                "user_pw" => $pw,
                "postcode" => $post,
                "area_code" => (integer)$area,
                "city" => $city,
                "address1" => $addr1,
                "address2" => $addr2,
                "address3" => $addr3,
                "hp" => $tel,
                "email" => $email,
                "user_name" => $name
              );

    $this->UserModel->userJoin($data);

    redirect('./login');

  }

  public function userCheck(){
    $user_id = $_POST["user_id"] ;

    $check = $this->UserModel->userCheck($user_id);
    echo $check ;
  }

  public function userLogin(){
    $user_id = $_POST["user_id"] ;
    $user_pw = $_POST["user_pw"] ;

    //login check
    $check = $this->UserModel->login_check($user_id,$user_pw);

    //userがいったら、session　userのIDを保存
    if($check){
      $_SESSION["user_id"] = $user_id ;
    }
    echo json_encode($check); ;

  }

  public function logout(){
      unset($_SESSION["user_id"]) ;
      $this->load->view("main");
  }

}

?>
