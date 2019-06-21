<?php

class CartController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("CartModel");
    $this->load->library("cart");
  }

  public function index(){

      $this->load->view("cart");

  }

  public function cart(){

    $data["list"] ="";


    // 전체 카트 보이기
    if(isset($_SESSION["user_id"])){
      $user_id = $_SESSION["user_id"];
      $data["list"] = $this->CartModel->selectAllCart($user_id);
    }



    $this->load->view("cart",$data);

  }

  public function cartInsert(){

    $data["list"] ="";

    // 새로 추가한 상품 카트 처리
    if(isset($_POST["product_code"]) && isset($_SESSION["user_id"])){

      $code = $_POST["product_code"] ;
      $price = $_POST["product_price"] ;
      $amount = $_POST["amount"] ;
      $user_id = $_SESSION["user_id"];

      $amount = (integer)$amount;
      $sum_price = $price*$amount ;

      $data = array(
                  "user_id" => $user_id,
                  "product_code" => $code,
                  "product_amount" => $amount,
                  "sum_price" => $sum_price

              );

      //cart에 제품이 있는지 확인
      $amount_ck = $this->CartModel->selectCart($user_id,$code);
      echo $amount_ck ;

      // 체크안에 값이 있다면, update
      // 체크안에 값이 없다면, insert
      if ($amount_ck) {
        // code...
          $this->CartModel->updateCart($user_id,$code,$amount_ck,$amount,$price);
      }else{
          $this->CartModel->insertCart($data);
      }

    }else{
      $code = $_POST["product_code"] ;
      $price = $_POST["product_price"] ;
      $img = $_POST["product_img"] ;
      $name = $_POST["product_name"] ;
      $amount = $_POST["amount"] ;
      $amount = (integer)$amount;
      $sum_price = $price*$amount ;

      $data = array(
                  'id'      => $code,
                  'qty'     => $amount,
                  'price'   => $price,
                  "sum_price" => $sum_price,
                  'name'    => $name,
                  "product_img" => $img

              );


      $this->cart->insert($data);

    //카드의 상품을 추가했을 때, 중복일 경우
    foreach ($this->cart->contents() as $items){
        if($items["id"] == $code){
          $data = array (
                    'rowid' => $items["rowid"],
                    "sum_price" => $items["qty"] * $items["price"]
          );

          $this->cart->update($data);
        }
      }


    }



    redirect('/cart');

  }

  public function cartDelete(){
    $cartCodeArray =  $_POST['cartCode'];

    if(isset($_SESSION["user_id"])){
      for ($i=0; $i<count($cartCodeArray); $i++)
      {
          $cartCode = $cartCodeArray[$i];
          $this->CartModel->deleteCart($cartCode);
      }
    }else{
      //비회원카트
      for ($i=0; $i<count($cartCodeArray); $i++)
      {
          $data = array(
                  'rowid' => $cartCodeArray[$i],
                  'qty' => 0
          );
          $this->cart->update($data);
      }
    }

    redirect('/cart');

  }

}

?>
