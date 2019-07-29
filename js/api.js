var categorySelectOption = 0 ;
var productDescription = "";

$(document).ready(function(){

  //商品登録ページ、選択したカテゴリ状態
  var multiCategory = $("#multiCategory");

  multiCategory.change(function() {
    categorySelectOption = $('option:selected');

  });

});

//商品検索した結果が出るか
function ProductSearch(){

  var productList = $("#productList tbody");
  var productName = $("input[name='productNameSearch']").val();
  productList.empty();

  $.ajax({
    url : "/api/productSearch",
    type : "post",
    data : {
      // ci_t : csrf_token,
      item_name : productName

    },
    dataType : "json",
    success: function(data){
      var count = 0;
      var txt = "";

      if(data["contents"].length){
        count = data["contents"].length ;

        for(var i=0 ; i<count; i++){
          var product = data["contents"][i];
          var stock = product["stock"]["quantity"];

          txt += '<tr>'
                + '<td><input type="checkbox" name="product" value="'+product["item_code"]+'"></td>'
                + '<td><a href="/api/product/'+product["item_code"]+'">'+product["item_code"]+'</a></td>'
                + '<td>'+product["item_name"]+'</td>'
                + '<td>'+product["item_price"]+'</td>';

          if(stock == 99999999){
              txt += '<td>在庫が無制限</td>' ;
          }else{
              txt += '<td>'+stock+'</td>' ;
          }

          txt += '</tr>';

        }

      }else{
        txt = "<p>該当商品がありません。</p>";
      }

      console.log(txt);

      productList.append(txt);


    },
    error : function(request,status,error){
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);


    }
  });

}


function ProductRegisterPage(){
  location.href="/api/productRegisterPage";
}
function CategoryDelete(){
  categorySelectOption.remove();
  console.log(categorySelectOption);
}

function CategorySelect(){
  window.open("/api/productCategoryAdd", "category", "width=800, height=650, status=1");
}

function CategorySelectWindowClose(){
  var category = $("input[name=category]:checked").next();
  category = $.trim(category.text());
  console.log(category);
  category = category.replace(/ /gi, '');
  var count = 0;
  $("#multiCategory option", opener.document).each(function(){
    var option = $(this).text() ;
    if(option == category){
      count=-1;
      return false ;
    }
    count++;
  });

  if(count>=0){
    var text = "<option name='category' value='"+count+" '>"+category+"</option>";
    $("#multiCategory", opener.document).append(text);
    window.close();
  }else{
    $("#categoryErrorSelect").css("display","block");
  }


}

function CategoryWindowClose(){
  window.close();
}

function deliveryType(type){
  if(type == "Mail"){
    $("#deliveryStandardSetWrap").css("display","none");
    $("input[name=deliveryPreparation]").removeClass("valid");
  }else{
    $("#deliveryStandardSetWrap").css("display","block");
    $("input[name=deliveryPreparation]").addClass("valid");
  }
}

function DisableTempSet(position){
  var check = position.checked ;
  console.log("check : "+ check);

  if(check == true){
    $("input[name=temperature_controlled]").attr("disabled","disabled");
    position.removeAttribute("disabled");
  }else{
    $("input[name=temperature_controlled]").removeAttr("disabled");
  }
}

function enableSpecificDelivery(position){
  var check = position.checked;
  if(check == true){
    position.value = "Yes";
    $("#specificDeliverySetWrap").css("display","block");
    $("input[name=specific_delivery_charge]").addClass("valid");
  }else{
    position.value = "No";
    $("#specificDeliverySetWrap").css("display","none");
    $("input[name=specific_delivery_charge]").removeClass("valid");
  }

}



function FreeDeliveryDisplaySelect(position){
  var check = position.checked ;

  if(check == true){
    position.value = "Free";
  }else{
    position.value = "Zero";
  }
}

function priorSelect(position){
  var check = position.checked ;

  if(check == true){
    position.value = "Yes";
  }else{
    position.value = "No";
  }
}
// Yes , No change function
function CheckboxSelect(position){
  var check = position.checked ;
  console.log(position);
  if(check == true){
    position.value = "Yes";
  }else{
    position.value = "No";
  }
}

