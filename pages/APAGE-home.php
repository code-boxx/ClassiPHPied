<!-- (A) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>adm-classified.js"></script>
<script src="<?=HOST_ASSETS?>tinymce/tinymce.min.js"></script>

<!-- (B) NAVIGATION -->
<!-- (B1) PAGE HEADER -->
<nav class="navbar cb-grey"><div class="container-fluid">
  <h4>Manage Classifieds</h4>
  <div class="d-flex">
    <button class="btn btn-primary" onclick="cla.addEdit()">
      <span class="mi">add</span>
    </button>
  </div>
</div></nav>

<!-- (B2) SEARCH BAR -->
<div class="searchBar"><form class="d-flex" onsubmit="return cla.search()">
  <input type="text" id="cla-search" placeholder="Search" class="form-control form-control-sm"/>
  <button class="btn btn-primary">
    <span class="mi">search</span>
  </button>
</form></div>

<!-- (C) CLASSIFIEDS LIST -->
<div id="cla-list" class="container zebra my-4"></div>
