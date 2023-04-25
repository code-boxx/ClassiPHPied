<?php
// (A) GET CATEGORIES
$_CORE->load("Category");
$cat = $_CORE->Category->getAll();

// (B) GET CLASSIFIED
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) { $ad = $_CORE->autoCall("Classified", "get"); }

// (C) CLASSIFIED FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"ADD"?> CLASSIFIED</h3>
<form onsubmit="return cla.save()">
  <div class="row">
    <!-- (C1) LEFT -->
    <div class="col-md-7">
      <!-- (C1-1) SUMMARY -->
      <div class="fw-bold text-danger mb-2">AD SUMMARY</div>
      <div class="bg-white border p-4 mb-3">
        <input type="hidden" id="cla_id" value="<?=isset($ad)?$ad["cla_id"]:""?>">

        <div class="form-floating mb-3">
          <select class="form-select" id="cla_cat">
            <option value="">No Category</option>
            <?php
            if (is_array($cat)) { foreach ($cat as $cid=>$c) {
              printf("<option value='%u'%s>%s</option>",
                $cid, isset($ad) && $ad["cat_id"]==$cid ? " selected" : "",
                $c["cat_name"]
              );
            }}
            ?>
          </select>
          <label>Category</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="cla_title" required value="<?=isset($ad)?$ad["cla_title"]:""?>" placeholder="Title">
          <label>Title</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="cla_summary" required value="<?=isset($ad)?$ad["cla_summary"]:""?>" placeholder="Short Summary">
          <label>Summary</label>
        </div>

        <div class="form-floating">
          <input type="datetime-local" class="form-control" id="cla_end" value="<?=isset($ad)?$ad["cla_end"]:""?>">
          <label>End date, leave blank for none.</label>
        </div>
      </div>

      <!-- (C1-2) BODY -->
      <div class="fw-bold text-danger mb-2">AD BODY</div>
      <div class="bg-white border p-4 mb-3">
        <textarea id="cla_text" class="form-control"><?=isset($ad)?$ad["cla_text"]:""?></textarea>
      </div>

      <!-- (C1-3) CONTACT PERSON -->
      <div class="fw-bold text-danger mb-2">CONTACT PERSON</div>
      <div class="bg-white border p-4 mb-3">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="cla_person" required value="<?=isset($ad)?$ad["cla_person"]:""?>" placeholder="Name">
          <label>Name</label>
        </div>

        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="cla_email" required value="<?=isset($ad)?$ad["cla_email"]:""?>" placeholder="Email">
          <label>Email</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="cla_tel" value="<?=isset($ad)?$ad["cla_tel"]:""?>" placeholder="Telephone">
          <label>Telephone</label>
        </div>
      </div>
    </div>

    <!-- (C2) RIGHT -->
    <div class="col-md-5">
      <!-- (C2-1) IMAGES -->
      <div class="fw-bold text-danger">AD IMAGES</div>
      <div class="text-secondary mb-2">(click on existing image to remove)</div>
      <div class="bg-white border p-4 mb-3">
        <?php for ($i=1; $i<=CLA_IMAGES; $i++) { ?>
        <div id="cla_img_<?=$i?>" class="mb-3 border">
          <?php if (isset($ad["images"][$i])) { ?>
            <img src="<?=HOST_UPLOADS . $ad["images"][$i]["img_file"]?>"
                 class="thumb cla-img" onclick="img.remove(<?=$i?>)">
          <?php } else { ?>
          <button class="cla-img btn btn-primary btn-sm w-100" type="button" onclick="img.init(<?=$i?>)">
            Choose an image
          </button>
        <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- (C3) BOTTOM -->
  <div class="row"><div class="col">
    <input type="button" class="col btn btn-danger" value="Back" onclick="cb.page(1)">
    <input type="submit" class="col btn btn-primary" value="Save">
  </div></div>
</form>