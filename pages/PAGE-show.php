<?php
// (A) GET CLASSIFIED & OUTPUT HTML
$_CORE->load("Classified");
$ad = $_CORE->Classified->get($_GET["id"]);
require PATH_PAGES . "TEMPLATE-top.php";

// (B) ERROR
if (!is_array($ad)) { ?>
<h1 class="text-danger">ERROR</h1>
<p>Invalid listing</p>

<?php
// (C) DISPLAY LISTING
} else { ?>
<div class="bg-white border p-4 mb-4">
  <!-- (C1) TITLE & DATE -->
  <h1><?=$ad["cla_title"]?></h1>
  <div>Posted on: <?=$ad["cla_date"]?></div>

  <!-- (C2) DETAILS -->
  <h4 class="mt-5">Details</h4>
  <div><?=$ad["cla_text"]?></div>

  <!-- (C3) CONTACT PERSON -->
  <h4 class="mt-5">Contact Person</h4>
  <div>Name: <?=$ad["cla_person"]?></div>
  <div>Email: <?=$ad["cla_email"]?></div>
  <div>Tel: <?=$ad["cla_tel"]?></div>

  <!-- (C4) IMAGES -->
  <?php if (is_array($ad["images"])) { ?>
  <h4 class="mt-5">Images</h4>
  <div id="carouselExampleControls" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php $first = true; foreach ($ad["images"] as $img) { ?>
      <div class="carousel-item<?=$first?" active":""?>">
        <img src="<?=HOST_UPLOADS . $img["img_file"]?>" class="d-block w-100">
      </div>
      <?php $first = false; } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <?php }} ?>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
