<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."ADM-images.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-atop.php"; ?>
<!-- (A) NAVIGATION -->
<nav class="bg-white border mb-3">
  <!-- (A1) HEADER -->
  <div class="d-flex align-items-center p-3 pb-0">
    <h3 class="flex-grow-1">MANAGE IMAGES</h3>
  </div>

  <!-- (A2) UPLOAD BAR -->
  <form class="d-flex align-items-stretch p-3" onsubmit="return img.upload()">
    <input type="file" id="img-up" class="form-control"
           accept="image/jpeg, image/gif, image/webp, image/png"
           multiple required/>
    <button class="btn btn-primary" type="submit">
      <span class="mi">upload</span>
    </button>
  </form>
</nav>

<!-- (B) IMAGE LIST -->
<div id="img-list" class="row bg-white border my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-abottom.php"; ?>
