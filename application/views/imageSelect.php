<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="./js/api.js"></script>
	<link rel="stylesheet" href="./css/api.css">
</head>
<body>
	<div class="imageSelect">
		<div class="">
			<h2>画像台帳から挿入</h2>
		</div>
		<div class="">
			<table>
				<colgroup>
					<col width="200px">
					<col width="150px">
					<col width="150px">
				</colgroup>
				<thead>
					<tr>
						<th>画像</th>
						<th>ファイル名</th>
						<th>挿入</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($images->images as $image) {   ;?>
					<tr>
						<td>
							<img src="http://eat595.sg.shopserve.jp/pic-labo/timg/<?php echo $image->image_name ?>" name="<?php echo $image->image_name ?>" alt="">
						</td>
						<td>
							<span><?php echo $image->image_name ?></span>
						</td>
						<td>
							<button type="button" name="button" onclick="ProductImageSelectWindowClose('<?php echo $image->image_name ?>','<?php echo $role ?>')">挿入する</button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>
