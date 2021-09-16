<?php
// (A) LOAD AD LISTING
$list = $_CORE->autoCall("Classified", "getAllByCat");

// (B) DRAW LISTING
if (is_array($list["data"])) { foreach ($list["data"] as $id=>$ad) { ?>
<div class="col-lg-3 col-6"><div class="card my-1">
  <img src="<?=$ad["img_file"] ? HOST_UPLOADS . $ad["img_file"] : HOST_ASSETS . "noimg.jpg"?>" class="card-img-top" loading="lazy"/>
  <div class="card-body">
    <h5 class="card-title"><?=$ad["cla_title"]?></h5>
    <div class=""><?=$ad["cla_date"]?></div>
    <p class="card-text"><?=$ad["cla_summary"]?></p>
    <a href="<?=HOST_BASE?>show/?id=<?=$id?>" target="_blank" class="btn btn-primary">See More</a>
  </div>
</div></div>
<?php }} else { echo "No listings found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($list["page"], "cla.goToPage");
