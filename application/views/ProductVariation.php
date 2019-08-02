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
  <form class="" action="/api/productVariationSet" method="post" onsubmit="return validVariationCheck();">
			<div class="productVariation">
				<h2>バリエーション設定</h2>
				<dl>
					<dt>
						<span>商品番号</span>
					</dt>
					<dd>
						<span><?php echo $product_code ?></span>
            <input type="hidden" name="product_code" value="<?php echo $product_code ?>">
					</dd>
				</dl>
				<div class="">

					<?php if( $variation != "" && $variation->title1 != ""  ){  ?>
					<div class="variation">
						<div class="variationTitle">
							<div>項目名</div>
							<div><input type="text" class="titleCheck"  name="title1" value="<?php echo $variation->title1 ?>"></div>
						</div>
						<div class="selectName">
							<div>選択肢</div>
							<div class="">
								<input type="text"   name="" value="">
								<button type="button" name="button"  onclick="variationOptionAdd(this,'One')">追加</button>
							</div>
						</div>
						<div class="">
							<select class="selectOne" name="one[]"  multiple="multiple">
								<?php foreach($variation->choices1 as $choice){ ?>
									<option value="<?php echo $choice ?>"><?php echo $choice ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<?php }else{ ?>
						<div class="variation">
							<div class="variationTitle">
								<div>項目名</div>
								<div><input type="text" class="titleCheck"  name="title1" value=""></div>
							</div>
							<div class="selectName">
								<div>選択肢</div>
								<div class="">
									<input type="text"   name="" value="">
									<button type="button" name="button"  onclick="variationOptionAdd(this,'One')">追加</button>
								</div>
							</div>
							<div class="">
								<select class="selectOne" name="one[]"  multiple="multiple">
								</select>
							</div>
						</div>
					<?php } ?>
					<?php if(  $variation != "" && $variation->title2 != ""){ ?>
					<div class="variation">
						<div class="variationTitle">
							<div>項目名</div>
							<div><input class="titleCheck" type="text"  name="title2" value="<?php echo $variation->title2 ?>"></div>
						</div>
						<div class="selectName">
							<div>選択肢</div>
							<div class="">
								<input type="text" name="" value="">
								<button type="button" name="button" onclick="variationOptionAdd(this,'Two')">追加</button>
							</div>
						</div>
						<div class="">
							<select class="selectTwo" name="two[]" multiple>
								<?php foreach($variation->choices2 as $choice){ ?>
									<option value="<?php echo $choice ?>"><?php echo $choice ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php }else{ ?>
					<div class="variation">
						<div class="variationTitle">
							<div>項目名</div>
							<div><input type="text" class="titleCheck"  name="title2" value=""></div>
						</div>
						<div class="selectName">
							<div>選択肢</div>
							<div class="">
								<input type="text"   name="" value="">
								<button type="button" name="button"  onclick="variationOptionAdd(this,'Two')">追加</button>
							</div>
						</div>
						<div class="">
							<select class="selectTwo" name="two[]"  multiple="multiple">
							</select>
						</div>
					</div>
				<?php } ?>
					<?php if( $variation != "" && $variation->title3 != "" ){ ?>
					<div class="variation">
						<div class="variationTitle">
							<div>項目名</div>
							<div><input  class=" titleCheck" type="text"  name="title3" value="<?php echo $variation->title3 ?>"></div>
						</div>
						<div class="selectName">
							<div>選択肢</div>
							<div class="">
								<input type="text" name="" value="">
								<button type="button" name="button" onclick="variationOptionAdd(this,'Three')">追加</button>
							</div>
						</div>
						<div class="">
							<select class="selectThree" name="three[]" multiple>
								<?php foreach($variation->choices3 as $choice){ ?>
									<option value="<?php echo $choice ?>"><?php echo $choice ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php }else{ ?>
					<div class="variation">
						<div class="variationTitle">
							<div>項目名</div>
							<div><input type="text" class="titleCheck"  name="title3" value=""></div>
						</div>
						<div class="selectName">
							<div>選択肢</div>
							<div class="">
								<input type="text"   name="" value="">
								<button type="button" name="button"  onclick="variationOptionAdd(this,'Three')">追加</button>
							</div>
						</div>
						<div class="">
							<select class="selectThree" name="three[]"  multiple="multiple">
							</select>
						</div>
					</div>
				<?php } ?>
				</div>
				<dl>
					<dt>
						<span></span>
					</dt>
          <dd>
						<span>

						</span>
					</dd>
				</dl>

				<div class="footer-button">
					<button name="button"onclick="">変更</button>
					<button type="button" name="button" onclick="windowClose()">Close</button>
				</div>
			</div>
  </form>
</body>

</html>

