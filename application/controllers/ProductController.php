<?php

class ProductController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("ProductModel");
  }

  public function index(){

      $data["list"] = $this->ProductModel->selectAllProduct();
      // echo print_r($data);
      $this->load->view("productList",$data);

  }

  public function product($code){
      // echo "code :".code ;
      // echo "product : ".$code;

      $data["list"] = $this->ProductModel->selectProduct($code);

      // echo print_r($data["list"]);
      $this->load->view("product",$data);
      // redirect(base_url("product"));

  }

  public function categoryList(){
      $category_code = $_POST["category_code"] ;
      $list = "" ;
      //$category_code == 0 商品一覧
      if($category_code == 0){
          $list = $this->ProductModel->selectAllProduct();
      }else{
          $list = $this->ProductModel->selectCategory($category_code);
      }
      echo json_encode($list);

  }


}

?>
