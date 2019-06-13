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
    <div id="page-container">
      <header id="header">
        <h1 id="logo-wrapper">
          <a href="/shop/main" id="logo" title="main page 移動します。">
            <img src="./img/main-logo.png" alt="" width="210px" height="100px">
          </a>
        </h1>
        <div id="nav-user-menu">
          <ul id="header-nav-actions">
            <li>
                <?php
                  if(isset($_SESSION["user_id"])){
                      echo $_SESSION["user_id"] ;
                  }else { ?>
                <a href="login">
                <?php
                    echo "My Account";
                  }
                ?>
              </a>
            </li>
            <li><a href="">Cart</a></li>
            <li><a href="">My page</a></li>
            <li>
            <?php
              if(isset($_SESSION["user_id"])){
            ?><a href="logout">logout</a></li>
          <?php } ?>

          </ul>
        </div>
        <div id="header-search">
          <span id="search-label">search</span>
          <input type="text" id="header-search-container">
        </div>
        <div id="header-menu">
          <ul id="header-menu-cate">
            <a href="productList"><li>SHOP</li></a>
            <a href=""><li>MAGAZINE</li></a>
            <a href=""><li>EVENT</li></a>
            <a href=""><li>NOTICE</li></a>
          </ul>
        </div>
      </header>
      <section id="section-main">
        <div id="buy-head">
          <h2>注文書作成</h2>
          <hr>
          <div id="buy-product-wrap">
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
                  <th>配送料</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="./img/a-1.png" alt="">
                  </td>
                  <td>
                    <span>カロンカロン</span>
                    <span>딸기우유마카롱</span>
                  </td>
                  <td>
                    <span>3500</span>
                  </td>
                  <td>
                    <span>1</span>
                  </td>
                  <td>
                    <span>250</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </section>
      <footer id="footer">

      </footer>
      <div id="nav-menu-container">

      </div>
    </div>
  </body>
</html>
