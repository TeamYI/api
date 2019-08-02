

// 文字byte数チェック
function CharByteCheck(position){
  var text = position.value ;
  var next = position.nextElementSibling ;
  next = next.childNodes.item(1) ;

  charNum = next.childNodes.item(1);
  charLimit = next.childNodes.item(5).innerHTML;

  var byte = 0 ;
  for(var i=0; i<text.length; i++){
    var oneChar = escape(text.charAt(i));
    if(oneChar.length == 1){
      byte++;
    }else if(oneChar.indexOf("%u") == 0){
      byte += 2;
    }else if(oneChar.indexOf("%") == 0 ){
      byte++;
    }

  }

  charNum.innerHTML = "";
  charNum.append(byte) ;

  if(charLimit < byte){
    next.style.color = "red";
    next.setAttribute("over","yes");
  }else{
    next.style.color = "rgb(154, 154, 154)" ;
    next.setAttribute("over","no");
  }
}

// 文字byte数チェック
function CharCheck(position){
  var text = position.value ;
  var next = position.nextElementSibling ;
  next = next.childNodes.item(1) ;

  charNum = next.childNodes.item(1);
  charLimit = next.childNodes.item(5).innerHTML;

  var count = 0 ;
  // for(var i=0; i<text.length; i++){
  //   var oneChar = escape(text.charAt(i));
  //   if(oneChar.length == 1){
  //     byte++;
  //   }else if(oneChar.indexOf("%u") == 0){
  //     byte += 2;
  //   }else if(oneChar.indexOf("%") == 0 ){
  //     byte++;
  //   }
  //
  // }

  charNum.innerHTML = "";
  charNum.append(text.length) ;

  if(charLimit < text.length){
    next.style.color = "red";
    next.setAttribute("over","yes");
  }else{
    next.style.color = "rgb(154, 154, 154)" ;
    next.setAttribute("over","no");
  }
}




function validCheck(){
  var product_code = $("input[name=product_code]");
  var idCheck = 0;
  var element = $(".valid");
  var count = 0;
  var charOver = 0;
  var multiCategory = $("select[id=multiCategory] option");
  var enable_specific_delivery = $("input[name=enable_specific_delivery]");
  var display_type = $("input[name=display_type]");
  var prior = $("input[name=prior]");
  var showStock = $("input[name=showStock]");
  var subImageCheck = $("input[name=imageSub]:checked").val();



  multiCategory.each(function() {

    var value = $(this).text();
    $(this).val(value);
    $(this).prop("selected","true");

    count++;
  });

  $(".checkbyte").each(function(){
      var over = $(this).attr("over");
      console.log(over);
      if(over == "yes"){
        charOver++;
      }
  });
  console.log("charOver : " + charOver);
  // product_code 重複確認
  $.ajax({
    url : "productCodeCheck",
    type : "post",
    data : {
      product_code : product_code.val()
    },
    async : false,
    success: function(data){
      console.log("aa : " + data);
      if(data > 0){
        idCheck++;
      }
    }
  });

  if(idCheck != 0){
    product_code.val("");
    product_code.focus();
    alert("商品番号がすでに登録されています。違うものを指定してください。");
    return false;
  }
  if(charOver > 0){
    console.log("charover : " + charOver);
    alert("字数確認してください。");
    return false ;
  }


  for(var i=0; i<element.length; i++){
    var check = false;
    var text = element[i].value;
    var role = element[i].getAttribute("name") ;


    if(role == "product_code"){
      check = ProductCodeValid(text);

      if(check == false){
          element[i].focus();
          alert("商品番号を入力してください");
          return false;
      }
    }else if(role == "product_name" ){
      check = StandardValid(text,role);

      if(check == false){
          element[i].focus();
          alert("商品名を入力してください. ♥、🌸などは使えないです。");
          return false;
      }else{
        element[i].value = text.trim();
      }
    }else if(role == "product_price" ){
      check = ProdcutPriceValid(text);

      if(check == false){
          element[i].focus();
          alert("販売価格を0～99999999円（税込）になる数字を入力してください。");
          return false;
      }
    }else if(count==0){
        alert("categoryを設定してください");
        return false ;
    }else if(role == "deliveryPreparation"){
      check = DeliveryPreValid(text);

      if(check == false){
          element[i].focus();
          alert("発送準備期間は半角数字「0～365」で指定してください。");
          return false;
      }
    }else if(role == "specific_delivery_charge" ){
      check = ProdcutPriceValid(text);

      if(check == false){
          element[i].focus();
          alert("販売価格を0～99999999円（税込）になる数字を入力してください。");
          return false;
      }
    }else if( role == "main-image"){
      console.log("d : "+element[i].innerHTML);
      console.log("d : "+subImageCheck);
      if(subImageCheck == "sub"){
          if(element[i].innerHTML == ""){
            alert("「複数画像登録を利用する」をチェックしている場合は、メイン画像を登録してください。");
            element[i].focus();
            return false;
          }
      }

    }else{
      check = StandardValid(text,role);

      if(check == false){
          element[i].focus();
          alert("文字、特集文字、数字だけ入力してください。 ♥、🌸などは使えないです。");
          return false;
      }else{
        element[i].value = text.trim();
      }
    }

  }




  showStock.removeAttr("disabled");

  $(".productInfoDetail input[type=checkbox]").prop("checked","checked");
  enable_specific_delivery.prop("checked","checked");
  display_type.prop("checked","checked");
  prior.prop("checked","checked");


}

