<?php


class ProductController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->USERID = "eat595.sg" ;
    $this->OPENKEY = "590491e6de66d3185bbd1650685dcd839ef9ac77" ;
    $this->MANAGERKEY = "102cb7e32665c63206f71df9ce792ff812ab04f1" ;


  }

  public function index(){
    $this->load->view("productList");
  }

  public function ProductSearchResult(){

    $item_name = $_POST["item_name"];

    $url = "https://management.api.shopserve.jp/v2/items/_search";

    $filter = (object) array(
      "item_name" => $item_name
    );

    $data = array(
      "filters" => [$filter]
    );

    $data = json_encode($data); // array -> json

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);

    $RESULT = curl_exec($curl);

    curl_close($curl);

  }

  public function Product($product_code){

    $data["standard"] = $this->SelectStandardProductInfo($product_code);
    $data["category"] = $this->SelectProductCategory($product_code);
    $data["discription"] = $this->SelectProductDescription($product_code);
    $data["SEO"] = $this->SelectProductSEO($product_code);
    $data["shopserveAD"] = $this->SelectProductShopserveAD($product_code);


    // echo print_r($data["standard"]);
    // echo print_r($data["category"]);


    $this->load->view("product", $data);
  }

  public function SelectStandardProductInfo($product_code){
    $url = "https://management.api.shopserve.jp/v2/items/".$product_code."/basic";

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 0 => ラウザにすぐに見える, 1=>変数に保存できる
    $standard = json_decode(curl_exec($curl));

    curl_close($curl);

    return $standard ;

  }

  public function SelectProductCategory($product_code){


    $url = "https://management.api.shopserve.jp/v2/items/".$product_code."/categories";

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 0 => ラウザにすぐに見える, 1=>変数に保存できる
    $category = json_decode(curl_exec($curl));

    $category = $category->categories ;



    curl_close($curl);

    return $category;

  }

  public function SelectProductDescription($product_code){
    $url = "https://management.api.shopserve.jp/v2/items/".$product_code."/description/pc";

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 0 => ラウザにすぐに見える, 1=>変数に保存できる
    $description = json_decode(curl_exec($curl));
    $description = $description->description->pc ;

    curl_close($curl);

    return $description;
  }

  public function SelectProductSEO($product_code){
    $url = "https://management.api.shopserve.jp/v2/items/".$product_code."/seo-tdk";

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 0 => ラウザにすぐに見える, 1=>変数に保存できる
    $SEO = json_decode(curl_exec($curl));
    $SEO = $SEO->seo_tdk ;
    // echo print_r($SEO);
    // $description = $description->description->pc ;

    curl_close($curl);

    return $SEO;
  }

  public function SelectProductShopserveAD($product_code){
    $url = "https://management.api.shopserve.jp/v2/items/".$product_code."/advertisement/shopserve";

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 0 => ラウザにすぐに見える, 1=>変数に保存できる
    $shopserveAD = json_decode(curl_exec($curl));
    $shopserveAD = $shopserveAD->advertisement->shopserve->category ;

    // $description = $description->description->pc ;

    curl_close($curl);

    return $shopserveAD;
  }



}

?>
