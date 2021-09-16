<!-- (A) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>adm-classified.js"></script>
<script src="<?=HOST_ASSETS?>tinymce/tinymce.min.js"></script>

<!-- (B) NAVIGATION -->
<nav class="navbar text-white clp-grey">
<div class="container-fluid">
  <h4>Manage Classifieds</h4>
  <form class="d-flex" onsubmit="return cla.search()">
    <input type="text" id="cla-search" placeholder="Search" class="form-control form-control-sm"/>
    <button class="btn btn-primary">
      <span class="mi">search</span>
    </button>
    <button class="btn btn-primary" onclick="cla.addEdit()">
      <span class="mi">add</span>
    </button>
  </form>
</div>
</nav>

<!-- (C) CLASSIFIEDS LIST -->
<div id="cla-list" class="zebra my-4"></div>
