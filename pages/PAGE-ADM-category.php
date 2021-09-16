<!-- (A) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>adm-category.js"></script>

<!-- (B) NAVIGATION -->
<nav class="navbar text-white clp-grey">
<div class="container-fluid">
  <h4>Manage Categories</h4>
  <form class="d-flex" onsubmit="return cat.search()">
    <input type="text" id="cat-search" placeholder="Search" class="form-control form-control-sm"/>
    <button class="btn btn-primary">
      <span class="mi">search</span>
    </button>
    <button class="btn btn-primary" onclick="cat.addEdit()">
      <span class="mi">add</span>
    </button>
  </form>
</div>
</nav>

<!-- (C) CATEGORIES LIST -->
<div id="cat-list" class="zebra my-4"></div>
