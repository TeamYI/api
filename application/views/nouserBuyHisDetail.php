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
					<a href="/shop/categoryList/0"><li>SHOP</li></a>
					<a href="#"><li>MAGAZINE</li></a>
					<a href="/shop/noticeList"><li>NOTICE</li></a>
				</ul>
			</div>
		</header>
		<section id="section-main">
			<div id="buyhis-wrap">
				<div id="buyhis-title">
					<h2>購入履歴 : <?php echo $address->buy_code; ?></h2>
					<div>
						<span>決済方法 : </span>
						<span><?php echo $address->payment_name; ?></span>
					</div>
					<div>
						<span>決済状態 : </span>
					<?php if(($address->payment_check)=="X"){  ?>
						<span style="background:red ;">未入金</span>
					<?php }else{ ?>
						<span style="background:green;" >入金完了</span>
					<?php } ?>
					</div>
					<div>
					<?php if(($address->success)=="O"){  ?>
						<h3>購入完了</h3>
					<?php } ?>
					</div>
				</div>
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
							<th>総金額</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i=0; $i<count($product) ; $i++){ $count=0;  ?>
						<tr>
							<td>
								<img src="../img/<?php echo $product[$i]["product_img"] ?>" class="buy-product-img" alt="">
							</td>
							<td>
								<div>カロンカロン</div>
								<div><?php echo $product[$i]["product_name"]; ?></div>
								<?php if($review){ ?>
								<?php for($j=0; $j<count($review) ; $j++) {  ?>
								<?php if($product[$i]["product_code"] == ($review[$j]["product_code"])){ $count++;}?>
								<?php } ?>
								<?php if($count == 0){ ?>
									<?php if(($address->success)=="O"){ ?>
										<div>
											<button type="button" name="button" class="button" onclick="reviewWindow('<?php echo $product[$i]["product_name"] ?>','<?php echo $product[$i]["product_code"] ?>','<?php echo $address->buy_code ?>')">review作成</button>
										<div>
									<?php } ?>
								<?php } ?>
							<?php }else{  ?>
								<?php if(($address->success)=="O"){ ?>
									<div>
										<button type="button" name="button" class="button" onclick="reviewWindow('<?php echo $product[$i]["product_name"] ?>','<?php echo $product[$i]["product_code"] ?>','<?php echo $address->buy_code ?>')">review作成</button>
									<div>
								<?php } ?>
							<?php } ?>
							</td>
							<td>
								<span><?php echo $product[$i]["product_price"] ?></span>
							</td>
							<td>
								<span><?php echo $product[$i]["product_amount"] ?></span>
							</td>
							<td>
								<span><?php echo $product[$i]["sum_price"] ?></span>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<div id="buyhis-total-wrap">
					<div class="default-pay buy-pay">
							<span>注文商品金額</span>
							<span><?php echo $pay["buy_pay"] ?></span>
							<img src="../img/plus.png" alt="">
					</div>
					<div class="delivery-pay buy-pay">
							<span>配送料</span>
							<span><?php echo $pay["delivery_pay"] ?></span>
							<img src="../img/equal.png" alt="">
					</div>
					<div class="total buy-pay">
							<span>総注文金額</span>
							<span><?php echo $pay["sum_pay"] ?></span>
					</div>
				</div>
				<div id="buy-section">
					<div class="buy-head-title">注文商品</div>
					<div id="buy-info">
					<dl>
						<dt>お名前</dt>
						<dd>
							<span><?php echo $address->user_name ?></span>
						</dd>
						<dt>郵便番号</dt>
						<dd>
							<span><?php echo $address->postcode ?></span>
						</dd>
						<dt>都道府県</dt>
						<dd>
							<span><?php echo $address->area_name ?></span>
						</dd>
						<dt>市区郡</dt>
						<dd>
							<span><?php echo $address->city ?></span>
						</dd>
						<dt>町村字番地</dt>
						<dd>
							<div id="buyhis-address">
								<div>
									<div>町村字</div>
									<span><?php echo $address->address1 ?></span>
								</div>
								<div>
									<div>番地</div>
									<span><?php echo $address->address2 ?></span>
								</div>
							</div>
						</dd>
						<dt>建物名（部屋番号)</dt>
						<dd>
							<span><?php echo $address->address3 ?>  </span>
						</dd>
						<dt>お電話番号</dt>
						<dd>
							<span><?php echo $address->hp ?></span>
						</dd>
						<dt>メールアドレス</dt>
						<dd>
							<span><?php echo $address->email ?></span>
						</dd>
					</dl>
				</div>
				<?php if(($address->success)==null && ($address->payment_check)=="O"){  ?>
					<div>
						<button type="button" name="button" onclick="nouserbuySuccess('<?php echo $address->buy_code ?>', '<?php echo $address->user_name ?>', '<?php echo $address->email ?>')">購入確定</button>
					<div>
				<?php } ?>
			</div>

		</section>
		<footer id="footer">

		</footer>
		<div id="nav-menu-container">

		</div>
	</div>
</body>

</html>
