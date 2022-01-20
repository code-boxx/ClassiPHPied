<?php
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."ADM-users.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-atop.php"; ?>
<!-- (A) SEARCH BAR -->
<h3 class="mb-3">MANAGE USERS</h3>
<form class="d-flex align-items-stretch bg-white border mb-3 p-2" onsubmit="return usr.search()">
  <input type="text" id="user-search" placeholder="Search" class="form-control form-control-sm"/>
  <button type="submit" class="btn btn-primary me-1">
    <span class="mi">search</span>
  </button>
  <button class="btn btn-primary" onclick="usr.addEdit()">
    <span class="mi">add</span>
  </button>
</form>

<!-- (B) USERS LIST -->
<div id="user-list" class="bg-white zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-abottom.php"; ?>
