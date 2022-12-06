<!-- (A) HEADER -->
<h3 class="mb-3">CHOOSE AN IMAGE</h3>

<!-- (B) SEARCH BAR -->
<div class="d-flex align-items-center head border mb-3 p-2">
  <form class="d-flex flex-grow-1" onsubmit="return img.search()">
    <input type="text" id="img-search" placeholder="Search" class="form-control form-control-sm">
    <button type="submit" class="btn btn-primary mi mx-1">
      search
    </button>
  </form>
  <button class="btn btn-danger mi" onclick="cb.page(1)">
    reply
  </button>
</div>

<!-- (C) IMAGE LIST -->
<div id="img-list" class="row my-4"></div>