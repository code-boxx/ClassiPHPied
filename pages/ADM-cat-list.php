<?php
// (A) GET CATEGORIES
$cat = $_CORE->autoCall("Category", "getAll");

// (B) DRAW CATEGORIES LIST
if (is_array($cat)) { foreach ($cat as $id=>$c) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="flex-grow-1">
    <strong><?=$c["cat_name"]?></strong><br>
    <small class="fw-bold">Parent: <?=$c["parent_name"]?></small><br>
    <small><?=$c["cat_desc"]?></small>
  </div>
  <div class="dropdown">
    <button class="btn btn-primary btn-sm mi" type="button" data-bs-toggle="dropdown">
      more_vert
    </button>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li class="dropdown-item" onclick="cat.addEdit(<?=$id?>)">
        <i class="mi mi-smol">edit</i> Edit
      </li>
      <li class="dropdown-item text-warning" onclick="cat.del(<?=$id?>)">
        <i class="mi mi-smol">delete</i> Delete
      </li>
    </ul>
  </div>
</div>
<?php }} else { echo "No categories found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw("cat.goToPage");