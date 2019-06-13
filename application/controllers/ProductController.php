<?php

class ProductController extends CI_Controller{

  public function index(){
      echo "mani " ;

      $this->load->view("productList");

  }

  public function product($code){
      // echo "code :".code ;
      echo "product : ".$code;

      $data["code"] = $code ;

      $this->load->view("product",$data);
      // redirect(base_url("product"));

  }


}

?>
