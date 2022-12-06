<?php
// (A) GET IMAGES
$images = $_CORE->autoCall("Images", "getAll");
$pick = isset($_POST["pick"]);

// (B) LIST IMAGES
if (count($images)>0) { foreach ($images as $i) { ?>
<div class="col-lg-4 col-12 p-1"><div class="bg-dark border">
  <?php if ($pick) { ?>
  <a onclick="img.pick('<?=$i?>')">
  <?php } else { ?>
  <a href="<?=HOST_UPLOADS . $i?>" target="_blank">
  <?php } ?>
    <img loading="lazy" class="thumb" src="<?=HOST_UPLOADS . $i?>">
  </a>
  <div class="d-flex align-items-center p-3">
    <small class="flex-grow-1 text-white"><?=$i?></small>
    <?php if (!$pick) { ?>
    <button class="mx-1 btn btn-danger mi" onclick="img.del('<?=$i?>')">
      delete
    </button>
    <button class="btn btn-primary mi" onclick="img.copy('<?=$i?>')">
      link
    </button>
    <?php } ?>
  </div>
</div></div>
<?php }} else { echo "No images found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw("img.goToPage");