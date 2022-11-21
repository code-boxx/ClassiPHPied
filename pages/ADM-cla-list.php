<?php
// (A) GET CLASSIFIED ADS
$ads = $_CORE->autoCall("Classified", "getAll");

// (B) DRAW CLASSIFIEDS LIST
if (is_array($ads)) { foreach ($ads as $id=>$ad) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="flex-grow-1">
    <div class="fw-bold"><?=$ad["cla_title"]?></div>
    <div><?=$ad["cla_summary"]?></div>
    <small class="text-secondary"><?=$ad["cd"]?></small>
  </div>
  <div class="dropdown">
    <button class="btn btn-primary btn-sm mi" type="button" data-bs-toggle="dropdown">
      more_vert
    </button>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li class="dropdown-item" onclick="cla.addEdit(<?=$id?>)">
        <i class="mi mi-smol">edit</i> Edit
      </li>
      <li><a class="dropdown-item" target="_blank" href="<?=HOST_BASE?>show/<?=$id?>">
        <i class="mi mi-smol">search</i> View
      </a></li>
      <li class="dropdown-item text-warning" onclick="cla.del(<?=$id?>)">
        <i class="mi mi-smol">delete</i> Delete
      </li>
    </ul>
  </div>
</div>
<?php }} else { echo "No classifieds found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw("cla.goToPage");