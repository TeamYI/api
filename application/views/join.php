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
            <li><a href="login">My Account</a></li>
            <li><a href="cart">Cart</a></li>
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
        <div id="join-form">
          <div id="join-top">
            <span>新規会員登録</span>
          </div>
          <div id="join-content">
            <form class="" action="/shop/userJoin" method="post" onsubmit="return userJoinCheck()">
              <div>
                <label for="id">ID</label>
                <input type="text" name="id">
                <button type="button" onclick="CheckId(this)">重複確認</button>
                <p></p>
              </div>
              <br>
              <div>
                <label for="pw">パスワード</label>
                <input type="password" name="pw">
              </div>
              <br>
              <div>
                <label for="rpw">確認のためもう一度入力</label>
                <input type="password" name="rpw" onkeyup='passwordCheck()'>
                <p></p>
              </div>
              <br>
              <div>
                <label for="email">メールアドレス</label>
                <input type="text" name="email">
              </div>
              <br>
              <div>
                <label for="name">お名前</label>
                <input type="text" name="name" >
              </div>
              <br>
              <div>
                <label for="post">郵便番号</label>
                <input type="text" name="post" >
              </div>
              <br>
              <div>
                <label for="area">都道府県</label>
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
              </div>
              <br>
              <div>
                <label for="city">市区郡</label>
                <input type="text" name="city" >
              </div>
              <br>
              <div>
                <label>町村字番地</label>
                <div id="join-address" >
                    <div>
                      <div>町村字</div>
                      <input type="text" name="addr1" id="buy-addr1" >
                    </div>
                    <div>
                      <div>番地</div>
                      <input type="text" name="addr2" >
                    </div>
                  </div>
              </div>
              <br>
              <div>
                <label for="addr3">建物名（部屋番号）</label>
                <input type="text" name="addr3" >
              </div>
              <br>
              <div>
                <label for="tel">お電話番号</label>
                <input type="text" name="tel" >
              </div>
              <br>
              <input type="submit" value="JOIN" onclick="userJoin()">
            </form>
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
