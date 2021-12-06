<?php
// (A) GET IMAGES
$images = $_CORE->autoCall("Images", "getAll");

// (B) PICKER MODE
$pick = isset($_POST["pick"]);
if ($pick) { ?>
<nav class="navbar cb-grey mb-4">
<div class="container-fluid">
  <h4>Choose an image</h4>
  <div class="d-flex">
    <button class="btn btn-danger" onclick="cb.page(2)">
      <span class="mi">reply</span>
    </button>
  </div>
</div>
</nav>
<?php }

// (B) LIST IMAGES
if (count($images["data"])>0) { foreach ($images["data"] as $i) { ?>
  <div class="col-lg-4 col-6 p-2">
    <?php if (!$pick) { ?>
    <a href="<?=HOST_UPLOADS . $i?>" target="_blank">
    <?php } ?>
    <img class="cb-thumb" loading="lazy"
         src="<?=HOST_UPLOADS . $i?>" <?=$pick?"onclick=\"img.pick('$i')\"":""?>/>
    <?php if (!$pick) { ?>
    </a>
    <?php } ?>
    <?php if (!$pick) { ?>
    <div class="btn-group mt-2" role="group">
      <button class="btn btn-danger" onclick="img.del('<?=$i?>')">
        <span class="mi">delete</span>
      </button>
      <button class="btn btn-primary" onclick="img.copy('<?=$i?>')">
        <span class="mi">link</span>
      </button>
    </div>
    <?php } ?>
  </div>
<?php }} else { echo "No images found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw($images["page"], "img.goToPage");
