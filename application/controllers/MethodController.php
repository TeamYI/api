<?php

class MethodController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->USERID = "eat595.sg" ;
    $this->OPENKEY = "590491e6de66d3185bbd1650685dcd839ef9ac77" ;
    $this->MANAGERKEY = "102cb7e32665c63206f71df9ce792ff812ab04f1" ;

  }

  public function POST($url,$data){

    $data = json_encode($data); // array -> json

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $category = json_decode(curl_exec($curl));
    $category = $category->child_categories;
    echo print_r($category);

    return $category;
    curl_close($curl);


  }


  public function PUT(){


    $data = json_encode($data,JSON_UNESCAPED_UNICODE); // array -> json
    echo $data ;

    $curl = curl_init(); // RESET

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    // curl_setopt($curl, CURLOPT_PUT ,  TRUE ); //パラメータが渡らない
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);     // 원격서버의 인증서가 유효한지 검사 안함
    curl_setopt($curl, CURLOPT_USERPWD, $this->USERID.":".$this->MANAGERKEY);

    curl_exec($curl);

    curl_close($curl);


  }




}

?>