function TextTrim(text){

  return text.trim();

}

function str2Array(str) {
    var array = [],i,il=str.length;
    for(i=0;i<il;i++) array.push(str.charCodeAt(i));
    return array;
}

function StandardValid(text,role){
  var check = false;
  var text = TextTrim(text);


  var unicodeArray = str2Array(text);
  var euc = Encoding.convert(unicodeArray, 'EUCJP', "AUTO");
  var unicode = Encoding.convert (euc,  'UNICODE' ,  'AUTO' );
  var unicodeString = Encoding.codeToString(unicode);

  console.log(unicodeString);
  console.log(unicodeString == text);

  if(text == unicodeString){
    console.log("a");
    if(role == "description" || role == "SEOCatchCopy" || role == "product_name"){
      console.log("b");
      if(text == ""){
          check = false ;
      }else{
        console.log("c");
        check = true ;
      }
    }else{

      check = true ;

    }
  }else{
    console.log("b");
  }



  return check ;
}

function ProductCodeValid(text){
  var check = false;
  var pattern = /^[a-zA-Z0-9_-]+$/ ;

  if(pattern.test(text)){
      check = true ;
  }

  return check ;

}

function ProdcutPriceValid(text){
  var check = false;
  var pattern = /^[0-9]+$/; // 数

  if(pattern.test(text) && (text >= 0) && (text<=99999999) ){
      check = true ;
  }

  return check ;

}

function DeliveryPreValid(text){
  var check = false;
  var pattern = /^[0-9]+$/; // 数


  if(pattern.test(text) && (text >= 0) && (text<=365) ){
      check = true ;
  }

  return check ;
}


function validStockCheck(){
  var element = $(".valid");
  var quantity = "";
  var type = $("input[name=type]");

  for(var i=0; i<element.length; i++){
    var check = false;
    var text = element[i].value;
    var role = element[i].getAttribute("name") ;
// console.log(element[i].classList.contains("quantity"));
// return false;
    if(role == "quantity"  || element[i].classList.contains("quantity") ){
      check = StockValid(text,"quantity");
      if(check==false){
        element[i].focus();
        alert("0~9999 or 無制限である場合は「ｚ」を入力してください。");
        return check;
      }else{
        quantity = text;
      }
    }else if(role == "alert_threshold"|| element[i].classList.contains("alert_threshold")){
      check = StockValid(text,"alert_threshold");
      if(check==false){
        element[i].focus();
        alert("0~9999を入力してください。");
        return check;
      }
    }
  }


  if(type.val()=="Item"){
    if(quantity == "z" ||  quantity == "Z"){
      quantity = "無制限";
    }
  }else{
    quantity = "バリエーションごと";
  }

  $("#productStock", opener.document).empty();
  $("#productStock", opener.document).append(quantity);
  window.close();
}

