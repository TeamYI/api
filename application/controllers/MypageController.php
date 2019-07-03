<?php

class MypageController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("BuyModel");
    $this->load->model("UserModel");
    $this->load->model("ReviewModel");
  }

  public function index(){

      $this->load->view("mypage");

  }

  public function buyHistory(){
      if(isset($_SESSION["user_id"])){
          $user_id = $_SESSION["user_id"];
          $data["list"] = $this->BuyModel->buyHistory($user_id);
       }
       $this->load->view("mypage",$data);
  }

  public function buyHistoryDetail($buyCode){

      $delivery_pay = 0;
      $buy_pay = 0;
      $sum_pay = 0 ;

      $data["product"] = $this->BuyModel->buyHistoryDetPro($buyCode);

      for($i=0 ; $i<count($data["product"]); $i++){
            $array = $data["product"][$i] ;
            $buy_pay +=$array["sum_price"];
      }

      if($buy_pay>2000){
        $delivery_pay = 0 ;
        $sum_pay = $buy_pay + $delivery_pay ;
      }else{
        $delivery_pay = 250;
      }

      $data["pay"]["buy_pay"] = $buy_pay ;
      $data["pay"]["delivery_pay"] = $delivery_pay ;
      $data["pay"]["sum_pay"] = $buy_pay + $delivery_pay ;

      $data["address"] = $this->BuyModel->buyHistoryDetAddress($buyCode);
      $this->load->view("mypagebuydetail",$data);
  }

  public function buySuccess(){
      $buy_code = $_POST["buy_code"];
      $user_id = $_SESSION["user_id"] ;

      $check = $this->BuyModel->buySuccess($user_id,$buy_code);

      echo $check;

  }
  public function review(){

      $product_code = $_GET["product_code"];
      $product_name = $_GET["product_name"];
      $buy_code = $_GET["buy_code"];

      $data["product_code"] = $product_code;
      $data["buy_code"] = $buy_code;
      $data["name"] = $product_name;

      $this->load->view("reviewWrite",$data);
  }

  public function reviewWrite(){

      if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
        $content = $_POST["content"];
        $product_code = $_POST["product_code"];
        $buy_code = $_POST["buy_code"];
        $star = $_POST["star"];

        $check = $this->ReviewModel->reviewWrite($user_id,$product_code,$buy_code, $content, $star);

        echo $check ;
      }

  }

  public function mypageUserCheck(){

    if(isset($_SESSION["user_id"])){
      $user_id = $_SESSION["user_id"] ;
      $user_pw = $_POST["user_pw"] ;

      $check = $this->UserModel->login_check($user_id,$user_pw);

      echo json_encode($check) ;
    }

  }

  public function userInfoChange(){

    if(isset($_SESSION["user_id"])){
      $user_id = $_SESSION["user_id"];
      $pw = $_POST["pw"] ;
      $name = $_POST["name"] ;
      $post = $_POST["post"] ;
      $area = $_POST["area"] ;
      $city = $_POST["city"] ;
      $addr1 = $_POST["addr1"] ;
      $addr2 = $_POST["addr2"] ;
      $addr3 = $_POST["addr3"] ;
      $tel = $_POST["tel"] ;
      $email = $_POST["email"] ;


      $data = array(

                  "user_pw" => $pw,
                  "postcode" => $post,
                  "area_code" => (integer)$area,
                  "city" => $city,
                  "address1" => $addr1,
                  "address2" => $addr2,
                  "address3" => $addr3,
                  "hp" => $tel,
                  "email" => $email,
                  "user_name" => $name
                );

      $this->UserModel->userInfoChange($data,$user_id);
    }
  }




}

?>
