<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/api.js"></script>
	<link rel="stylesheet" href="../css/api.css">
</head>
<body>
	<section>
		<div class="productInfo">
			<h2>基本情報</h2>
			<dl>
				<dt>商品番号</dt>
				<dd>
					<input type="text" name="" value="<?php echo $standard->item_code ?>">
				</dd>
			</dl>
			<dl>
				<dt>商品名</dt>
				<dd>
					<input type="text" name="" value="<?php echo $standard->basic->item_name ?>">
				</dd>
			</dl>
			<dl>
				<dt>消費税設定</dt>
				<dd>
					<?php $tax = $standard->basic->consumption_tax_setting; ?>
					<?php if($tax == "Standard"){  ?>
						<input type="radio" name="NonTaxFlag" value="0" checked>
						<label for="">標準</label>
						<input type="radio" name="NonTaxFlag" value="1" >
						<label for="">非課税</label>
					<?php }else{ ?>
						<input type="radio" name="NonTaxFlag" value="0" >
						<label for="">標準</label>
						<input type="radio" name="NonTaxFlag" value="1" checked>
						<label for="">非課税</label>
					<?php } ?>
				</dd>
			</dl>
			<dl>
				<dt>販売価格</dt>
				<dd>
					<span><?php echo $standard->basic->item_price?></span>
				</dd>
			</dl>
			<dl>
				<dt>商品カテゴリ</dt>
				<dd>
					<select class="" name="multiCategoryNo" size="5" style="overflow-y:hidden">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
					<select name="multiCategory" size="5" style="width:400px">
					<?php for($i=0; $i<count($category); $i++){ ?>
						<option name="category" value=<?php echo $i+1; ?>>
						<?php for($j=0; $j<count($category[$i]->category_names); $j++){ ?>
							<?php echo $category[$i]->category_names[$j] ?>
						<?php } ?>
						</option>
					<?php } ?>
					</select>
				</dd>
			</dl>
		</div>
		<div class="productInfo">
			<h2>商品ページ情報</h2>
			<dl>
				<dt>商品紹介文</dt>
				<dd>
					<textarea name="description" rows="8" cols="80">
						<?php echo $discription->main_description ?>
					</textarea>
				</dd>
			</dl>
		</div>
		<div class="productInfo">
			<h2>集客対策情報</h2>
			<div class="SEO">
				<h4>SEO設定</h4>
				<dl>
					<dt>外部用キャッチコピー</dt>
					<dd>
						<textarea name="PageDescription" rows="8" cols="80">
							<?php echo $SEO->sales_copy ?>
						</textarea>
					</dd>
				</dl>
			</div>
			<div class="AD">
				<h4>外部連携用データ（Googleショッピング広告、Criteo広告など）</h4s>
				<dl>
					<dt>ショップサーブカテゴリ</dt>
					<dd>
						<input type="radio" >
						<span><?php echo $shopserveAD[0] ?></span>
					</dd>
				</dl>
			</div>
		</div>
	</section>
</body>
</html>
