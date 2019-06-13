<?php

class BuyController extends CI_Controller{

  public function index(){
      echo "buy " ;

  }

  public function buy(){
      $code = $_POST["product_code"] ;
      $price = $_POST["product_price"] ;
      $amount = $_POST["amount"] ;

      $data = array(
                  "code" => $code,
                  "price" => $price,
                  "amount" => $amount,
                );

      $this->load->view("buy",$data);

  }
}

?>
