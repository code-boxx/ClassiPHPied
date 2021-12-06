<?php
// (A) GET CATEGORY
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) {
  $cat = $_CORE->autoCall("Category", "get");
}

// (B) CATEGORY FORM ?>
<form class="col-md-6 offset-md-3 bg-light border p-4" onsubmit="return cat.save()">
  <h4><?=$edit?"EDIT":"ADD"?> CATEGORY</h4>
  <div class="mb-4 fs-6 text-danger">* Required Fields</div>
  <input type="hidden" id="cat_id" value="<?=isset($cat)?$cat["cat_id"]:""?>"/>

  <div class="mb-4">
    <label for="cat_name" class="form-label">* Name</label>
    <input type="text" class="form-control" id="cat_name" required value="<?=isset($cat)?$cat["cat_name"]:""?>"/>
  </div>

  <div class="mb-4">
    <label for="cat_desc" class="form-label">Description</label>
    <input type="text" class="form-control" id="cat_desc" value="<?=isset($cat)?$cat["cat_desc"]:""?>"/>
  </div>

  <input type="button" class="col btn btn-danger btn-lg" value="Back" onclick="cb.page(1)"/>
  <input type="submit" class="col btn btn-primary btn-lg" value="Save"/>
</form>
