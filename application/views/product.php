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
          <a href="/shop/main" id="logo" title="main page 移動します。">
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
            <a href="/shop/productList"><li>SHOP</li></a>
            <a href=""><li>MAGAZINE</li></a>
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
              <li><a href="javascript:CategoryList(0,'商品一覧');">商品一覧</a></li>
              <li><a href="javascript:CategoryList(1,'マカロン');">マカロン</a></li>
              <li><a href="javascript:CategoryList(2,'マカロンセット');">マカロンセット</a></li>
              <li><a href="javascript:CategoryList(3,'デザート');">デザート</a></li>
            </ul>
          </div>
        </div>
        <div id="wrap-product">
          <div id="product-head">
              <div id="product-head-img">
                <img src="../img/<?php echo $list->product_img ?>" alt="">
              </div>
              <div id="product-head-info">
                <form class="" action="" method="post"  id="BuyPageMove">
                  <input type="hidden" name="product_code" value="<?php echo $list->product_code ?>">
                  <input type="hidden" name="product_price" value="<?php echo $list->product_price ?>">
                  <input type="hidden" name="product_name" value="<?php echo $list->product_name?>">
                  <input type="hidden" name="product_img" value="<?php echo $list->product_img ?>">
                  <ul>
                    <li>カロンカロン</li>
                    <li><?php echo $list->product_name?></li>
                    <li>
                      <span><?php echo "¥".$list->product_price ?></span>
                    </li>
                    <hr>
                    <li>
                      <span>数量</span>
                      <input type="text"  name="amount" value="1">
                    </li>
                    <li>
                      <p>2000円以上買ったら、配送料無料</p>
                    </li>
                    <button id="product-cart" class="product-btn" onclick="CartInsert()" name="">CART</button>
                    <button id="product-buy" class="product-btn" onclick="BuyPageMove()" name="">BUY</button>
                  </ul>
                </form>
              </div>
          </div>
          <div id="product-section">
            <div class="tabs">
              <input id="review" type="radio" name="tab_item" checked>
              <label class="tab_item" for="review">review</label>
              <input id="question" type="radio" name="tab_item">
              <label class="tab_item" for="question">お問い合せ</label>
              <div class="tab_content" id="review_content">
                <div class="tab_content_description">
                  <div>yun様</div>
                  <div class="">
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                  </div>
                  <div class="">
                    <p>afdsfdsfsdfsdfadhfsodfihoshfos</p>
                  </div>
                  <div class="review-date">date 2019-08-27</div>
                </div>
                <div class="tab_content_description">
                  <div>yun様</div>
                  <div class="">
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                  </div>
                  <div class="">
                    <p>afdsfdsfsdfsdfadhfsodfihoshfos</p>
                  </div>
                  <div class="review-date">date 2019-08-27</div>
                </div>
                <div class="tab_content_description">
                  <div>yun様</div>
                  <div class="">
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                    <span class="star">
                      <img src="../img/star.png" alt="">
                    </span>
                  </div>
                  <div class="">
                    <p>afdsfdsfsdfsdfadhfsodfihoshfos</p>
                  </div>
                  <div class="review-date">date 2019-08-27</div>
                </div>
              </div>
              <div class="tab_content" id="question_content">
                <button type="button" name="button"></button>
                <div class="tab_content_description">
                  <p class="c-txtsp">プログラミングの内容がここに入ります</p>
                </div>
              </div>
            </div>
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
