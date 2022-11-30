<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."ADM-images.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<!-- (A) HEADER -->
<h3 class="mb-3">MANAGE IMAGES</h3>

<!-- (B) HEADER BAR -->
<div class="d-flex align-items-center head border mb-3 p-2">
  <!-- (B1) SEARCH FORM -->
  <form class="d-flex flex-grow-1" onsubmit="return img.search()">
    <input type="text" id="img-search" placeholder="Search" class="form-control form-control-sm">
    <button type="submit" class="btn btn-primary mi mx-1">
      search
    </button>
  </form>

  <!-- (B2) UPLOAD FORM -->
  <label for="img-up">
    <span class="btn btn-primary mi" aria-hidden="true">upload</span>
    <input type="file" id="img-up" class="d-none" multiple required accept="image/*" onchange="img.upload()">
  </label>
</div>

<!-- (C) IMAGE LIST -->
<div id="img-list" class="row my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>