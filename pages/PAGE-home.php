<?php
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."PAGE-classified.css"],
  ["s", HOST_ASSETS."PAGE-classified.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) HEADER -->
<nav class="d-flex align-items-center mb-4">
  <div class="flex-grow-1 display-6 mb-0">Classified Ads</div>
  <select id="cla-cat" class="w-auto form-select" onchange="cla.cat()">
    <option value="">All</option>
    <?php
    $_CORE->load("Category");
    $cat = $_CORE->Category->getAll();
    if (is_array($cat)) { foreach ($cat as $cid=>$c) {
      printf("<option value='%u'>%s</option>", $cid, $c["cat_name"]);
    }}
    ?>
  </select>
</nav>

<!-- (B) CLASSIFIEDS -->
<div class="container"><div id="cla-list" class="row g-3"></div></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>