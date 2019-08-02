<?php

class ProductRegisterController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->USERID = "eat595.sg" ;
    $this->OPENKEY = "590491e6de66d3185bbd1650685dcd839ef9ac77" ;
    $this->MANAGERKEY = "102cb7e32665c63206f71df9ce792ff812ab04f1" ;

  }

  public function index(){

    $this->load->view("productRegister");
  }

  public function productCodeCheck(){
    $url = "https://management.api.shopserve.jp/v2/items/_search";
    $product_code = $_POST["product_code"];
    $filter["item_code"] = $product_code;
    $data = array(
        "filters" => [$filter]
    );

    $result = $this->POST($url,$data);

    $result = $result->total_count ;

    echo $result;
  }

  public function productRegisterSuccess($product_code){
    $data["product_code"] = $product_code;
    $result = $this->productStockGET($product_code);
    $data["stock"]  = $result->stock ;

    $this->load->view("productRegisterSuccess",$data);
  }

  public function productStockPage(){
    $product_code = $_GET["product_code"];
    $data["product_code"] = $product_code;
    $result = $this->productStockGET($product_code);
    $data["stock"]  = $result->stock ;


    $this->load->view("ProductStock",$data);
  }

  public function productVariationPage(){
    $product_code = $_GET["product_code"];
    $data["product_code"] = $product_code;
    $data["variation"] = $this->productVariationGet($product_code);

    $this->load->view("ProductVariation",$data);
  }
  public function productRegister(){

    $data["product_code"] = $_POST["product_code"];
    $data["product_name"] = $_POST["product_name"];

    $product_code = $_POST["product_code"];
    $array["product_code"] = $product_code;
    $array["product_name"] = $_POST["product_name"];
    $array["NonTaxFlag"] = $_POST["NonTaxFlag"];
    $array["product_price"] = $_POST["product_price"];
    if($_POST["product_unit"] == ""){
      $array["product_unit"] = "個";
    }else{
      $array["product_unit"] = $_POST["product_unit"];
    }


    //category 情報
    $multiCategory = $_POST["multiCategory"];


    //1.product code add
    $this->productAdd($array);
    //2.product basic info
    $this->productBasicInfo($array);
    //3.category 保存
    $this->productCategoryUpdate($product_code,$multiCategory);


    //delivery 情報
    $array = array();
    $delivery_type = $_POST["delivery_type"];

    $array["delivery_type"] = $delivery_type;
    if($delivery_type == "Standard"){
      $array["shipping_preparation_period"] = $_POST["deliveryPreparation"];
      if(isset($_POST["temperature_controlled"])){
        $array["temperature_controlled"] = $_POST["temperature_controlled"];
      }else{
        $array["temperature_controlled"] = "NoControl";
      }

      $enable_specific_delivery = $_POST["enable_specific_delivery"];
      $array["enable_specific_shipping_charge"] = $enable_specific_delivery;

      if($enable_specific_delivery == "Yes"){
        $array["specific_shipping_charge"] = $_POST["specific_delivery_charge"];
        $array["display_type"] = $_POST["display_type"];
        $array["prior"] = $_POST["prior"];
      }
    }

    //4.shipping
    $this->productShippingSet($array,$product_code);

    //5. main image set


    //sub image がある場合
    if(isset($_POST["image_name"])){
      $image_name = $_POST["image_name"];
      $main_image = $_POST["main_image"];
      $this->productMainImageSet($product_code, $image_name, $main_image);
    }
    // echo print_r($image_name);




    //6. product discription set
    $array = array();
    $array["main_description"] = $_POST["description"];
    $array["sub_description1"] = $_POST["description1"];
    $array["sub_description2"] = $_POST["description2"];
    $array["sales_copy"] = $_POST["innerCatchCopy"] ;

    $this->ProductDescriptionSet($product_code, $array);

    //7. product best new display set
    $array = array();
    $array["new_arrival"] = $_POST["new_arrival"];
    $array["recommended"] = $_POST["recommended"];
    $this->ProductApilSet($product_code,$array);

    //8. product page display set
    $array = array();
    $array["display"] = $_POST["pageDisplay"];
    $array["show_cart_area"] = $_POST["showCart"];
    if( $array["show_cart_area"] == "Yes"){
      $array["show_stock_viewer"] = $_POST["showStock"];
    }
    $array["show_customer_review"] = $_POST["showCustomer"];
    $array["show_inquire_form"] = $_POST["showInquire"];
    $array["show_share_form"] = $_POST["showShare"];
    $array["show_qr_code"] = $_POST["showQR"];

    $this->ProductPageDisplaySet($product_code,$array);

    //9. product SEO set
    $array = array();
    $array["item_page_title"] = $_POST["SEOTitle"] ;
    if( ($_POST["SEOKeyword"]) == "" ){
      $array["item_page_keywords"] = [];
    }else{
      $array["item_page_keywords"] = explode(',',$_POST["SEOKeyword"]);
    }
    $array["sales_copy"] = $_POST["SEOCatchCopy"] ;
    $this->ProductSEOSet($product_code,$array);


    redirect("/productRegisterSuccess/$product_code");
  }

  public function productAdd($array){

    $url = "https://management.api.shopserve.jp/v2/items";
    $data = array(
       "item_code" => $array["product_code"],
       "item_name" => $array["product_name"]
    );
    $this->PUT($url, $data);
  }
  public function productBasicInfo($array){
    $product_code = $array["product_code"];
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/basic";
    $data = array(
       "item_name" => $array["product_name"],
       "consumption_tax_setting" => $array["NonTaxFlag"],
       "item_price" => $array["product_price"],
       "regular_price_type"  => "None",
       "item_unit" =>  $array["product_unit"],
       "memo" => ""
    );



    $this->PUT($url, $data);

  }
  public function productCategoryUpdate($product_code,$multiCategory){

    $url = "https://management.api.shopserve.jp/v2/items/$product_code/categories";
    $array = array();
    for($i=0; $i<count($multiCategory); $i++){
      $categoryArray["category"]= explode( '>', $multiCategory[$i]);
      array_push($array,$categoryArray);
    }
    $data = array(
       "categories" => $array
    );

    $this->PUT($url, $data);
  }
  public function productShippingSet($array,$product_code){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/shipping";
    $data = $array;
    $this->PUT($url, $data);
  }
  public function productMainImageSet($product_code, $image_name, $main_image){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/images";

    $array = array();

    for($i=0; $i<count($image_name); $i++){
      $array[$i]["image_name"] = $image_name[$i];
      $array[$i]["is_main"] = $main_image[$i];
    }

    $data = array(
      "images" => $array
    );
    $this->PUT($url,$data);
  }
  public function ProductDescriptionSet($product_code, $array){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/description/pc" ;
    $data = $array;

    $this->PUT($url, $data);

  }
  public function ProductApilSet($product_code,$array){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/presentation/appeal";
    $data = $array ;

    $this->PUT($url,$data);
  }
  public function ProductPageDisplaySet($product_code,$array){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/control";
    $data = $array ;

    $this->PUT($url,$data);
  }
  public function ProductSEOSet($product_code,$array){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/seo-tdk";
    $data = $array;

    $this->PUT($url,$data);
  }
  //すべてのcategory出力
  public function productCategoryAdd(){

    $url = "https://management.api.shopserve.jp/v2/service-setup/item-categories/_get";

    // category 第一階層が取得
    $data = array("top_category_path" => []);
    $category = $this->POST($url,$data);
    $category = $category->child_categories;

    $result = array();

    // すべての直下の階層のカテゴリ取得をため、for文
    for($z=0 ; $z <count($category) ; $z++){

      // 直下の階層のカテゴリがないと、配列に保存
      if(($category[$z]->has_child_categories) == "No" ){
          array_push($result, $category[$z]->full_path );
      }else{
        // 第一階層を保存
        array_push($result, $category[$z]->full_path );

        $child = $category[$z] ;

          // 変数 reset
          // $array : post方式で送る変数保存配列
          // $arrayChild : 直下の階層のカテゴリを集める配列
          // $j : $arrayChild配列を使った時、使う
          $array = array();
          $arrayChild = array();
          $j=0;

          // 直下の階層のカテゴリがない時まで回る
          while(1){
              // while文を最初に回る時使う
              $count = count($arrayChild) ;

              if($count == 0){
                for($i=0; $i<count($child->full_path); $i++){
                  array_push($array,$child->full_path[$i]);
                }
              }else{
                // 最初以外に回る時
                $array = $child[$j];
                $j++;
              }
              // 配列形式で作る
              // 	{
              //     "top_category_path": ["農産物・食品", "柑橘類"]
              // }
              $data = array(
                  "top_category_path" => $array
              );

              $child = $this->POST($url,$data);
              $child = $child->child_categories;
              $count = count($child);

              // 得る直下の階層のカテゴリほどfor文回る
              for($i=0; $i < $count; $i++){

                // 直下の階層のカテゴリが残った時、実行
                if(($child[$i]->has_child_categories) == "Yes" ){
                  // カテゴリ整列をために
                  if($j>0){
                    // Chaildがあった時、今の$arrayChild【＄ｊ】の真後ろに値追加
                    $arr_front = array_slice($arrayChild, 0, $j); //처음부터 해당 인덱스까지 자름
                    $arr_end = array_slice($arrayChild, $j); //해당인덱스 부터 마지막까지 자름
                    $arr_front[] = $child[$i]->full_path;//새 값 추가
                    $arrayChild = array_merge($arr_front, $arr_end);

                  }else{
                    array_push($arrayChild, $child[$i]->full_path);
                  }

                }else{
                  if($j>0){ //childがない時、今の$arrayChild【＄ｊ】の真後ろに値追加
                    $arr_front = array_slice($arrayChild, 0, $j); //처음부터 해당 인덱스까지 자름
                    $arr_end = array_slice($arrayChild, $j); //해당인덱스 부터 마지막까지 자름
                    $arr_front[] = $child[$i]->full_path;//새 값 추가
                    $arrayChild = array_merge($arr_front, $arr_end);
                    $j++;

                  }else{
                    array_push($result, $child[$i]->full_path );
                  }
                }
              }
              $child = $arrayChild;
              if(count($arrayChild) == $j){
                break ;
              }
          }
          //$result , $arrayChild マージする
          $result = array_merge($result, $arrayChild);
      }
    }

    $data["result"] = $result;
    $this->load->view("productCategoryAdd",$data);
  }
  //すべてのイメージ出力
  public function productImageSelect(){
    $url = "https://management.api.shopserve.jp/v2/images";
    $data["images"] = $this->GET($url);
    $data["role"] = $_GET["role"];

    $this->load->view("imageSelect", $data);
  }


  public function productStockGET($product_code){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/stock";
    $result = $this->GET($url);


    return $result;

  }
  public function productStockSet(){
    $product_code = $_POST["product_code"];
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/stock";

    $type = $_POST["type"];

    if($type == "Item"){
      if($_POST["quantity"] == "z" || $_POST["quantity"] == "Z"){
        $data["unlimited"] = "Yes" ;
      }else{
        $data["unlimited"] = "No" ;
        $data["quantity"] = $_POST["quantity"];
        $data["alert_threshold"] = $_POST["alert_threshold"];
      }
      $this->PUT($url,$data);
    }else{
      $variation1 = $_POST["variation1"];
      $variation2 = "";
      $variation3 = "";
      $quantity = $_POST["quantity"];
      $alert_threshold= $_POST["alert_threshold"];

      if(isset($_POST["variation2"])){
        $variation2 = $_POST["variation2"];
      }
      if(isset($_POST["variation3"])){
        $variation3 = $_POST["variation3"];
      }

      for($i=0 ; $i<count($variation1); $i++){
        $data = array();
        $data["variation_name1"] = $variation1[$i];
        if($variation2 != ""){
          $data["variation_name2"] = $variation2[$i];
        }
        if($variation3 != ""){
          $data["variation_name3"] = $variation3[$i];
        }

        if($quantity[$i] == "z" || $quantity[$i] == "Z"){
          $data["unlimited"] = "Yes" ;
        }else{
          $data["unlimited"] = "No" ;
          $data["quantity"] = $quantity[$i];
          $data["alert_threshold"] =$alert_threshold[$i];
        }
        $this->PUT($url,$data);
      }

    }




  }
  public function productVariationGet($product_code){

    $url = "https://management.api.shopserve.jp/v2/items/$product_code/variation";

    // $type = $type->stock ;

    $type = $this->productStockGET($product_code);

    $type = $type->stock;
    if($type->management_type == "Item"){
      $result = "";
    }else{

      $result = $this->GET($url);
      $result = $result->variation ;
    }

    return $result;
  }
  public function productVariationSet(){
    $product_code = $_POST["product_code"];
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/variation";


    if(isset($_POST["title1"])){
      $data["title1"] = $_POST["title1"] ;
      $data["choices1"] = $_POST["one"];
    }

    if($_POST["title2"] != ""){
      $data["title2"] = $_POST["title2"] ;
      $data["choices2"] = $_POST["two"];
    }


    if($_POST["title3"] != ""){
      $data["title3"] = $_POST["title3"] ;
      $data["choices3"] = $_POST["three"];
    }

    $this->PUT($url,$data);
    $this->productVariationType($product_code);

  }


  public function productVariationType($product_code){
    $url = "https://management.api.shopserve.jp/v2/items/$product_code/variation/stock-management";
    $data = array(
      "type" => "Variation"
    );
    $this->PUT($url,$data);
  }

  public function GET($url){

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 0 => ラウザにすぐに見える, 1=>変数に保存できる
    $result = json_decode(curl_exec($curl));

    curl_close($curl);

    return $result;

  }
  public function POST($url,$data){

    $data = json_encode($data,JSON_UNESCAPED_UNICODE); // array -> json

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = json_decode(curl_exec($curl));

    curl_close($curl);

    return $result;

  }
  public function PUT($url, $data){
    $data = json_encode($data,JSON_UNESCAPED_UNICODE); // array -> json
    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    // curl_setopt($curl, CURLOPT_PUT ,  TRUE ); //パラメータが渡らない
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);     // 원격서버의 인증서가 유효한지 검사 안함
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);

    curl_exec($curl);

    curl_close($curl);


  }




}

?>

