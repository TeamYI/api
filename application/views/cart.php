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
            <a href="productList"><li>SHOP</li></a>
            <a href=""><li>MAGAZINE</li></a>
            <a href=""><li>EVENT</li></a>
            <a href=""><li>NOTICE</li></a>
          </ul>
        </div>
      </header>
      <section id="section-main">
          <div id="buy-head">
            <h2>ショッピングカート</h2>
            <form id="CartForm" class="" action="" method="post" >
              <div id="buy-product-wrap">
                <div class="buy-head-title">注文商品</div>
                <table>
                    <colgroup>
                      <col width="80px">
                      <col width="100px">
                      <col>
                      <col width="214px">
                      <col width="126px">
                      <col width="235px">
                    </colgroup>
                    <thead>
                      <tr>
                        <th>選択</th>
                        <th>商品情報</th>
                        <th>&nbsp;</th>
                        <th>販売金額</th>
                        <th>数</th>
                        <th>配送料</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($_SESSION["user_id"] )){

                              foreach ($list as $list) {?>
                                <tr>
                                  <td>
                                    <input type="checkbox" name="cartCode[]" value="<?php echo $list->cart_code; ?>" onclick="checkedSum()" checked>
                                    <input type="hidden" name="<?php echo $list->sum_price ?>" valeu="" >
                                  </td>
                                  <td>
                                    <img src="./img/<?php echo $list->product_img; ?>" class="buy-product-img" alt="">
                                  </td>
                                  <td>
                                    <div>カロンカロン</div>
                                    <div><?php echo $list->product_name; ?></div>
                                  </td>
                                  <td>
                                    <span><?php echo $list->sum_price ?></span>
                                  </td>
                                  <td>
                                    <span><?php echo $list->product_amount ?></span>
                                  </td>
                                  <td>
                                  <?php
                                      $sum = $list->sum_price ;
                                      if($sum < 2000){ ?>
                                            <span>250</span>
                                  <?php }else{ ?>
                                            <span>0</span>
                                  <?php } ?>
                                  </td>
                                </tr>
                              <?php }
                            }else{
                              foreach ($this->cart->contents() as $list) {

                                ?>

                                <tr>
                                  <td>
                                    <input type="checkbox" name="cartCode[]" value="<?php echo $list["rowid"]; ?>" onclick="checkedSum()" checked>
                                    <input type="hidden" name="<?php echo $list["sum_price"]; ?>" valeu="" >
                                  </td>
                                  <td>
                                    <img src="./img/<?php echo $list["product_img"]; ?>" class="buy-product-img" alt="">
                                  </td>
                                  <td>
                                    <div>カロンカロン</div>
                                    <div><?php echo $list["name"]; ?></div>
                                  </td>
                                  <td>
                                    <span><?php echo $list["sum_price"]; ?></span>
                                  </td>
                                  <td>
                                    <span><?php echo $list["qty"]; ?></span>
                                  </td>
                                  <td>
                                  <?php
                                      $sum = $list["price"] ;
                                      if($sum < 2000){ ?>
                                            <span>250</span>
                                  <?php }else{ ?>
                                            <span>0</span>
                                  <?php } ?>
                                  </td>
                                </tr>
                            <?php }
                            }?>
                    </tbody>
                  </table>
              </div>
              <div id="buy-total-wrap">
                <div class="default-pay buy-pay">
                    <span>注文商品金額</span>
                    <span>0</span>
                    <img src="./img/plus.png" alt="">
                </div>
                <div class="delivery-pay buy-pay">
                    <span>配送料</span>
                    <span>0</span>
                    <img src="./img/equal.png" alt="">
                </div>
                <div class="total buy-pay">
                    <span>総注文金額</span>
                    <span>0</span>
                </div>
              </div>
              <div id="cart-btn-wrap">
                <button class="cart-btn" onclick="CartProductRemove()">選択した商品削除</button>
                <button  class="cart-btn" onclick="CartProductBuy()">選択した商品購入</button>
              </div>
            </form>
          </div>
      </section>
      <footer id="footer">

      </footer>
      <div id="nav-menu-container">

      </div>
    </div>
  </body>
</html>
