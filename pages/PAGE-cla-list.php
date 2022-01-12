<?php
// (A) LOAD AD LISTING
$list = $_CORE->autoCall("Classified", "getAllByCat");

// (B) DRAW LISTING
if (is_array($list["data"])) { foreach ($list["data"] as $id=>$ad) { ?>
<div class="col-lg-4 col-6"><div class="card">
  <a href="<?=HOST_BASE?>show/?id=<?=$id?>" target="_blank">
    <img src="<?=$ad["img_file"] ? HOST_UPLOADS . $ad["img_file"] : HOST_ASSETS . "noimg.jpg"?>" class="card-img-top" loading="lazy"/>
  </a>
  <div class="card-body">
    <h5 class="card-title"><?=$ad["cla_title"]?></h5>
    <h6 class="card-subtitle mb-2 text-primary"><?=$ad["cat_name"]?></h6>
    <h6 class="card-subtitle mb-2 text-primary"><?=$ad["cla_date"]?></h6>
    <p class="card-text"><?=$ad["cla_summary"]?></p>
    <a href="<?=HOST_BASE?>show/?id=<?=$id?>" target="_blank" class="card-link">See More</a>
  </div>
</div></div>
<?php }} else { ?>
<div class="col p-2">No listings found.</div>
<?php }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($list["page"], "cla.goToPage");
