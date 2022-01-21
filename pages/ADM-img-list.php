<?php
// (A) GET IMAGES
$images = $_CORE->autoCall("Images", "getAll");

// (B) PICKER MODE
$pick = isset($_POST["pick"]);
if ($pick) { ?>
<div class="d-flex mb-3">
  <h3 class="flex-grow-1">CHOOSE AN IMAGE</h3>
  <button class="btn btn-danger mi" onclick="cb.page(2)">
    reply
  </button>
</div>
<?php }

// (B) LIST IMAGES
if (count($images["data"])>0) { foreach ($images["data"] as $i) { ?>
  <div class="col-lg-4 col-6 p-2">
    <?php if (!$pick) { ?>
    <a href="<?=HOST_UPLOADS . $i?>" target="_blank">
    <?php } ?>
    <img loading="lazy" src="<?=HOST_UPLOADS . $i?>" <?=$pick?"onclick=\"img.pick('$i')\"":""?>/>
    <?php if (!$pick) { ?>
    </a>
    <?php } ?>
    <?php if (!$pick) { ?>
    <div class="btn-group mt-2" role="group">
      <button class="btn btn-danger mi" onclick="img.del('<?=$i?>')">
        delete
      </button>
      <button class="btn btn-primary mi" onclick="img.copy('<?=$i?>')">
        link
      </button>
    </div>
    <?php } ?>
  </div>
<?php }} else { echo "No images found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($images["page"], "img.goToPage");
