<?php
// (A) GET CATEGORY
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) { $cat = $_CORE->autoCall("Category", "get"); }
$parents = $_CORE->autoCall("Category", "getSwitchable");

// (B) CATEGORY FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"ADD"?> CATEGORY</h3>
<form onsubmit="return cat.save()">
  <div class="bg-white border p-4 mb-3">
    <input type="hidden" id="cat_id" value="<?=isset($cat)?$cat["cat_id"]:""?>">
    <div class="form-floating mb-4">
      <input type="text" class="form-control" id="cat_name" required value="<?=isset($cat)?$cat["cat_name"]:""?>">
      <label>Category Name</label>
    </div>

    <div class="form-floating mb-4">
      <input type="text" class="form-control" id="cat_desc" value="<?=isset($cat)?$cat["cat_desc"]:""?>">
      <label>Category Description</label>
    </div>

    <div class="form-floating">
      <select class="form-select" id="cat_parent" required>
        <option value="0">None</option>
        <?php
        if (is_array($parents)) { foreach ($parents as $i=>$n) {
          printf("<option value='%u'%s>%s</option>",
            $i, $edit && $i==$cat["parent_id"]?" selected":"", $n
          );
        }}
        ?>
      </select>
      <label>Parent Category</label>
    </div>
  </div>

  <input type="button" class="col btn btn-danger" value="Back" onclick="cb.page(1)">
  <input type="submit" class="col btn btn-primary" value="Save">
</form>