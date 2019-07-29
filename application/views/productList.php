<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="./js/api.js"></script>
    <link rel="stylesheet" href="./css/api.css">
  </head>
  <body>
    <section>
    <label for="">商品名</label>
    <input type="text" name="productNameSearch" value="">
    <button type="button" name="button" onclick="ProductSearch()">product search</button>
    <button type="button" name="productRegiserPage" onclick="ProductRegisterPage()">商品の新規登録</button>
    <table id="productList">
    <colgroup>
      <col width="80px">
      <col width="100px">
      <col width="214px">
      <col width="214px">
      <col width="126px">
    </colgroup>
    <thead>
      <tr>
        <th>選択</th>
        <th>商品番号</th>
        <th>商品名</th>
        <th>販売価格（税込）</th>
        <th>在庫数</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</section>
  </body>
</html>
