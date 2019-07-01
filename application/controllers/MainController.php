<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("ProductModel");
  }

  public function index(){

      // echo "aasss";
      $data["list"] = $this->ProductModel->selectNewProduct();

      // echo print_r($data["list"]);
      $this->load->view("main", $data);

  }
}

?>
