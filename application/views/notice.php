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
                      echo $_SESSION["user_id"]."様" ;
                  }else { ?>
                <a href="login">
                <?php
                    echo "My Account";
                  }
                ?>
              </a>
            </li>
            <li><a href="cart">CART</a></li>
            <?php
              if(isset($_SESSION["user_id"])){ ?>
                <li><a href="mypage">MYPAGE</a></li>
                <li><a href="logout">LOGOUT</a></li>
            <?php } ?>
          </ul>
        </div>
        <div id="header-search">
          <form id="searchForm" class="" action="" method="post" onsubmit="return searchCheck();" >
            <span id="search-label">search</span>
            <input type="text" id="header-search-container" name="search">
            <button name="button">
              <img src="./img/searchIcon.png" alt="">
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
          <div class="section-head">
            <h2>NOTICE</h2>
            <span>便利な買い物をため、確認お願い致します。</span>
          </div>
          <div id="notice-list-wrap">
                <table>
                    <colgroup>
                      <col width="30px">
                      <col>
                      <col width="100px">
                      <col width="120px">
                    </colgroup>
                    <thead>
                      <tr>
                        <th>no</th>
                        <th>title</th>
                        <th>作成者</th>
                        <th>作成日</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $list) {?>
                                <tr>
                                  <td>
                                    <div><?php echo $list["board_code"]; ?></div>
                                  </td>
                                  <td>
                                    <a href="noticeContent/<?php echo $list["board_code"]; ?>"><div><?php echo $list["board_title"]; ?></div></a>
                                  </td>
                                  <td>
                                    <span>カロンカロン</span>
                                  </td>
                                  <td>
                                    <span><?php echo $list["date"] ?></span>
                                  </td>
                                </tr>
                              <?php } ?>
                    </tbody>
                  </table>
              </div>
      </section>
      <footer id="footer">

      </footer>
      <div id="nav-menu-container">

      </div>
    </div>
  </body>
</html>