function StockValid(text,role){
  var pattern = /^[0-9]+$/; // 数
  var pattern1 = /^[zZ]+$/ ;
  var check = false;
  console.log( pattern1.test(text) );
  if(role == "quantity"){
    if(pattern.test(text) &&  (text >= 0) && (text<=9999) || pattern1.test(text) ){
      check = true;
    }
  }else{
    if(pattern.test(text) &&  (text >= 0) && (text<=9999) ){
      check = true;
    }
  }

  return check;
}

function validShow(){
  var count = 0;
  $(".titleCheck").each(function(){

    count++;
    if(count==1){
      if($(".selectOne option").length>0 || $(this).val() != "" ){
        $(this).addClass("valid");
      }else{
        $(this).removeClass("valid");
      }
    }else if(count==2){
      if($(".selectTwo option").length>0 || $(this).val() != ""){
        $(this).addClass("valid");
      }else{
        $(this).removeClass("valid");
      }
    }else if(count==3){
      if($(".selectThree option").length>0 || $(this).val() != ""){
        $(this).addClass("valid");
      }else{
        $(this).removeClass("valid");
      }
    }

  });

  console.log($(".selectOne option").length);


}



function validVariationCheck(){
  // validSelectShow();
  validShow();

  var element = $(".valid");
  var quantity = "";

  for(var i=0; i<element.length; i++){

    var check = false;
    var count = 0;
    var text = element[i].value;
    var role = element[i].getAttribute("name") ;

    if(i==0){
      if(text == "" ){
        element[i].focus();
        alert("項目名を入力してください。");
        return false;
      }else if( role != "title1"){
        alert("1つ目の項目を先に入力してください。");
        return false;
      }else{
        check = VariationNameValid(text);
        if(check == false){
          element[i].focus();
          alert("環境依存,余白を入力できません。");
          return false;
        }else{
          $(".selectOne option").each(function() {
            count++;
          });
        }
      }
    }else if(i==1){
      if(text == "" ){
        element[i].focus();
        alert("項目名を入力してください。");
        return false;
      }else if( role != "title2"){
        alert("2つ目の項目を先に入力してください。");
        return false;
      }else{
        check = VariationNameValid(text);
        if(check == false){
          element[i].focus();
          alert("環境依存,余白を入力できません。");
          return false;
        }else{
          $(".selectTwo option").each(function() {
            count++;
          });
        }
      }
    }else if(i==2){
      if(text == ""){
        element[i].focus();
        alert("項目名を入力してください。");
        return false;
      }else{
        check = VariationNameValid(text);
        if(check == false){
          element[i].focus();
          alert("環境依存,余白を入力できません。");
          return false;
        }else{
          $(".selectThree option").each(function() {
            count++;
          });
        }
      }
    }
    console.log(count);
    if(count == 0){
      alert("variationを追加してください。");
      return false;
    }
  }

  $(".selectOne option").each(function() {
    $(this).prop("selected","true");
  });
  $(".selectTwo option").each(function() {
    $(this).prop("selected","true");
  });
  $(".selectThree option").each(function() {
    $(this).prop("selected","true");
  });

  $("#productStock", opener.document).empty();
  $("#productStock", opener.document).append("バリエーションごと");

  window.close();
}

function VariationNameValid(text){
  var check = false;

  var pattern = /^[\s]+$/ ;

  var unicodeArray = str2Array(text);
  var euc = Encoding.convert(unicodeArray, 'EUCJP', "AUTO");
  var unicode = Encoding.convert (euc,  'UNICODE' ,  'AUTO' );
  var unicodeString = Encoding.codeToString(unicode);

  console.log(unicodeString);
  console.log(unicodeString == text);
  console.log(pattern.test(text));
  if(text == unicodeString && !pattern.test(text)){
      check = true ;
  }else{
    check = false;
  }


  return check ;
}

