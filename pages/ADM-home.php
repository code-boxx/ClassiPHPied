<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."tinymce/tinymce.min.js"],
  ["s", HOST_ASSETS."ADM-classified.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-atop.php"; ?>
<!-- (A) NAVIGATION -->
<nav class="bg-white border mb-3">
  <!-- (A1) HEADER -->
  <div class="d-flex align-items-center p-3 pb-0">
    <h3 class="flex-grow-1">MANAGE CLASSIFIEDS</h3>
    <button class="btn btn-primary" onclick="cla.addEdit()">
      <span class="mi">add</span>
    </button>
  </div>

  <!-- (A2) SEARCH BAR -->
  <form class="d-flex align-items-stretch p-3" onsubmit="return cla.search()">
    <input type="text" id="cla-search" placeholder="Search" class="form-control form-control-sm"/>
    <button class="btn btn-primary">
      <span class="mi">search</span>
    </button>
  </form>
</nav>

<!-- (B) CLASSIFIEDS LIST -->
<div id="cla-list" class="bg-white border zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-abottom.php"; ?>
