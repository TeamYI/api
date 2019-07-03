<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>example shop</title>
	<link rel="stylesheet" href="./css/shop.css">
	<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="./js/shop.js"></script>
</head>
<body>
    <input type="hidden" name="product_code" value="<?php echo $product_code ?>">
    <input type="hidden" name="buy_code" value="<?php echo $buy_code ?>">
    <div>
      <label for="">商品名 :</label>
      <span><?php echo $name ?></span>
    </div>
    <div>
      <span>評点</span>
      <select name="star" value="1">
        <option value="1">★</option>
        <option value="2">★★</option>
        <option value="3">★★★</option>
        <option value="4">★★★★</option>
        <option value="5">★★★★★</option>
      </select>
    </div>
    <div>
      <div class="">review</div>
      <input type="text" name="content" value="" style="width:380px; height:120px">
    </div>
    <button name="button" type="button" onclick="reviewWrite()">作成</button>
</body>
</html>
