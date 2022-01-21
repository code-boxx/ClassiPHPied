<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."ADM-images.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-atop.php"; ?>
<!-- (A) UPLOAD BAR -->
<h3 class="mb-3">MANAGE IMAGES</h3>
<form class="d-flex align-items-stretch bg-white border mb-3 p-2" onsubmit="return img.upload()">
  <input type="file" id="img-up" class="form-control"
         accept="image/jpeg, image/gif, image/webp, image/png"
         multiple required/>
  <button class="btn btn-primary mi" type="submit">
    upload
  </button>
</form>

<!-- (B) IMAGE LIST -->
<div id="img-list" class="row bg-white border my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-abottom.php"; ?>
