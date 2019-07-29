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
	<section>
		<form class="" action="/api/productRegister" method="post" onsubmit="return validCheck();">
			<div class="productInfo">
				<h2>基本情報</h2>
				<dl>
					<dt>
						<span>商品番号</span>
						<span class="redStar">*</span>
					</dt>
					<dd>
						<input type="text" class="valid" name="product_code" value="" onkeyup="CharByteCheck(this)" inputmode="url">
						<div>
							<div class="checkbyte">(
								<span>0</span>
								<span>/</span>
								<span>64</span>
								)byte</div>
							<div>※半角英数字「-（ハイフン）」、「_（アンダーバー）」64文字以内</div>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>
						<span>商品名</span>
						<span class="redStar">*</span>
					</dt>
					<dd>
						<input type="text" class="valid" name="product_name" value="" onkeyup="CharByteCheck(this)" inputmode="url">
						<div>
							<div class="checkbyte">(
								<span>0</span>
								<span>/</span>
								<span>255</span>
								)byte</div>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>消費税設定</dt>
					<dd>
						<input type="radio" name="NonTaxFlag" value="Standard" checked>
						<label for="">標準</label>
						<input type="radio" name="NonTaxFlag" value="TaxExempt">
						<label for="">非課税</label>
					</dd>
				</dl>
				<dl>
					<dt>
						<span>販売価格</span>
						<span class="redStar">*</span>
					</dt>
					<dd>
						<input type="text" class="valid" name="product_price" value="" inputmode="url"><span>円</span>
						<p>
							※半角8文字以内／半角カンマ（,）半角ピリオド（.）不要
						</p>
					</dd>
				</dl>
				<dl>
					<dt>単位</dt>
					<dd>
						<input type="text" class="valid" name="product_unit" value="個" inputmode="url" onkeyup="CharByteCheck(this)">
						<div>
							<div class="checkbyte">(
								<span>2</span>
								<span>/</span>
								<span>32</span>
								)byte</div>
							<div>例：「個」「枚」「本」「セット」など</div>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>
						<span>商品カテゴリ</span>
						<span class="redStar">*</span>
					</dt>
					<dd>
						<div id="categorySet">
							<button type="button" name="button" onclick="CategorySelect()">登録</button>
							<button type="button" name="button" onclick="CategoryDelete()">削除</button>
						</div>
						<div id="categorySelectWrap">
							<select class="" name="multiCategoryNo" size="5" style="overflow-y:hidden">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
							<select id="multiCategory" name="multiCategory[]" multiple="multiple" size="5" style="width:400px;height:85px">
							</select>
						</div>
					</dd>
				</dl>
			</div>
			<div class="productInfo">
				<h2>販売情報</h2>
				<dl>
					<dt>配送方法</dt>
					<dd>
						<input type="radio" name="delivery_type" value="Standard" checked onclick="deliveryType('Standard')">
						<label for="">通常販売</label>
						<input type="radio" name="delivery_type" value="Mail" onclick="deliveryType('Mail')">
						<label for="">メール便</label>
					</dd>
				</dl>
				<div id="deliveryStandardSetWrap">
					<dl>
						<dt>通常販売詳しい設定</dt>
						<dd>
							<div id="deliveryStandardSet">
								<div class="">
									<label for="">発送準備期間</label>
									<input type="text" class="valid" name="deliveryPreparation" value="0" inputmode="url">
									<span>日</span>
								</div>
								<div class="">
									<div class="">
										<input type="checkbox" name="temperature_controlled" value="Cold" onclick="DisableTempSet(this)">
										<label for="">冷蔵便</label>
									</div>
									<div class="">
										<input type="checkbox" name="temperature_controlled" value="Freeze" onclick="DisableTempSet(this)">
										<label for="">冷凍便</label>
									</div>
								</div>
								<div>
									<input type="checkbox" name="enable_specific_delivery" value="No" onclick="enableSpecificDelivery(this)">
									<label for="">個別に送料を設定</label>
								</div>
								<div id="specificDeliverySetWrap">
									<label for="">個別送料</label>
									<input type="text" name="specific_delivery_charge" value="0" inputmode="url"><span>円</span>
									<div class="">
										<input type="checkbox" name="display_type" value="Zero" onclick="FreeDeliveryDisplaySelect(this)">
										<label for="">0円の場合はカートに「送料無料」と表示する</label>
									</div>
									<div class="">
										<input type="checkbox" name="prior" value="No" onclick="priorSelect(this)">
										<label for="">この送料を優先する</label>
									</div>
								</div>
							</div>
						</dd>
					</dl>
				</div>
			</div>
			<div class="productInfo productInfoDetail">
				<h2>商品ページ情報</h2>
				<dl>
					<dt>商品画像</dt>
					<dd>
						<input type="radio" name="imageSub" value="one" checked onclick="imageSubShow('one')">
						<label for="">複数画像登録を利用しない</label>
						<input type="radio" name="imageSub" value="sub" onclick="imageSubShow('sub')">
						<label for="">複数画像登録を利用する</label>
					</dd>
					<dd>
						<div class="">メイン画像（1つまで）</div>
						<div class="">
							<button type="button" name="button" onclick="ProductImageSelect('mainImage')">画像挿入</button>
							<button type="button" name="button" onclick="ProductImageRemove()">画像削除</button>
						</div>
						<div id="main-image" name="main-image" class="valid"></div>
					</dd>
					<dd id="imageSub">
						<div class="">サブ画像（9つまで）</div>
						<div class="">
							<button type="button" name="subImagebutton" onclick="ProductImageSelect('subImage')">画像挿入</button>
						</div>
						<div class="imageSubWrap">
							<div>
									<span>
										<li>画像</li>
										<li>位置</li>
										<li>削除</li>
									</span>
									<span code="1" class="sub first" id="mainSubImage">
										<li>

										</li>
										<li class="subArrow">
											<button type="button"  onclick="imageSubPositionFrontModify(this)" name="front">←</button>
											<button type="button" onclick="imageSubPositionBackModify(this)" name="back">→</button>
										</li>
										<li>
											<div>Main</div>
										</li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
							</div>
							<div class="">
									<span class="title">
										<li>画像</li>
										<li>位置</li>
										<li>削除</li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
									<span>
										<li></li>
										<li></li>
										<li></li>
									</span>
							</div>
						</div>
					</dd>
				</dl>
				<dl style="clear:both">
					<dt>
						<span>商品紹介文</span>
						<span class="redStar">*</span>
					</dt>
					<dd>
						<div>
							<button type="button" name="button" onclick="ProductIntroductionImageSelect(this)">画像挿入</button>
							<div class="">
								<textarea name="description" rows="8" cols="80" class="productDescription valid" inputmode="url" onkeyup="CharByteCheck(this)"></textarea>
								<div>
									<div class="checkbyte">(
										<span>0</span>
										<span>/</span>
										<span>65000</span>
										)byte</div>
								</div>
							</div>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>サブ紹介文1</dt>
					<dd>
						<div>
							<button type="button" name="button" onclick="ProductIntroductionImageSelect(this)">画像挿入</button>
							<div class="">
								<textarea name="description1" rows="8" cols="80" class="productDescription valid" inputmode="url" onkeyup="CharByteCheck(this)"></textarea>
								<div>
									<div class="checkbyte">(
										<span>0</span>
										<span>/</span>
										<span>65000</span>
										)byte</div>
								</div>
							</div>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>サブ紹介文2</dt>
					<dd>
						<div>
							<button type="button" name="button" onclick="ProductIntroductionImageSelect(this)">画像挿入</button>
							<div class="">
								<textarea name="description2" rows="8" cols="80" class="productDescription valid" inputmode="url" onkeyup="CharByteCheck(this)"></textarea>
								<div>
									<div class="checkbyte">(
										<span>0</span>
										<span>/</span>
										<span>65000</span>
										)byte</div>
								</div>
							</div>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>商品ページの公開</dt>
					<dd>
						<span>
							<input type="radio" name="pageDisplay" value="Yes">
							<label for="">公開する</label>
						</span>
						<span>
							<input type="radio" name="pageDisplay" value="No" checked>
							<label for="">公開しない</label>
						</span>
					</dd>
				</dl>
				<dl>
					<dt>ステータス</dt>
					<dd>
						<span>
							<input type="checkbox" name="new_arrival" value="No" onclick="CheckboxSelect(this)">
							<label for="">新着商品として登録</label>
						</span>
						<span>
							<input type="checkbox" name="recommended" value="No" onclick="CheckboxSelect(this)">
							<label for="">おすすめ商品として登録</label>
						</span>
					</dd>
				</dl>
				<dl>
					<dt>表示項目</dt>
					<dd>
						<span>
							<input type="checkbox" name="showCart" value="No" onclick="CheckboxSelect(this),StockDisabled(this)">
							<label for="">カートボタンエリア</label>
						</span>
						<span>
							<input type="checkbox" name="showStock" value="No" onclick="CheckboxSelect(this)" disabled>
							<label for="">在庫をみるボタン</label>
						</span>
						<span>
							<input type="checkbox" name="showCustomer" value="No" onclick="CheckboxSelect(this)">
							<label for="">お客様の声</label>
						</span>
						<span>
							<input type="checkbox" name="showInquire" value="No" onclick="CheckboxSelect(this)">
							<label for="">問い合わせフォーム</label>
						</span>
						<span>
							<input type="checkbox" name="showShare" value="No" onclick="CheckboxSelect(this)">
							<label for="">友だちに教える</label>
						</span>
						<span>
							<input type="checkbox" name="showQR" value="No" onclick="CheckboxSelect(this)">
							<label for="">QRコード</label>
						</span>
					</dd>
				</dl>
			</div>
			<div class="productInfo seo-wrap">
				<h2>集客対策情報</h2>
				<div class="SEO">
					<h4>SEO設定</h4>
					<dl>
						<dt>商品ページタイトル</dt>
						<dd>
							<div class="">
								<input type="text" name="SEOTitle" class="valid" value="" onkeyup="CharByteCheck(this)">
								<div>
									<div class="checkbyte">(
										<span>0</span>
										<span>/</span>
										<span>255</span>
										)byte</div>
								</div>
							</div>
						</dd>
					</dl>
					<dl>
						<dt>商品ページキーワード</dt>
						<dd>
							<div class="">
								<input type="text" name="SEOKeyword" class="valid" value="" onkeyup="CharCheck(this)">
								<div>
									<div class="checkbyte">(
										<span>0</span>
										<span>/</span>
										<span>255</span>
										)文字</div>
									<div>※全角255文字以内／半角カンマ（,）区切りで入力</div>
								</div>
							</div>
						</dd>
					</dl>
					<dl>
						<dt>
							<span>外部用キャッチコピー</span>
							<span class="redStar">*</span>
						</dt>
						<dd>
							<div class="">
								<textarea name="SEOCatchCopy" class="valid" rows="8" cols="80" onkeyup="CharByteCheck(this)"></textarea>
								<div>
									<div class="checkbyte">(
										<span>0</span>
										<span>/</span>
										<span>10000</span>
										)byte</div>
								</div>
							</div>
						</dd>
					</dl>
				</div>

			</div>
			<button name="registerButton">登録</button>
		</form>
	</section>
</body>

</html>
