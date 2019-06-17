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
            <li><a href="cart">Cart</a></li>
            <li><a href="">My page</a></li>
            <li>
            <?php
              if(isset($_SESSION["user_id"])){
            ?><a href="logout">logout</a></li>
          <?php } ?>

          </ul>
        </div>
        <div id="header-search">
          <span id="search-dt">search</span>
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
          <div id="buy-product-wrap">
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
                  <th>配送料</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="./img/<?php echo $img ?>" class="buy-product-img" alt="">
                  </td>
                  <td>
                    <div>カロンカロン</div>
                    <div><?php echo $name ?></div>
                  </td>
                  <td>
                    <span><?php echo $price ?></span>
                  </td>
                  <td>
                    <span><?php echo $amount ?></span>
                  </td>
                  <td>
                    <span><?php echo $delivery ?></span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="buy-total-wrap">
            <div class="default-pay buy-pay">
                <span>注文商品金額</span>
                <span><?php echo $price ?></span>
                <img src="./img/plus.png" alt="">
            </div>
            <div class="delivery-pay buy-pay">
                <span>配送料</span>
                <span><?php echo $delivery ?></span>
                <img src="./img/equal.png" alt="">
            </div>
            <div class="total buy-pay">
                <span>総注文金額</span>
                <span><?php echo $sum ?></span>
            </div>
          </div>
        </div>
        <div id="buy-section">
          <div class="buy-head-title">注文商品</div>
            <form id="ProductBuy"  method="post">
              <input type="hidden" name="product_code" value="<?php echo $code ?>">
              <input type="hidden" name="sum_price" value="<?php echo $sum ?>">
              <input type="hidden" name="product_amount" value="<?php echo $amount ?>">
              <div id="buy-info">
                <dl>
                  <dt>お名前</dt>
                  <dd><input type="text" name="name" value="yun"></dd>
                  <dt>郵便番号</dt>
                  <dd><input type="text" name="post" value="0620904"></dd>
                  <dt>都道府県</dt>
                  <dd>
                    <select name="area" value="1">
                      <option value="1">愛知県</option>
                      <option value="2">青森県</option>
                      <option value="3">秋田県</option>
                      <option value="4">石川県</option>
                      <option value="5">茨城県</option>
                      <option value="6">岩手県</option>
                      <option value="7">愛媛県</option>
                      <option value="8">大分県</option>
                      <option value="9">大阪府</option>
                      <option value="10">岡山県</option>
                      <option value="11">香川県</option>
                      <option value="12">鹿児島県</option>
                      <option value="13">神奈川県</option>
                      <option value="14">岐阜県</option>
                      <option value="15">京都府</option>
                      <option value="16">熊本県</option>
                      <option value="17">群馬県</option>
                      <option value="18">高知県</option>
                      <option value="19">埼玉県</option>
                      <option value="20">佐賀県</option>
                      <option value="21">東京都</option>
                      <option value="22">徳島県</option>
                      <option value="23">栃木県</option>
                      <option value="24">鳥取県</option>
                      <option value="25">富山県</option>
                      <option value="26">長崎県</option>
                      <option value="27">長野県</option>
                      <option value="28">奈良県</option>
                      <option value="29">新潟県</option>
                      <option value="30">兵庫県</option>
                      <option value="31">広島県</option>
                      <option value="32">福井県</option>
                      <option value="33">福岡県</option>
                      <option value="34">福島県</option>
                      <option value="35">北海道</option>
                      <option value="36">三重県</option>
                      <option value="37">宮城県</option>
                      <option value="38">宮崎県</option>
                      <option value="39">山形県</option>
                      <option value="40">山口県</option>
                      <option value="41">山梨県</option>
                      <option value="42">和歌山県</option>
                    </select>
                  </dd>
                  <dt>市区郡</dt>
                  <dd><input type="text" name="city" value="toyohira"></dd>
                  <dt>町村字番地</dt>
                  <dd>
                    <div id="buy-address">
                      <div>
                        <div>町村字</div>
                        <input type="text" name="addr1" id="buy-addr1" value="aaaaa">
                      </div>
                      <div>
                        <div>番地</div>
                        <input type="text" name="addr2" value="bbbbb">
                      </div>
                    </div>
                  </dd>
                  <dt>建物名（部屋番号)</dt>
                  <dd><input type="text" name="addr3" id="buy-addr3" value="ccccc"></dd>
                  <dt>お電話番号</dt>
                  <dd><input type="text" name="tel" value="0107405"></dd>
                  <dt>メールアドレス</dt>
                  <dd><input type="text" name="email" value="valen7009@aaa.com"></dd>
                </dl>
              </div>
              <div id="pay-select-wrap">
                <div class="buy-head-title">お支払い方法選択</div>
                <dt><input type="radio" name="pay" value="1"></dt>
                <dd>銀行振込</dd>
              </div>
              <button onclick="ProductBuy()">購入する</button>
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
