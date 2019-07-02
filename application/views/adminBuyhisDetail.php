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
    <div id="buy-check">
      <h1>注文確認</h1>
      <div class="buy-head-title">注文商品</div>
      <table>
        <colgroup>
          <col width="100px">
          <col>
          <col width="214px">
          <col width="126px">
          <col width="235px">
        </colgroup>
        <thead>
          <tr>
            <th>商品情報</th>
            <th>&nbsp;</th>
            <th>販売金額</th>
            <th>数</th>
            <th>総金額</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($product as $product){ ?>
          <tr>
            <td>
              <img src="../img/<?php echo $product["product_img"] ?>" class="buy-product-img" alt="">
            </td>
            <td>
              <div>カロンカロン</div>
              <div><?php echo $product["product_name"] ?></div>
            </td>
            <td>
              <span><?php echo $product["product_price"] ?></span>
            </td>
            <td>
              <span><?php echo $product["product_amount"] ?></span>
            </td>
            <td>
              <span><?php echo $product["sum_price"] ?></span>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </body>
</html>
