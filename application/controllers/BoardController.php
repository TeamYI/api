<?php

class BoardController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("BoardModel");
  }

  public function index(){

    $data["list"] = $this->BuyModel->adminBuyHistory();

    $this->load->view("admin", $data);
  }

  public function noticeList(){

    $data["list"] = $this->BoardModel->noticeList();

    $this->load->view("notice", $data);
  }

  public function noticeContent($code){

    $data["list"] = $this->BoardModel->noticeContent($code);

    $this->load->view("noticeContent", $data);
  }



}

?>
