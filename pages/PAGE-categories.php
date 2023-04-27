<?php
// (A) GET ALL CATEGORIES
$_CORE->load("Category");
$all = $_CORE->Category->getAllR();

// (B) DRAW HTML
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="display-6 mb-3">CATEGORIES</div>
<?php if (is_array($all)) {
  // (B1) RECURSIVE DRAW
  function draw ($cat) {
    echo "<ul class='list-group mt-2'>";
    foreach ($cat as $id => $c) {
      printf(
        "<li class='list-group-item'><a target='_blank' href='%scategory/%u'>(%u) %s</a>",
        HOST_BASE, $id, $id, $c["n"]
      );
      if (is_array($c["c"])) { draw($c["c"]); }
      echo "</li>";
    }
    echo "</ul>";
  }

  // (B2) GO!
  draw($all);
}
require PATH_PAGES . "TEMPLATE-bottom.php";