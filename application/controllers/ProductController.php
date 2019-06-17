<?php

class ProductController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("ProductModel");
  }

  public function index(){
      echo "mani " ;
      $data["list"] = $this->ProductModel->selectAllProduct();
      $this->load->view("productList",$data);

  }

  public function product($code){
      // echo "code :".code ;
      echo "product : ".$code;

      $data["list"] = $this->ProductModel->selectProduct($code);

      $this->load->view("product",$data);
      // redirect(base_url("product"));

  }


}

?>
