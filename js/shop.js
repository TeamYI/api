//total count
var totalSlides ;
//slide count
var slideCount = 0 ;
//current position
var curr_position ;
$(document).ready(function(){

    //image length
    totalSlides = $("#slide").children("img").length ;
    curr_position  = $('#slide').children("img").eq(0);

    console.log(totalSlides);
    console.log(curr_position);

    //main slide
    // setInterval(slideFade,5000) ;



})

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
        $("#login-error").css("display","block");
      }

    },
    error : function(request,status,error){
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);


    }
  })
}
function Cart(){
  
  $("#BuyPageMove").attr("action", "/shop/cart");

}

//product BUY
function BuyPageMove(){

  $("#BuyPageMove").attr("action", "/shop/buyPageMove");

  // var code = $("#product-code").attr("data-code");
  // var price = $("#product-price").attr("data-price");
  // var amount = $("input[name='amount']").val();
  //
  // console.log("code : "+code);
  // console.log("price : "+price);
  // console.log("amount : "+amount);
  //
  // $.ajax({
  //   url : "/shop/buy",
  //   type : "post",
  //   data : {
  //     // ci_t : csrf_token,
  //     code : code,
  //     price : price,
  //     amount : amount
  //   },
  //   success: function(data){
  //     console.log("data : ");
  //
  //   },
  //   error : function(request,status,error){
  //     console.log("code:"+request.status+"\n"+"error:"+error);
  //
  //
  //   }
  // })
}

// product BUY
function ProductBuy(){
  // alert("ddd");
  // console.log($("#ProductBuy"));
  $("#ProductBuy").attr("action", "/shop/buy");
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
