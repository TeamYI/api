<?php

class ProductController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("ProductModel");
    $this->load->model("ReviewModel");
  }

  public function index(){

      // $data["list"] = $this->ProductModel->selectAllProduct();
      // // echo print_r($data);
      // $this->load->view("productList",$data);

  }

  public function product($code){
      // echo "code :".code ;
      // echo "product : ".$code;

      $data["list"] = $this->ProductModel->selectProduct($code);
      $data["review"] = $this->ReviewModel->reviewProduct($code);
      // echo print_r($data["list"]);
      $this->load->view("product",$data);
      // redirect(base_url("product"));

  }
  //
  // public function categoryList(){
  //     $category_code = $_POST["category_code"] ;
  //     $list = "" ;
  //     //$category_code == 0 商品一覧
  //     if($category_code == 0){
  //         $list = $this->ProductModel->selectAllProduct();
  //     }else{
  //         $list = $this->ProductModel->selectCategory($category_code);
  //     }
  //     echo json_encode($list);
  //
  // }

  public function categoryList($code){
      $category_code = $code;
      //$category_code == 0 商品一覧
      if($category_code == 0){
          $data["list"] = $this->ProductModel->selectAllProduct();
          $data["category_name"] = "商品一覧";
      }else{
          $data["list"] = $this->ProductModel->selectCategory($category_code);
          $data["category_name"] = $data["list"][0]["category_name"] ;
      }

      $this->load->view("productList",$data);

  }

  // search result
  public function productSearch(){
    $search = $_POST["search"];

    $data["list"] = $this->ProductModel->searchAllProduct($search);
    $this->load->view("searchResult",$data);
  }

}

?>
