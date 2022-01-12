<?php
// (A) GET CATEGORY
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) {
  $cat = $_CORE->autoCall("Category", "get");
}

// (B) CATEGORY FORM ?>
<form class="bg-white border p-4" onsubmit="return cat.save()">
  <h3 class="mb-4"><?=$edit?"EDIT":"ADD"?> CATEGORY</h3>
  <input type="hidden" id="cat_id" value="<?=isset($cat)?$cat["cat_id"]:""?>"/>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">category</span>
    </div>
    <input type="text" class="form-control" id="cat_name" required value="<?=isset($cat)?$cat["cat_name"]:""?>" placeholder="Category Name"/>
  </div>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">description</span>
    </div>
    <input type="text" class="form-control" id="cat_desc" value="<?=isset($cat)?$cat["cat_desc"]:""?>" placeholder="Category Description"/>
  </div>

  <input type="button" class="col btn btn-danger btn-lg" value="Back" onclick="cb.page(1)"/>
  <input type="submit" class="col btn btn-primary btn-lg" value="Save"/>
</form>
