<?php
// (A) GET ALL SETTINGS
$options = $_CORE->Options->getAll();

// (B) SETTINGS LIST
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."ADM-settings.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-atop.php"; ?>
<h3 class="mb-3">SYSTEM SETTINGS</h3>
<form id="set-list" onsubmit="return save()">
  <div class="bg-white zebra my-4">
  <?php foreach ($options as $o) { ?>
    <div class="d-flex align-items-center border p-2">
      <div class="flex-grow-1"><?=$o["option_description"]?></div>
      <div>
      <input type="text" class="form-control" required
             name="<?=$o["option_name"]?>" value="<?=$o["option_value"]?>"/>
      </div>
    </div>
  <?php } ?>
  </div>
  <input type="submit" class="btn btn-primary" value="Save"/>
</form>
<?php require PATH_PAGES . "TEMPLATE-abottom.php"; ?>
