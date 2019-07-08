<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>example shop</title>
    <link rel="stylesheet" href="../css/shop.css">
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/shop.js"></script>
  </head>
  <body>
    <div id="page-container">
      <header id="header">
        <h1 id="logo-wrapper">
          <a href="main" id="logo" title="main page 移動します。">
            <img src="../img/main-logo.png" alt="" width="210px" height="100px">
          </a>
        </h1>
        <div id="nav-user-menu">
          <ul id="header-nav-actions">
            <li>
                <?php
                  if(isset($_SESSION["user_id"])){
                      echo $_SESSION["user_id"]."様" ;
                  }else { ?>
                <a href="/shop/login">
                <?php
                    echo "My Account";
                  }
                ?>
              </a>
            </li>
            <li><a href="/shop/cart">CART</a></li>
            <?php
              if(isset($_SESSION["user_id"])){ ?>
                <li><a href="/shop/mypage">MYPAGE</a></li>
                <li><a href="/shop/logout">LOGOUT</a></li>
            <?php } ?>
          </ul>
        </div>
        <div id="header-search">
          <form id="searchForm" class="" action="" method="post" onsubmit="return searchCheck();" >
            <span id="search-label">search</span>
            <input type="text" id="header-search-container" name="search" onkeyup="enterkey('search')">
            <button name="button">
              <img src="../img/searchIcon.png" alt="">
            </button>
          </form>
        </div>
        <div id="header-menu">
          <ul id="header-menu-cate">
            <a href="/shop/main"><li>TOP</li></a>
            <a href="/shop/categoryList/0"><li>SHOP</li></a>
            <a href="#"><li>MAGAZINE</li></a>
            <a href="/shop/noticeList"><li>NOTICE</li></a>
          </ul>
        </div>
      </header>
      <section id="section-main">
        <div id="wrap-navi">
          <div class="sub-logo">
            <a href="#">
              <span>カロンカロン</span>
            </a>
          </div>
          <div class="sub-menu">
            <ul>
              <li><a href="/shop/categoryList/0">商品一覧</a></li>
              <li><a href="/shop/categoryList/1">マカロン</a></li>
              <li><a href="/shop/categoryList/2">マカロンセット</a></li>
              <li><a href="/shop/categoryList/3">デザート</a></li>
            </ul>
          </div>
        </div>
        <div id="wrap-product">
          <h2><?php echo $category_name ?></h2>
          <hr>
          <ul id="product-list">
            <?php
              foreach ($list as $list) {
            ?>
            <a href="/shop/product/<?php echo $list["product_code"]; ?>">
              <li>
                  <img src="../img/<?php echo $list["product_img"]; ?>" alt="">
                  <span><?php echo $list["product_name"]; ?></span>
                  <p><?php echo $list["product_detail"]; ?></p>
                  <span><?php echo "¥".$list["product_price"]; ?></span>
              </li>
            </a>
            <?php } ?>
          </ul>
        </div>
      </section>
      <footer id="footer">

      </footer>
      <div id="nav-menu-container">

      </div>
    </div>
  </body>
</html>
