//total count
var totalSlides ;
//slide count
var slideCount = 0 ;
//current position
var curr_position ;
var joinIdCheck = 0 ;
$(document).ready(function(){

    //image length
    totalSlides = $("#slide").children("img").length ;
    curr_position  = $('#slide').children("img").eq(0);

    console.log(totalSlides);
    console.log(curr_position);

    // main slide
    setInterval(slideFade,5000) ;

    //카트 페이지 로딩시, 카트에 있는 상품 계산 역할
    checkedSum();





})

//join password = repassword compare
function passwordCheck(){
  var pw = $("input[name='pw']").val();
  var rpw = $("input[name='rpw']").val();
  var p_tag = $("input[name='rpw']").next();
  p_tag.empty() ;
  if(pw===rpw){
    p_tag.empty() ;
  }else {
    p_tag.append("pwが違います。もう一度確認お願いします。");
  }

};


//JOIN
function CheckId(position){
  var user_id = $("input[name='id']").val();
  var p_tag = position.nextElementSibling ;

  $.ajax({
    url : "userCheck",
    type : "post",
    data : {
      // ci_t : csrf_token,
      user_id : user_id
    },
    success: function(data){
      p_tag.innerHTML = "";
      console.log("data : "+ data);
      if(data==1){
        joinIdCheck = 2 ;

        p_tag.append("他のIDを入力してください。");
      }else{
        joinIdCheck = 1 ;
      }
    },
    error : function(request,status,error){
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);


    }
  });

 }

function userJoinCheck(){

  var id = $("input[name='id']");
  var pw = $("input[name='pw']");
  var rpw = $("input[name='rpw']");
  var email = $("input[name='email']");
  var name = $("input[name='name']");
  var post = $("input[name='post']");
  var area = $("input[name='area']");
  var city = $("input[name='city']");
  var addr1 = $("input[name='addr1']");
  var addr2 = $("input[name='addr2']");
  var tel = $("input[name='tel']");


  if(id.val() == ""){
    alert("ID入力してください");
    id.focus();
    return false ;
  }else if(joinIdCheck == 0){
    alert("ID重複確認してください");
    id.focus();
    return false ;
  }else if(joinIdCheck == 2){
    alert("他のID入力してください");
    id.focus();
    return false ;
  }else if(pw.val() == ""){
    alert("パスワード入力してください");
    pw.focus();
    return false ;
  }else if(rpw.val() == ""){
    alert("確認のためもう一度入力してください");
    rpw.focus();
    return false ;
  }else if(email.val() == ""){
    alert("メールアドレス入力してください");
    email.focus();
    return false ;
  }else if(name.val() == ""){
    alert("お名前入力してください");
    name.focus();
    return false ;
  }else if(post.val() == ""){
    alert("郵便番号入力してください");
    post.focus();
    return false ;
  }else if(area.val() == ""){
    alert("都道府県入力してください");
    area.focus();
    return false ;
  }else if(city.val() == ""){
    alert("市区郡入力してください");
    city.focus();
    return false ;
  }else if(addr1.val() == ""){
    alert("町村字入力してください");
    addr1.focus();
    return false ;
  }else if(addr2.val() == ""){
    alert("番地入力してください");
    addr2.focus();
    return false ;
  }else if(tel.val() == ""){
    alert("お電話番号入力してください");
    tel.focus();
    return false ;
  }else{
    return true;
  }

}



//login
function loginCheck(position){
  var form_position = position.parentNode;
  // var csrf_token = $("input[name=csrf_test_name]").val();
  var user_id = $("input[name='user_id']").val();
  var user_pw = $("input[name='user_pw']").val();



  $.ajax({
    url : "userlogin",
    type : "post",
    data : {
      // ci_t : csrf_token,
      user_id : user_id,
      user_pw : user_pw
    },
    dataType : "json",
    success: function(data){
      if(data.length){
        location.href="main";
      }else{
        $("#login-error").css("visibility","visible");
      }

    },
    error : function(request,status,error){
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);


    }
  })
}
// product JS
function CategoryList(category,name){
  var category_code = category ;
  var category_name = name ;
  var list_p = $("#product-list") ;
  var list_title = $("#wrap-product h2");
  $.ajax({
    url : "categoryList",
    type : "post",
    data : {
      category_code : category_code
    },
    dataType : "json",
    success: function(data){
      list_p.empty();
      list_title.empty();

      list_title.append(category_name);

      var text = "";

      console.log("aa :" + data.length);
      if(data.length){
        for(var i=0 ; i<data.length ; i++){
          text =  "<a href='product/"+data[i].product_code+"'>"
                  +"<li>"
                  +   "<img src=./img/"+data[i].product_img+">"
                  +   "<span>"+data[i].product_name+"</span>"
                  +   "<hr>"
                  +   "<p>"+data[i].product_detail+"</p>"
                  +"</li>"
                  +"</a>" ;

          list_p.append(text);
        }
      }else {
        text = "<h2>商品がありません</h2>";
        list_p.append(text);

      }

    },
    error : function(request,status,error){
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);


    }
  })
}


