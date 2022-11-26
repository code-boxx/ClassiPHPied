<?php
// (A) LOAD AD LISTING
$ads = $_CORE->autoCall("Classified", "getAll");

// (B) DRAW LISTING
if (is_array($ads)) { foreach ($ads as $id=>$ad) { ?>
<div class="col-lg-4 col-6"><div class="card">
  <a href="<?=HOST_BASE?>show/<?=$id?>" target="_blank">
    <img src="<?=$ad["img_file"] ? HOST_UPLOADS . $ad["img_file"] : HOST_ASSETS . "noimg.jpg"?>" class="card-img-top thumb"
         width="420" height="200" loading="lazy">
  </a>
  <div class="card-body">
    <span class="badge bg-danger mb-2"><?=$ad["cat_name"]?></span>
    <h5 class="mb-0"><?=$ad["cla_title"]?></h5>
    <p class="mb-3"><?=$ad["cla_summary"]?></p>
    <small class="text-secondary"><?=$ad["cd"]?></small><br>
    <a href="<?=HOST_BASE?>show/<?=$id?>" target="_blank" class="card-link">See More</a>
  </div>
</div></div>
<?php }} else { echo "No listings found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw("cla.goToPage");