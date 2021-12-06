<?php
// (A) GET CATEGORIES
$_CORE->load("Category");
$cat = $_CORE->Category->getAll(null, "A");

// (B) GET CLASSIFIED
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) {
  $ad = $_CORE->autoCall("Classified", "get");
}

// (C) CLASSIFIED FORM ?>
<h4><?=$edit?"EDIT":"ADD"?> CLASSIFIED</h4>
<div class="mb-4 fs-6 text-danger">* Required Fields</div>
<form onsubmit="return cla.save()">
<div class="row">
  <div class="col-md-7 col-11 bg-light border p-4 m-1">
    <h5 class="mb-4">AD DETAILS</h5>
    <input type="hidden" id="cla_id" value="<?=isset($ad)?$ad["cla_id"]:""?>"/>
    <div class="mb-4">
      <label for="cla_cat" class="form-label">* Category</label>
      <select class="form-control" id="cla_cat">
        <option value="">None</option>
        <?php
        if (is_array($cat)) { foreach ($cat as $cid=>$c) {
          printf("<option value='%u'%s>%s</option>",
            $cid, isset($ad) && $ad["cat_id"]==$cid ? " selected" : "",
            $c["cat_name"]
          );
        }}
        ?>
      </select>
    </div>

    <div class="mb-4">
      <label for="cla_title" class="form-label">* Title</label>
      <input type="text" class="form-control" id="cla_title" required value="<?=isset($ad)?$ad["cla_title"]:""?>"/>
    </div>

    <div class="mb-4">
      <label for="cla_summary" class="form-label">* Short Summary</label>
      <input type="text" class="form-control" id="cla_summary" required value="<?=isset($ad)?$ad["cla_summary"]:""?>"/>
    </div>

    <div class="mb-4">
      <label for="cla_text" class="form-label">* Text</label>
      <textarea id="cla_text" class="form-control"><?=isset($ad)?$ad["cla_text"]:""?></textarea>
    </div>

    <div class="mb-4">
      <label class="form-label">Images (click on existing image to remove)</label>
      <?php for ($i=1; $i<=CLA_IMAGES; $i++) { ?>
      <div id="cla_img_<?=$i?>">
        <?php if (isset($ad["images"][$i])) { ?>
          <img src="<?=HOST_UPLOADS . $ad["images"][$i]["img_file"]?>"
               class="img-thumbnail cla-img" onclick="img.remove(<?=$i?>)"/>
        <?php } else { ?>
        <button class="cla-img btn btn-primary btn-sm w-100 mb-3" type="button" onclick="img.init(<?=$i?>)">
          Choose an image
        </button>
      <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="col-md-4 col-11 bg-light border p-4 m-1">
    <h5 class="mb-4">CONTACT PERSON</h5>
    <div class="mb-4">
      <label for="cla_person" class="form-label">* Name</label>
      <input type="text" class="form-control" id="cla_person" required value="<?=isset($ad)?$ad["cla_person"]:""?>"/>
    </div>

    <div class="mb-4">
      <label for="cla_email" class="form-label">Email</label>
      <input type="email" class="form-control" id="cla_email" value="<?=isset($ad)?$ad["cla_email"]:""?>"/>
    </div>

    <div class="mb-4">
      <label for="cla_tel" class="form-label">Telephone</label>
      <input type="text" class="form-control" id="cla_tel" value="<?=isset($ad)?$ad["cla_tel"]:""?>"/>
    </div>
  </div>
</div>
<div class="row"><div class="col mt-4">
  <input type="button" class="col btn btn-danger btn-lg" value="Back" onclick="cb.page(1)"/>
  <input type="submit" class="col btn btn-primary btn-lg" value="Save"/>
</div></div>
</form>
