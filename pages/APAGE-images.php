<!-- (A) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>adm-images.js"></script>

<!-- (B) NAVIGATION -->
<!-- (B1) PAGE HEADER -->
<nav class="navbar cb-grey"><div class="container-fluid">
  <h4>Manage Images</h4>
</div></nav>

<!-- (B2) UPLOAD BAR -->
<div class="searchBar"><form class="d-flex" onsubmit="return img.upload()">
  <input type="file" id="img-up" class="form-control"
         accept="image/jpeg, image/gif, image/webp, image/png"
         multiple required/>
  <button class="btn btn-primary" type="submit">
    <span class="mi">upload</span>
  </button>
</form></div>

<!-- (C) IMAGE LIST -->
<div id="img-list" class="row my-4"></div>
