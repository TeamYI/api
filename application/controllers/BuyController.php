<?php

class BuyController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("NoUserModel");
    $this->load->model("BuyModel");
  }

  public function index(){
      echo "a" ;

  }

  public function buyPageMove(){
      $code = $_POST["product_code"] ;
      $price = $_POST["product_price"] ;
      $name = $_POST["product_name"] ;
      $img = $_POST["product_img"] ;
      $amount = $_POST["amount"] ;

      $price = $price*$amount ;
      $sum = $price*$amount ;
      $delivery = 0 ;

      if($sum < 2000){
        $delivery = 250;
        $sum = $delivery+$sum ;
      }

      $data = array(
                  "code" => $code,
                  "price" => $price,
                  "amount" => $amount,
                  "sum" => $sum,
                  "delivery" => $delivery,
                  "name" => $name,
                  "img" => $img
                );

      $this->load->view("buy",$data);

  }

  public function buy(){
      // echo "buy";
      $product_code = $_POST["product_code"] ;
      $sum_price = $_POST["sum_price"] ;
      $product_amount = $_POST["product_amount"] ;
      $name = $_POST["name"] ;
      $post = $_POST["post"] ;
      $area = $_POST["area"] ;
      $city = $_POST["city"] ;
      $addr1 = $_POST["addr1"] ;
      $addr2 = $_POST["addr2"] ;
      $addr3 = $_POST["addr3"] ;
      $tel = $_POST["tel"] ;
      $email = $_POST["email"] ;
      $pay = $_POST["pay"] ;

      // echo "name : ".$name;
      // echo "post : ".$post;
      // echo "area : ".$area;
      // echo "city : ".$city;
      // echo "addr1 : ".$addr1;
      // echo "addr2 : ".$addr2;
      // echo "addr3 : ".$addr3;
      // echo "tel : ".$tel;
      // echo "email : ".$email;
      // echo "pay : ".$pay;
      //
      $data = array(
                  "nouser_name" => $name,
                  "postcode" => $post,
                  "area_code" => $area,
                  "city" => $city,
                  "address1" => $addr1,
                  "address2" => $addr2,
                  "address3" => $addr3,
                  "hp" => $tel,
                  "email" => $email
                );

      $this->NoUserModel->insertNoUser($data);
      $nouser_code = $this->NoUserModel->selectLastNoUser();

      $data = array(
                "product_code"=>$product_code,
                "product_amount"=>$product_amount,
                "sum_price"=>$sum_price,
                "payment_code"=>$pay,
                "pay_confirm" => "X",
                "nouser_code" => $nouser_code
              );

      // echo "nouser_code".$nouser_code;

      $this->BuyModel->insertNoUserBuy($data);

      $this->load->view("buyComplete");

  }
}

?>
