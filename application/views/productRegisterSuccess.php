<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/api.js"></script>
	<script type="text/javascript" src="../js/encoding.js"></script>
	<script type="text/javascript" src="../js/valid.js"></script>
	<link rel="stylesheet" href="../css/api.css">
</head>

<body>
			<div class="productSucess">
				<h2>商品登録を完了しました。</h2>
				<dl>
					<dt>
						<span>商品番号</span>
					</dt>
					<dd>
						<span><?php echo $product_code ?></span>
					</dd>
				</dl>
				<dl>
					<dt>
						<span>在庫数</span>
					</dt>
          <dd>
						<span>
							<span id="productStock">
								<?php if($stock->management_type == "Item"){ ?>
								<?php if($stock->management_item->quantity == 99999999){ ?>
								<?php echo "無制限" ?>
								<?php }else{ ?>
								<?php echo $stock->management_item->quantity ?>
								<?php } ?>
								<?php }else{ ?>
								<?php echo "バリエーションごと" ?>
								<?php } ?>
							</span>
							<button type="button" name="button" onclick="ProductStockSetWindow('<?php echo $product_code ?>')">在庫数変更</button>
						</span>
					</dd>
				</dl>
				<dl>
					<dt>
						<span>バリエーション</span>
					</dt>
          <dd>
						<span>
							<button type="button" name="button" onclick="ProductVariationWindow('<?php echo $product_code ?>')">バリエーションを設定</button>
						</span>
					</dd>
				</dl>
				<div class="footer-button">
					<button type="button" name="button" onclick="NewProductRegisterMove()">新規登録ページ</button>
					<button type="button" name="button" onclick="ProductListPageMove()">商品一覧ページ</button>
				</div>
			</div>
</body>

</html>

