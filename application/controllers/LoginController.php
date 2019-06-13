<?php

class LoginController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("UserModel");
  }

  public function index(){

    $this->load->view("login");

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
