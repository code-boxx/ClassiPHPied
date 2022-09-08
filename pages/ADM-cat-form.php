<?php
// (A) GET CATEGORY
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) { $cat = $_CORE->autoCall("Category", "get"); }

// (B) CATEGORY FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"ADD"?> CATEGORY</h3>
<form onsubmit="return cat.save()">
  <input type="hidden" id="cat_id" value="<?=isset($cat)?$cat["cat_id"]:""?>">

  <div class="bg-white border p-4 mb-3">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text mi">category</span>
      </div>
      <input type="text" class="form-control" id="cat_name" required value="<?=isset($cat)?$cat["cat_name"]:""?>" placeholder="Category Name">
    </div>

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text mi">description</span>
      </div>
      <input type="text" class="form-control" id="cat_desc" value="<?=isset($cat)?$cat["cat_desc"]:""?>" placeholder="Category Description">
    </div>
  </div>

  <input type="button" class="col btn btn-danger" value="Back" onclick="cb.page(0)">
  <input type="submit" class="col btn btn-primary" value="Save">
</form>