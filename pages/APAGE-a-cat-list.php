<?php
// (A) GET CATEGORIES
$cat = $_CORE->autoCall("Category", "getAll");

// (B) DRAW CATEGORIES LIST
if (is_array($cat["data"])) { foreach ($cat["data"] as $id=>$c) { ?>
<div class="row p-1">
  <div class="col-9">
    <strong><?=$c["cat_name"]?></strong><br>
    <small><?=$c["cat_desc"]?></small>
  </div>
  <div class="col text-end">
    <button class="btn btn-danger btn-sm" onclick="cat.del(<?=$id?>)">
      <span class="mi">delete</span>
    </button>
    <button class="btn btn-primary btn-sm" onclick="cat.addEdit(<?=$id?>)">
      <span class="mi">edit</span>
    </button>
  </div>
</div>
<?php }} else { echo "No categories found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($cat["page"], "cat.goToPage");
