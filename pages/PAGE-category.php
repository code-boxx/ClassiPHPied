<?php
// (A) EXTRACT ID
$id = explode("/", rtrim($_CORE->Route->path, "/"));
$valid = count($id) == 2;
if ($valid) {
  $id = $id[1];
  $valid = is_numeric($id);
}

// (B) GET CATEGORY & CLASSIFIEDS
if ($valid) {
  $_CORE->load("Category");
  $_CORE->load("Classified");
  $cat = $_CORE->Category->get($id);
  $valid = is_array($cat);
  if ($valid) { $ads = $_CORE->Classified->getInCat($id); }
}

// (C) OUTPUT HTML
if (!$valid) { require PATH_PAGES . "PAGE-404.php"; exit(); }
$_PMETA = [
  "title" => $cat["cat_name"],
  "desc" => $cat["cat_desc"],
  "load" => [["l", HOST_ASSETS."PAGE-classified.css"]]
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="container"><div id="cla-list" class="row g-3">
  <?php if (is_array($ads)) { foreach ($ads as $id=>$ad) { ?>
  <div class="col-lg-4 col-6"><div class="card">
    <a href="<?=HOST_BASE?>show/<?=$id?>" target="_blank">
      <img src="<?=$ad["img_file"] ? HOST_UPLOADS . $ad["img_file"] : HOST_ASSETS . "noimg.webp"?>" class="card-img-top thumb"
          width="420" height="200" loading="lazy">
    </a>
    <div class="card-body">
      <h5 class="mb-0"><?=$ad["cla_title"]?></h5>
      <p class="mb-3"><?=$ad["cla_summary"]?></p>
      <small class="text-secondary"><?=$ad["cd"]?></small><br>
      <a href="<?=HOST_BASE?>show/<?=$id?>" target="_blank" class="card-link">See More</a>
    </div>
  </div></div>
  <?php }} else { echo "No listings found."; } ?>
</div></div>
<?php  require PATH_PAGES . "TEMPLATE-bottom.php"; ?>