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
					<a href="productList">
						<li>SHOP</li>
					</a>
					<a href="">
						<li>MAGAZINE</li>
					</a>
					<a href="">
						<li>EVENT</li>
					</a>
					<a href="">
						<li>NOTICE</li>
					</a>
				</ul>
			</div>
		</header>
		<section id="section-main">
			<div id="wrap-nouserBuyhis">
				<h2><?php echo $user."様 " ?> 非会員購入履歴</h2>
				<hr>
				<div id="nouser-buy-wrap">
					<table>
					<colgroup>
						<col width="150px">
						<col width="100px">
						<col>
						<col width="214px">
						<col width="126px">
					</colgroup>
					<thead>
						<tr>
							<th>注文番号</th>
							<th>商品写真</th>
							<th>&nbsp;</th>
							<th>金額</th>
							<th>注文日時</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($list as $list){ ?>
						<tr>
							<td>
								<a href="buyHistoryDetail/<?php echo $list["buy_code"] ?>" class="buy-code">
									<?php echo $list["buy_code"] ?>
								</a>
							</td>
							<td>
								<img src="./img/<?php echo $list["product_img"] ?>" class="" alt="">
							</td>
							<td>
								<div class="nouser-buy-name1">カロンカロン</div>
								<div>
									<?php
												if($list["count"]>1){
														echo $list["product_name"]."及び".((integer)$list["count"]-1) ;
												}else{
														echo $list["product_name"] ;
												}
									?></div>
							</td>
							<td>
								<span>
									<?php if($list["buy_price"] < 2000){
														echo $list["buy_price"]+250 ;
											  }else{
														echo $list["buy_price"];
												}
								 	?></span>
							</td>
							<td>
								<span><?php echo $list["buy_date"] ?></span>
							</td>
						</tr>
						<?php } ?>
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
