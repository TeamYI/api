<?php

class CartController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("CartModel");
  }

  public function index(){

      $this->load->view("cart");

  }

  public function cart(){

    $data["list"] ="";

    if(isset($_SESSION["user_id"])){
      $user_id = $_SESSION["user_id"];
    }

    if(isset($_POST["product_code"]) && isset($_SESSION["user_id"])){

      $code = $_POST["product_code"] ;
      $price = $_POST["product_price"] ;
      $amount = $_POST["amount"] ;


      $sum_price = $price*$amount ;

      $data = array(
                  "user_id" => $user_id,
                  "product_code" => $code,
                  "product_amount" => $amount,
                  "sum_price" => $sum_price

              );

      $this->CartModel->insertCart($data);


    }
    if(isset($_SESSION["user_id"])){
      $user_id = $_SESSION["user_id"];
      $data["list"] = $this->CartModel->selectAllCart($user_id);
    }



    $this->load->view("cart",$data);






    // $code = $_POST["product_code"] ;
    // $price = $_POST["product_price"] ;
    // $name = $_POST["product_name"] ;
    // $img = $_POST["product_img"] ;
    // $amount = $_POST["amount"] ;

    // $price = $price*$amount ;
    // $sum = $price*$amount ;
    // $delivery = 0 ;
    //
    // if($sum < 2000){
    //   $delivery = 250;
    //   $sum = $delivery+$sum ;
    // }


    // $data = array(
    //             "code" => $code,
    //             "price" => $price,
    //             "amount" => $amount,
    //             "sum" => $sum,
    //             "delivery" => $delivery,
    //             "name" => $name,
    //             "img" => $img
    //           );



  }

}

?>
