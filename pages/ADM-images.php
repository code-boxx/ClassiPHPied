<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."ADM-images.css"],
  ["s", HOST_ASSETS."ADM-images.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<!-- (A) HEADER -->
<h3 class="mb-3">MANAGE IMAGES</h3>

<!-- (B) UPLOAD BAR -->
<form class="d-flex align-items-center head border mb-3 p-2" onsubmit="return img.upload()">
  <input type="file" id="img-up" class="form-control" multiple required
         accept="image/jpeg, image/gif, image/webp, image/png">
  <button class="btn btn-primary mi" type="submit">
    upload
  </button>
</form>

<!-- (C) IMAGE LIST -->
<div id="img-list" class="row my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>