<?php

  $USERID = "eat595.sg" ;
  $OPENKEY = "590491e6de66d3185bbd1650685dcd839ef9ac77" ;
  $MANAGERKEY = "102cb7e32665c63206f71df9ce792ff812ab04f1" ;

  $product_code = "A-28";
  $url = "https://management.api.shopserve.jp/v2/items/_search";
  $data = array(
      "size" => 2
  );

  $data = json_encode($data); // array -> json 

  $curl = curl_init(); // RESET

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: json'));
  curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);

  $RESULT = curl_exec($curl);

  echo $RESULT;

  curl_close($curl);

  // $url = 'https://management.api.shopserve.jp/v2/items/A-28/images'; // リクエストするURLとパラメータ
  //
  // // curlの処理を始める合図
  // $curl = curl_init();
  // $key = "590491e6de66d3185bbd1650685dcd839ef9ac77" ;
  //
  // // リクエストのオプションをセットしていく
  // curl_setopt($curl, CURLOPT_URL, $url);
  // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); // メソッド指定
  // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
  // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る
  // curl_setopt($curl, CURLOPT_USERPWD, 'eat595.sg:590491e6de66d3185bbd1650685dcd839ef9ac77');
  //
  // // レスポンスを変数に入れる
  // $response = curl_exec($curl);
  //
  // // curlの処理を終了
  // curl_close($curl)

 //  $URL = "https://item.api.shopserve.jp/v2/ranking/set-by-shop";
 // $USERNAME = "eat595.sg";
 // $PASSWORD = "590491e6de66d3185bbd1650685dcd839ef9ac77";
 //
 // $ch = curl_init();
 // curl_setopt($ch, CURLOPT_URL, $URL);
 // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 // curl_setopt($ch, CURLOPT_USERPWD, $USERNAME . ":" . $PASSWORD);
 // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
 // $buf = curl_exec($ch);
 // curl_close($ch);
 // echo $buf;

?>
