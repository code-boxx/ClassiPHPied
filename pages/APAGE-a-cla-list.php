<?php
// (A) GET CLASSIFIED ADS
$ads = $_CORE->autoCall("Classified", "getAll");

// (B) DRAW CLASSIFIEDS LIST
if (is_array($ads["data"])) { foreach ($ads["data"] as $id=>$ad) { ?>
<div class="row p-1">
  <div class="col-9">
    <strong><?=$ad["cla_title"]?></strong><br>
    <small class="text-secondary">
      <span class="mi mi-smol">event</span> <?=$ad["cla_date"]?>
    </small><br>
    <small class="text-secondary">
      <span class="mi mi-smol">article</span> <?=$ad["cla_summary"]?>
    </small><br>
    <small class="text-secondary">
      <span class="mi mi-smol">person</span> <?=$ad["cla_person"]?>
      <span class="mi mi-smol">email</span> <?=$ad["cla_email"]?$ad["cla_email"]:"NIL"?>
      <span class="mi mi-smol">call</span> <?=$ad["cla_tel"]?$ad["cla_tel"]:"NIL"?>
    </small>
  </div>
  <div class="col text-end">
    <button class="btn btn-danger btn-sm" onclick="cla.del(<?=$id?>)">
      <span class="mi">delete</span>
    </button>
    <a class="btn btn-primary btn-sm" target="_blank" href="<?=HOST_BASE?>show/?id=<?=$id?>">
      <span class="mi">search</span>
    </a>
    <button class="btn btn-primary btn-sm" onclick="cla.addEdit(<?=$id?>)">
      <span class="mi">edit</span>
    </button>
  </div>
</div>
<?php }} else { echo "No classifieds found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($ads["page"], "cla.goToPage");
