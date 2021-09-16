<!-- (A) PAGE SCRIPT -->
<script src="<?=HOST_ASSETS?>classi.js"></script>

<!-- (B) CATEGORIES LIST -->
<h4>CATEGORIES</h4>
<div class="row mb-5">
  <div class="col-lg-3 m-2 border border-secondary" onclick="cla.cat(null)">All</div>
  <?php
  $_CORE->load("Category");
  $cat = $_CORE->Category->getAll(null, "A");
  if (is_array($cat)) { foreach ($cat as $cid=>$c) {
    printf("<div class='col-lg-3 m-2 border border-secondary' onclick='cla.cat(%u)'>%s</div>",
      $cid, $c["cat_name"]
    );
  }}
  ?>
</div>

<!-- (C) CLASSIFIEDS -->
<h4>LISTING</h4>
<div id="cla-list" class="row"></div>
