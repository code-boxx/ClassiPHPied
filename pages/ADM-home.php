<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."tinymce/tinymce.min.js"],
  ["s", HOST_ASSETS."ADM-classified.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-atop.php"; ?>
<!-- (A) SEARCH BAR -->
<h3 class="mb-3">MANAGE CLASSIFIEDS</h3>
<form class="d-flex align-items-stretch bg-white border mb-3 p-2" onsubmit="return cla.search()">
  <input type="text" id="cla-search" placeholder="Search" class="form-control form-control-sm"/>
  <button type="submit" class="btn btn-primary me-1 mi">
    search
  </button>
  <button class="btn btn-primary mi" onclick="cla.addEdit()">
    add
  </button>
</form>

<!-- (B) CLASSIFIEDS LIST -->
<div id="cla-list" class="bg-white zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-abottom.php"; ?>
