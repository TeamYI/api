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
          <a href="" id="logo" title="main page 移動します。">
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
        <div id="login-form">
          <div id="login-top">
            <span>LOGIN</span>
          </div>
          <div id="login-content">
            <form class="" action="userlogin" method="post">
              <label for="user_id">ID</label>
              <input type="text" name="user_id">
              <br>
              <label for="user_pw">パスワード</label>
              <input type="password" name="user_pw">
              <br>
              <input type="button" onclick="loginCheck(this)" value="LOGIN">
            </form>
            <div id="login-error">
              <p>ID・PWが間違います。</p>
            </div>
            <a href="join" id="join-move">
              <div>
                <p>新規会員登録</p>
              </div>
            </a>
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
