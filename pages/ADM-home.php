<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."tinymce/tinymce.min.js", "defer"],
  ["s", HOST_ASSETS."ADM-classified.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<!-- (A) HEADER -->
<h3 class="mb-3">MANAGE CLASSIFIEDS</h3>

<!-- (B) SEARCH BAR -->
<form class="d-flex align-items-stretch head border mb-3 p-2" onsubmit="return cla.search()">
  <input type="text" id="cla-search" placeholder="Search" class="form-control form-control-sm">
  <div class="btn-group mx-1">
    <button type="submit" class="btn btn-primary mi">
      search
    </button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"></button>
    <select id="cla-cat" class="p-3 dropdown-menu form-select">
      <option value="">All</option>
      <?php
      $_CORE->load("Category");
      $cat = $_CORE->Category->getAll();
      if (is_array($cat)) { foreach ($cat as $cid=>$c) {
        printf("<option value='%u'>%s</option>", $cid, $c["cat_name"]);
      }}
      ?>
    </select>
  </div>
  <button class="btn btn-primary mi" onclick="cla.addEdit()">
    add
  </button>
</form>

<!-- (C) CLASSIFIEDS LIST -->
<div id="cla-list" class="zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>