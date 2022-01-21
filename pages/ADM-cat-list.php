<?php
// (A) GET CATEGORIES
$cat = $_CORE->autoCall("Category", "getAll");

// (B) DRAW CATEGORIES LIST
if (is_array($cat["data"])) { foreach ($cat["data"] as $id=>$c) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="flex-grow-1">
    <strong><?=$c["cat_name"]?></strong><br>
    <small><?=$c["cat_desc"]?></small>
  </div>
  <div>
    <button class="btn btn-danger btn-sm mi" onclick="cat.del(<?=$id?>)">
      delete
    </button>
    <button class="btn btn-primary btn-sm mi" onclick="cat.addEdit(<?=$id?>)">
      edit
    </button>
  </div>
</div>
<?php }} else { ?>
<div class="d-flex align-items-center border p-2">No categories found.</div>
<?php }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($cat["page"], "cat.goToPage");
