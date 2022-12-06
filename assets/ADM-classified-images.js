var img = {
  // (A) INITIALIZE & SETUP IMAGE PICKER
  loaded : false, // already initialized?
  slot : 0, // current selected slot
  init : slot => {
    img.slot = slot;
    if (img.loaded) { cb.page(2); img.list(); }
    else {
      cb.load({
        page : "admin/cla/images", target : "cb-page-3",
        onload : () => {
          img.loaded = true;
          cb.page(2);
          img.list();
        }
      })
    }
  },

  // (B) LOAD IMAGES
  pg : 1, // current page
  find : "", // current search
  list : () => cb.load({
    page : "admin/img/list", target : "img-list",
    data : {
      page : img.pg,
      search : img.find,
      pick : true
    }
  }),

  // (C) GO TO PAGE
  //  pg : int, page number
  goToPage : pg => { if (pg!=img.pg) {
    img.pg = pg;
    img.list();
  }},

  // (D) SEARCH IMAGE
  search : () => {
    img.find = document.getElementById("img-search").value;
    img.pg = 1;
    img.list();
    return false;
  },

  // (E) PICK IMAGE
  pick : i => {
    // (E1) BACK TO FORM
    cb.page(1);

    // (E2) CREATE NEW IMAGE TAG
    var slot = img.slot,
        wrap = document.getElementById("cla_img_" + img.slot),
        nimg = document.createElement("img");
    nimg.src = cbhost.uploads + i;
    nimg.className = "thumb cla-img";
    nimg.onclick = () => { img.remove(slot); };
    wrap.innerHTML = "";
    wrap.appendChild(nimg);
  },

  // (F) REMOVE IMAGE
  //  slot : image slot number
  remove : slot => {
    var wrap = document.getElementById("cla_img_" + slot),
        nbtn = document.createElement("button");
    nbtn.className = "cla-img btn btn-primary btn-sm w-100";
    nbtn.type = "button";
    nbtn.innerHTML = "Choose an image";
    nbtn.onclick = () => { img.init(slot); };
    wrap.innerHTML = "";
    wrap.appendChild(nbtn);
  }
};