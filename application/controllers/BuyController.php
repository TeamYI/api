<?php

class BuyController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->library("cart");
    $this->load->model("BuyDetailModel");
    $this->load->model("BuyModel");
    $this->load->model("CartModel");
    $this->load->model("UserModel");
  }

  public function index(){


  }

  public function buyPageMove(){

      $user_id = "" ;
      $cartCodeArray = array();
      $data["info"] = array();
      $data["list"] = array();

      if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
        $data["info"] = $this->UserModel->userInfo($user_id);
      }

      if(isset($_POST['cartCode'])){
        //cart行って購入
        $cartCodeArray =  $_POST['cartCode'];

        //$user_idがあった時、
        for ($i=0; $i<count($cartCodeArray); $i++)
        {
            $cartCode = $cartCodeArray[$i];
            $data["list"][$i] = $this->BuyModel->selectBuy($user_id,$cartCode);
        }

        //$user_idがない時、
        for ($i=0; $i<count($cartCodeArray); $i++)
        {

          foreach ($this->cart->contents() as $items){
              if($cartCodeArray[$i]==$items["rowid"]){
                $data["list"][$i] = (object)array(
                            "product_code" => $items["id"],
                            "product_amount" => $items["qty"],
                            "sum_price" => $items["sum_price"],
                            "product_name" => $items["name"],
                            "product_img" => $items["product_img"]
                          );
              }
            }

        }

      }else{
        //cart行かなくて購入
        $code = $_POST["product_code"] ;
        $price = $_POST["product_price"] ;
        $name = $_POST["product_name"] ;
        $img = $_POST["product_img"] ;
        $amount = $_POST["amount"] ;

        $sum = $price*$amount ;

        $data["list"][0] = (object)array(
                    "product_code" => $code,
                    "product_amount" => $amount,
                    "sum_price" => $sum,
                    "product_name" => $name,
                    "product_img" => $img
                  );
      }


      $this->load->view("buy",$data);

  }


  public function buy(){
      // echo "buy";
      $user_id = "";
      if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
      }

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


      $buy_code	= date("YmdHis");

      for($i=0; $i<count($product_code); $i++){
          $p_code = $product_code[$i] ;
          $p_amount = (integer)$product_amount[$i];

          $data = array(
                    "buy_code"=>$buy_code,
                    "product_code"=>$p_code,
                    "product_amount"=>$p_amount,
                  );
          $this->BuyModel->insertBuy($data);
          $this->CartModel->deleteBuyProduct($user_id,$p_code);

      }

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
                  "buy_code"=>$buy_code,
                  "user_name" => $name,
                  "postcode" => $post,
                  "area_code" => $area,
                  "city" => $city,
                  "address1" => $addr1,
                  "address2" => $addr2,
                  "address3" => $addr3,
                  "hp" => $tel,
                  "email" => $email,
                  "buy_price"=>$sum_price,
                  "payment_code"=>$pay,
                  "payment_check" => "X",
                  "user_id" => $user_id
                );

      $this->BuyDetailModel->insertBuyDetail($data);
      //購入したら、カート内容消す
      $this->cart->destroy();
      redirect('/buyComplete');

  }

  public function buyComplete(){
      $this->load->view("buyComplete");
  }

  public function nouserBuyhis(){
      $name = $_GET["name"] ;
      $email = $_GET["email"] ;

  
      $data["user"] = $name;
      $data["list"]= $this->BuyDetailModel->nouserBuyhis($name,$email);

      $this->load->view("nouserBuyhistory",$data);


  }

  public function nouserBuyhisCheck(){
      $name = $_POST["name"] ;
      $email = $_POST["email"] ;

      $check = $this->BuyDetailModel->nouserBuyhisCheck($name,$email);

      echo $check;
  }
}

?>