//sub images register show hide
function imageSubShow(check){
  if(check == "one"){
    $("#imageSub").css("display","none");

  }else{
    $("#imageSub").css("display","block");

  }

}

function imageSubPositionFrontModify(currentPosition){
  var parent = currentPosition.parentNode.parentNode;
  var position = "";
  var code = parent.getAttribute("code");


  $(".imageSubWrap span").each(function(){
      console.log($(this));
      console.log(code);
      if(code == $(this).attr("code")){
        console.log("d");
        code--;
        position = $(this);
        $(this).remove();

        return false;
      }
  });
  if(position.hasClass("last")){
    $(".imageSubWrap span[code="+code+"]").addClass("last");
    position.removeClass("last");
  }

  if($(".imageSubWrap span[code="+code+"]").hasClass("first")){
    $(".imageSubWrap span[code="+code+"]").removeClass("first");
    position.addClass("first");
  }

  if(code == 5){
    var position6 = $(".imageSubWrap span[code="+code+"]");
    $(".imageSubWrap span[code="+code+"]").before(position);
    if($(".imageSubWrap div").eq(1).find("span").length <6){
      console.log("cc");
      console.log($(".imageSubWrap div").eq(1).hasClass("title"));
      $(".title").after(position6);
    }else{
      console.log("ee");
      $(".imageSubWrap span[code=7]").before(position6);
    }

    $(".imageSubWrap span[code="+code+"]").attr("code",code+1);
    position.attr("code",code);

  }else {
    $(".imageSubWrap span[code="+code+"]").before(position);

    $(".imageSubWrap span[code="+code+"]").attr("code",code+1);
    position.attr("code",code);

  }
  // if(code==1){
  //   currentPosition.style.display = "none";
  // }else{
  //   currentPosition.nextElementSibling.style.display = "inline-block";
  // }


  console.log(parent);

}

function imageSubPositionBackModify(currentPosition){
  var parent = currentPosition.parentNode.parentNode;
  var position = "";
  var code = parent.getAttribute("code");


  $(".imageSubWrap span").each(function(){
      console.log($(this));

      if(code == $(this).attr("code")){
        console.log("d");
        code++;
        position = $(this);
        $(this).remove();

        return false;
      }
  });
  console.log("position :  "+ position.hasClass("last"));

  if($(".imageSubWrap span[code="+code+"]").hasClass("last")){
    $(".imageSubWrap span[code="+code+"]").removeClass("last");
    position.addClass("last");
  }

  if(position.hasClass("first")){
    $(".imageSubWrap span[code="+code+"]").addClass("first");
    position.removeClass("first");
  }

  if(code == 6){
    var position6 = $(".imageSubWrap span[code="+code+"]");
    $(".imageSubWrap span[code="+code+"]").after(position);
    $(".imageSubWrap span[code=4]").after(position6);
    $(".imageSubWrap span[code="+code+"]").attr("code",code-1);

    position.attr("code",code);


  }else {
    $(".imageSubWrap span[code="+code+"]").after(position);
    $(".imageSubWrap span[code="+code+"]").attr("code",code-1);

    position.attr("code",code);
  }
}
//sub image register
function subImageRegister(role,text){
  var count = 1 ;
  //sub image count
  $(".imageSubWrap .sub").each(function(){
    count++;
  })

  //sub image == 10 , sub image register button disabled
  if(count==10){
      $("button[name=subImagebutton]").prop("disabled","disabled");
  }

  if(role == "mainImage"){
    $("#mainSubImage li").eq(0).empty();
    $("#mainSubImage li").eq(0).append(text);
  }else{
    if(count>1){
      // sub imageが総2以上である場合、back button 見える
      $("#mainSubImage button[name=back]").css("display","inline-block");
    }
    //count1 == span 番号
    var count1 = count;

    //
    if(count >= 6){
      count1 = count1 + 1;
    }
    if(count>6){
      $(".imageSubWrap span").eq(count1-1).removeClass("last");
    }else{
      $(".imageSubWrap span").eq(count-1).removeClass("last");
    }

    $(".imageSubWrap span").eq(count1).addClass("sub last");
    $(".imageSubWrap span").eq(count1).attr("code",count);

    var position = $(".imageSubWrap span[code="+count+"] li");
    var text1 = '<button type="button" name="front" onclick="imageSubPositionFrontModify(this)" >←</button>'
                +'<button type="button"  name="back" onclick="imageSubPositionBackModify(this)">→</button>' ;
    var text2 = '<button type="button"  onclick="imageSubPositionRemove(this,'+count+')">削除</button>';
    position.eq(0).append(text);
    position.eq(1).append(text1);
    position.eq(2).append(text2);

  }
}

