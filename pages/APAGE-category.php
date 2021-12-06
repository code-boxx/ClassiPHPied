<!-- (A) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>adm-category.js"></script>

<!-- (B) NAVIGATION -->
<!-- (B1) PAGE HEADER -->
<nav class="navbar cb-grey"><div class="container-fluid">
  <h4>Manage Categories</h4>
  <div class="d-flex">
    <button class="btn btn-primary" onclick="cat.addEdit()">
      <span class="mi">add</span>
    </button>
  </div>
</div></nav>

<!-- (B2) SEARCH BAR -->
<div class="searchBar"><form class="d-flex" onsubmit="return cat.search()">
  <input type="text" id="cat-search" placeholder="Search" class="form-control form-control-sm"/>
  <button class="btn btn-primary">
    <span class="mi">search</span>
  </button>
</form></div>

<!-- (C) CATEGORIES LIST -->
<div id="cat-list" class="container zebra my-4"></div>