function CartInsert(){

  $("#BuyPageMove").attr("action", "/shop/cartInsert");

}
// cart페이지 계산 처리 역할
function checkedSum(){

  var sum = 0;
  var sumPosition = $(".default-pay span:nth-child(2)") ;
  var deliPosition = $(".delivery-pay span:nth-child(2)") ;
  var total = $(".total span:nth-child(2)") ;
  var buy_sum = $("#buy-sum-price") ;

  var deliPay = parseInt(250);
  $("input:checkbox:checked").each(function(){
      var price = $(this).next().attr("name") ;

      sum += parseInt(price) ;
      console.log(sum);

  })

  $(".buy-product-price").each(function(){
      var price = $(this).text();
      sum += parseInt(price) ;
      console.log(sum);

  })
  sumPosition.empty() ;
  deliPosition.empty() ;
  total.empty();
  buy_sum.empty();

  buy_sum.attr("value",sum);
  sumPosition.append(sum);

  if(sum<2000 && sum>0){
    deliPosition.append(deliPay);
    total.append(sum+deliPay)
  }else{
    deliPosition.append("0");
    total.append(sum)
  }

}
// cart 商品削除
function CartProductRemove(){
  $("#CartForm").attr("action", "/shop/cartDelete");

}
// cart 商品削除
function CartProductRemove(){
  $("#CartForm").attr("action", "/shop/cartDelete");

}

function CartProductBuy(){
  $("#CartForm").attr("action", "/shop/buyPageMove");
}

//product BUY
function BuyPageMove(){

  $("#BuyPageMove").attr("action", "/shop/buyPageMove");

}

// product BUY check
function ProductBuyCheck(){

  var email = $("input[name='email']");
  var name = $("input[name='name']");
  var post = $("input[name='post']");
  var area = $("input[name='area']");
  var city = $("input[name='city']");
  var addr1 = $("input[name='addr1']");
  var addr2 = $("input[name='addr2']");
  var tel = $("input[name='tel']");
  var pay = $("input[name='pay']");

 if(name.val() == ""){
   alert("お名前入力してください");
   name.focus();
   return false ;
 }else if(post.val() == ""){
    alert("郵便番号入力してください");
    post.focus();
    return false ;
  }else if(area.val() == ""){
    alert("都道府県入力してください");
    area.focus();
    return false ;
  }else if(city.val() == ""){
    alert("市区郡入力してください");
    city.focus();
    return false ;
  }else if(addr1.val() == ""){
    alert("町村字入力してください");
    addr1.focus();
    return false ;
  }else if(addr2.val() == ""){
    alert("番地入力してください");
    addr2.focus();
    return false ;
  }else if(tel.val() == ""){
    alert("お電話番号入力してください");
    tel.focus();
    return false ;
  }else if(email.val() == ""){
    alert("メールアドレス入力してください");
    email.focus();
    return false ;
  }else if(pay.is(':checked') == false){
    alert("お支払い方法選択をチェックしてください");
    pay.focus();
    return false ;
  }else{
    return true;
  }

}

function slideFade(){
  //current position imagie fadeout
  curr_position.fadeOut(1000);

  if(slideCount == totalSlides-1){
    curr_position = $('#slide').children("img").eq(0);
    slideCount = 0 ;
  }else {
    slideCount++;
    //next position image
    curr_position = $('#slide').children("img").eq(slideCount);
  }
  //next position image see
  curr_position.fadeIn(1000);
}

//main product new best page switch
function pageSwitchNB(name){
   $(".main-recommend-list").each(function(){
     console.log($(this));
     $(this).css("display","none");
   })

   $(".main-medium-text a").each(function(){
     console.log($(this));
     $(this).css("color","rgb(214, 214, 214)");
     $(this).css("text-decoration","");
   })

   $("."+name+"-list").css("display","block");
   $(".main-"+name).css("color","black");
   $(".main-"+name).css("text-decoration","underline");

   console.log("name :" +  $("#main-medium-text a").length);

}