function imageSubPositionRemove(position,count){
  var parent = position.parentNode.parentNode;
  var tag = "";
  var count = 0 ;
  var text = 	"<span>"
              +"<li></li>"
              +"<li></li>"
              +"<li></li>"
            +"</span>" ;

  var divCount = $(".imageSubWrap > div") ;
  parent.remove();
  $(".sub").each(function(){
    count++;
    if(count==1){
      $(this).addClass("first");
    }
    if($(".sub").length == count){
      $(this).addClass("last");
    }
    $(this).attr("code",count);
    if($(this).attr("code") == 5){
      $(this).insertAfter($(".imageSubWrap span[code=4]"));
    }
  });

  if(count < 10){
    $("button[name=subImagebutton]").removeAttr("disabled");
  }

  for(var i=0; i<divCount.length; i++){
      if(divCount.eq(i).find("span").length < 6){
        divCount.eq(i).append(text);
      }
  }
}

//cart check is not -> show stock set X
function StockDisabled(position){
  var check = position.checked ;
  var stock = $("input[name=showStock]");
  if(check == true){
    stock.removeAttr("disabled");
  }else{
    stock.prop("checked","");
    stock.val("No");
    stock.prop("disabled","disabled");
  }
}

//main image delete
function ProductImageRemove(){
  $("#main-image").empty();
  $("#mainSubImage li").eq(0).empty();
}

// main image select
function ProductImageSelect(){
  window.open("/api/productImageSelect?role=mainImage", "imagesSelect", "width=500, height=650, status=1");
}

// product description images select
function ProductIntroductionImageSelect(position){
  //現在入力される紹介文位置探す
  productDescription = position.nextElementSibling ;
  productDescription = productDescription.childNodes[1];
  console.log(productDescription);

  window.open("/api/productImageSelect?role=introductionImage", "imagesSelect", "width=500, height=650, status=1");

}
// child windowから function call
function insertImageDescription(text){
  var value = productDescription.value ;
  productDescription.value = value + text;

  CharByteCheck(productDescription);
}



//------------------------------------------------
// children window js
//------------------------------------------------
function ProductImageSelect(role){
  window.open("/api/productImageSelect?role="+role, "imagesSelect", "width=500, height=650, status=1");
}

function ProductImageSelectWindowClose(code,role){

  var image_name = code;

  //main image select
  if(role == "mainImage"){
    var src = $("img[name='"+image_name+"']").attr("src");
    var text = "<img src='"+src+"' >";
;

    $("#main-image", opener.document).empty();
    $("#main-image", opener.document).append(text);

    var text = "<img src='"+src+"' >"
               + "<input type='hidden' name='image_name[]' value='"+image_name+"'>"
               + "<input type='hidden' name='main_image[]' value='Yes'>";

    window.opener.subImageRegister(role,text);

  }else if(role == "subImage"){
    var src = $("img[name='"+image_name+"']").attr("src");
    var text = "<img src='"+src+"' >"
               + "<input type='hidden' name='image_name[]' value='"+image_name+"' >"
               + "<input type='hidden' name='main_image[]' value='No'>";

    window.opener.subImageRegister(role, text);
  }else{ // product description images select
    var src = $("img[name='"+image_name+"']").attr("src");
    var text = "<img src='"+src+"' >";
    // parent window function call
    window.opener.insertImageDescription(text);
  }
  window.close();
}
