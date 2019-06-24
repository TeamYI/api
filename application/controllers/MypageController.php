<?php

class MypageController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("BuyModel");
  }

  public function index(){

      $this->load->view("mypage");

  }

  public function buyHistory(){
      if(isset($_SESSION["user_id"])){
          $user_id = $_SESSION["user_id"];
          $data["list"] = $this->BuyModel->buyHistory($user_id);
       }
       $this->load->view("mypage",$data);
  }

  public function buyHistoryDetail($buyCode){
      echo "history : ".$buyCode ;
      $data["product"] = $this->BuyModel->buyHistoryDetPro($buyCode);
      $data["address"] = $this->BuyModel->buyHistoryDetAddress($buyCode);
      $this->load->view("mypagebuydetail",$data);
  }




}

?>
