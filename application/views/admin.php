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
      <table>
        <colgroup>
          <col width="200px">
          <col width="180px">
          <col width="100px">
          <col width="80px">
          <col width="150px">
        </colgroup>
        <thead>
          <tr>
            <th>注文番号</th>
            <th>注文者</th>
            <th>合計金額</th>
            <th>決済状態</th>
            <th>注文日時</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($list as $list){ ?>
          <tr>
            <td>
              <a href="buyHistoryDetail/<?php echo $list["buy_code"] ?>" class="buy-code">
                <?php echo $list["buy_code"] ?>
              </a>
            </td>
            <td>
              <?php echo $list["user_name"] ?>
            </td>
            <td>
              <?php echo $list["buy_price"] ?>
            </td>
            <td>
              <?php echo $list["payment_check"] ?>
            </td>
            <td>
              <span><?php echo $list["buy_date"] ?></span>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </body>
</html>
