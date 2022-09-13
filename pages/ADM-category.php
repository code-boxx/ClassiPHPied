<?php
$_PMETA = ["load" => [["s", HOST_ASSETS."ADM-category.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<!-- (A) HEADER -->
<h3 class="mb-3">MANAGE CATEGORIES</h3>

<!-- (B) SEARCH BAR -->
<form class="d-flex align-items-stretch head border mb-3 p-2" onsubmit="return cat.search()">
  <input type="text" id="cat-search" placeholder="Search" class="form-control form-control-sm">
  <button type="submit" class="btn btn-primary mx-1 mi">
    search
  </button>
  <button class="btn btn-primary mi" onclick="cat.addEdit()">
    add
  </button>
</form>

<!-- (B) CATEGORIES LIST -->
<div id="cat-list" class="zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>