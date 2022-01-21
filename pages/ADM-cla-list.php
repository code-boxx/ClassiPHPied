<?php
// (A) GET CLASSIFIED ADS
$ads = $_CORE->autoCall("Classified", "getAll");
// (B) DRAW CLASSIFIEDS LIST
if (is_array($ads["data"])) { foreach ($ads["data"] as $id=>$ad) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="flex-grow-1">
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
  <div>
    <button class="btn btn-danger btn-sm mi" onclick="cla.del(<?=$id?>)">
      delete
    </button>
    <a class="btn btn-primary btn-sm mi" target="_blank" href="<?=HOST_BASE?>show/?id=<?=$id?>">
      search
    </a>
    <button class="btn btn-primary btn-sm mi" onclick="cla.addEdit(<?=$id?>)">
      edit
    </button>
  </div>
</div>
<?php }} else { ?>
<div class="d-flex align-items-center border p-2">No classifieds found.</div>
<?php }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($ads["page"], "cla.goToPage");
