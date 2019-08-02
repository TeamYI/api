<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="./js/api.js"></script>
	<script type="text/javascript" src="./js/encoding.js"></script>
	<script type="text/javascript" src="./js/valid.js"></script>
	<link rel="stylesheet" href="./css/api.css">
</head>

<body>
  <form class="" action="/api/productStockSet" method="post" onsubmit="return validStockCheck();">
			<div class="productSucess">
        <div class="StockNotice">
          <p>在庫数と在庫わずかを0～9999で入力してください。</p>
          <p>在庫数が在庫わずかの個数以下になると、店長アドレス宛てに在庫わずかのお知らせメールが届きます。</p>
          <p>在庫数を小文字の「z」、在庫わずかを空欄にすると在庫が無制限となり、在庫切れになりません。</p>
        </div>
				<h2>在庫数変更</h2>

				<dl>
					<dt>
						<span>商品番号</span>
					</dt>
					<dd>
						<span><?php echo $product_code ?></span>
            <input type="hidden" name="product_code" value="<?php echo $product_code ?>">
						<input type="hidden" name="type" value="<?php echo $stock->management_type ?>">
					</dd>
				</dl>
				<?php if($stock->management_type == "Item"){  ?>
				<dl>
					<dt>
						<span>在庫数</span>
					</dt>
          <dd>
						<span>
              <?php if($stock->management_item->quantity == 99999999){ ?>
							<input class="valid" type="text" name="quantity" value="z">
              <?php }else{ ?>
  						<input class="valid" type="text" name="quantity" value="<?php echo $stock->management_item->quantity ?>">
              <?php } ?>
						</span>
					</dd>
				</dl>
        <dl>
					<dt>
						<span>在庫わずか</span>
					</dt>
          <dd>
						<span>
							<input class="valid" type="text" name="alert_threshold" value="<?php echo $stock->management_item->alert_threshold ?>">
						</span>
					</dd>
				</dl>
				<?php }else{ ?>
				<table>
					<thead>
						<tr>
							<?php for($i=0; $i<count($stock->management_variation->patterns[0]->pattern); $i++){ ?>
								<th>variation<?php echo $i+1 ?></th>
							<?php } ?>
							<th>在庫数</th>
							<th>在庫わずか</th>
						<tr>
					</thead>
					<tbody>
						<?php foreach($stock->management_variation->patterns as $stock){ ?>
							<tr>
								<?php for( $i=0; $i<count($stock->pattern); $i++){ ?>
									<td>
										<?php echo $stock->pattern[$i];?>
										<input type="hidden"  name="variation<?php echo $i+1 ?>[]" value="<?php echo $stock->pattern[$i];?>">
									</td>
								<?php } ?>
								<td>
									<?php if($stock->quantity == 99999999){ ?>
										<input type="text" class="quantity valid" name="quantity[]" value="z">
									<?php }else{ ?>
										<input type="text" class="quantity valid" name="quantity[]" value="<?php echo $stock->quantity ?>">
									<?php } ?>
								</td>
								<td><input type="text" class="alert_threshold valid" name="alert_threshold[]" value="<?php echo $stock->alert_threshold ?>"></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } ?>
				<div class="footer-button">
					<button name="button"onclick="">変更</button>
					<button type="button" name="button" onclick="windowClose()">Close</button>
				</div>
			</div>
  </form>
</body>

</html>

