<?php

class AdminController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("BuyDetailModel");
    $this->load->model("BuyModel");
    $this->load->model("CartModel");
    $this->load->model("UserModel");
  }

  public function index(){

    $data["list"] = $this->BuyModel->adminBuyHistory();

    $this->load->view("admin", $data);
  }



}

?>
