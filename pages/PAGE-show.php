<?php
// (A) EXTRACT ID
$_PATH = explode("/", rtrim($_PATH, "/"));
$valid = count($_PATH) == 2;
if ($valid) { $valid = is_numeric($_PATH[1]); }

// (B) GET CLASSIFIED
if ($valid) {
  $_CORE->load("Classified");
  $ad = $_CORE->Classified->get($_PATH[1]);
  $valid = is_array($ad);
}

// (C) OUTPUT HTML
if (!$valid) { require PATH_PAGES . "PAGE-404.php"; exit(); }
$_PMETA = [
  "title" => $ad["cla_title"],
  "desc" => $ad["cla_summary"],
  "load" => [
  ["l", HOST_ASSETS."PAGE-classified.css"],
  ["s", HOST_ASSETS."PAGE-show.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (C1) TITLE & DATE -->
<div class="d-flex">
  <div class="display-6 flex-grow-1"><?=$ad["cla_title"]?></div>
  <button id="ad-share" class="btn btn-primary mi me-1 d-none" onclick="show.share()">share</button>
  <button class="btn btn-primary mi me-1" onclick="show.pdf()">download</button>
  <button class="btn btn-primary mi" onclick="show.print()">print</button>
</div>
<div class="text-secondary">
  <small>Posted on: <?=$ad["cd"]?></small>
</div>
<?php if (isset($ad["ed"])) { ?>
<div class="text-secondary">
  <small>Ending on: <?=$ad["ed"]?></small>
</div>
<?php } ?>

<div class="bg-white border p-4 my-4">
  <!-- (C2) DETAILS -->
  <h5 class="text-danger pb-2 border-bottom">Details</h5>
  <div><?=$ad["cla_text"]?></div>

  <!-- (C3) CONTACT PERSON -->
  <h5 class="mt-5 text-danger pb-2 border-bottom">Contact Person</h5>
  <div>Name: <?=$ad["cla_person"]?></div>
  <?php if ($ad["cla_email"]) { ?>
  <div>Email: <a href="mailto:<?=$ad["cla_email"]?>"><?=$ad["cla_email"]?></a></div>
  <?php } if ($ad["cla_tel"]) { ?>
  <div>Tel: <a href="tel:<?=$ad["cla_tel"]?>"><?=$ad["cla_tel"]?></a></div>
  <?php } ?>

  <!-- (C4) IMAGES -->
  <?php if (is_array($ad["images"])) { ?>
  <h5 class="mt-5 mb-4 text-danger pb-2 border-bottom">Images</h5>
  <div id="slide-control" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php $first = true; foreach ($ad["images"] as $img) { ?>
      <div class="carousel-item<?=$first?" active":""?>">
        <img src="<?=HOST_UPLOADS . $img["img_file"]?>" class="caroimg">
      </div>
      <?php $first = false; } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slide-control" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slide-control" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <?php } ?>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>