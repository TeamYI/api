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
  <div class="categorySelect">
    <div class="">
      <h3>商品カテゴリ一覧</h3>
    </div>
    <?php for($i=0; $i<count($result) ; $i++) { ?>
      <div>
        <input type="radio" name="category" value="<?php echo $i ?>" id="category<?php echo $i ?>">
        <label for="category<?php echo $i ?>">
      <?php for($j=0; $j<count($result[$i]) ;){ ?>
        <?php echo $result[$i][$j];$j++ ?>
        <?php if($j != count($result[$i])){  ?>
              <?php echo ">" ?>
        <?php } ?>
      <?php } ?>
        </label>
      </div>
    <?php } ?>
    <div id="categoryErrorSelect">
      <p>選択したカテゴリは既に登録されています。</p>
      <p>他のカテゴリを選択してください。</p>
    </div>
    <div id="categorySelectButton">
      <button type="button" name="button" onclick="CategorySelectWindowClose()">登録する</button>
      <button type="button" name="button" onclick="CategoryWindowClose()">CANCEL</button>
    </div>
  </div>
  </body>
</html>
