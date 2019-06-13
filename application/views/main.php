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
          <a href="main" id="logo" title="main page 移動します。">
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
        <div id="slide">
          <img src="./img/main-contain-01.jpg" class="active" alt="" style="z-index:999">
          <img src="./img/main-contain-02.png" class="1" alt="" style="z-index:998">
          <img src="./img/main-contain-03.png" class="2" alt="" style="z-index:997">
          <img src="./img/main-contain-04.png" class="3" alt="">
        </div>
        <div id="main-notice">
          <h3 class="main-medium-text">カロンカロン NOTICE</h3>
          <div id="main-notice-list">
            <div class="main-notice">
              <a href="">
                <div class="main-notice-image">
                  <img src="./img/main-notice.png" alt="">
                </div>
                <div class="main-notice-text">
                  <span>신규회원 "3000원" 쿠폰 증정</span>
                </div>
              </a>
            </div>
            <div class="main-notice">
              <a href="">
                <div class="main-notice-image">
                  <img src="./img/main-notice.png" alt="">
                </div>
                <div class="main-notice-text">
                  <span>신규회원 "3000원" 쿠폰 증정</span>
                </div>
              </a>
            </div>
            <div class="main-notice">
              <a href="">
                <div class="main-notice-image">
                  <img src="./img/main-notice.png" alt="">
                </div>
                <div class="main-notice-text">
                  <span>신규회원 "3000원" 쿠폰 증정</span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div id="main-recommend-wrap">
            <h3 class="main-medium-text">
              <a href="javascript:pageSwitchNB('new');" class="main-new active">NEW</a>
              <a href="javascript:pageSwitchNB('best');" class="main-best">BEST</a>
              <br>
              <a href="">more..</a>
            </h3>
            <div class="main-recommend-list new-list">
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-4.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-3.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-2.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-1.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
            </div>
            <div class="main-recommend-list best-list" >
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-1.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-2.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-3.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
              </div>
              <div class="main-recommend">
                <a href="">
                  <div class="main-recommend-image">
                    <img src="./img/a-4.png" alt="">
                  </div>
                  <div class="main-recommend-text">
                    <span>새콤달콤한 딸기우유 마카롱</span>
                  </div>
                </a>
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
