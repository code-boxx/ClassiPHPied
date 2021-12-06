<!-- (A) PAGE SCRIPT -->
<script src="<?=HOST_ASSETS?>classi.js"></script>
<style>#cla-list{align-items:stretch}.card{height:100%}</style>

<!-- (B) CATEGORIES LIST -->
<nav class="navbar bg-light mb-4"><div class="container-fluid">
  <h4>LISTINGS</h4>
  <div class="d-flex">
  <select id="cla-cat" class="form-control" onchange="cla.cat()">
    <option value="">All</option>
    <?php
    $_CORE->load("Category");
    $cat = $_CORE->Category->getAll(null, "A");
    if (is_array($cat)) { foreach ($cat as $cid=>$c) {
      printf("<option value='%u'>%s</option>", $cid, $c["cat_name"]);
    }}
    ?>
  </select>
  </div>
</div></nav>

<!-- (C) CLASSIFIEDS -->
<div class="container"><div id="cla-list" class="row g-3"></div></div>
