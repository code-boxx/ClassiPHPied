var cla = {
  // (A) SHOW ALL CLASSIFIED ADS
  pg : 1, // current page
  find : "", // current search
  list : () =>  {
    cb.page(0);
    cb.load({
      page : "admin/cla/list", target : "cla-list",
      data : {
        page : cla.pg,
        search : cla.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : pg => { if (pg!=cla.pg) {
    cla.pg = pg;
    cla.list();
  }},

  // (C) SEARCH CLASSIFIEDS
  search : () => {
    cla.find = document.getElementById("cla-search").value;
    cla.pg = 1;
    cla.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // id : classified ID, for edit only
  addEdit : id => cb.load({
    page : "admin/cla/form", target : "cb-page-2",
    data : { id : id ? id : "" },
    onload : () => {
      cb.page(1);
      tinymce.remove();
      tinymce.init({
        selector : "#cla_text",
        menubar : false,
        plugins: "lists link",
        toolbar: "bold italic underline | forecolor | bullist numlist | alignleft aligncenter alignright alignjustify | link"
      });
    }
  }),

  // (E) SAVE CLASSIFIED AD
  save : () => {
    // (E1) MANUAL CHECK TINYMCE TEXT (HTML REQUIRED DOES NOT WORK)
    var text = tinymce.get("cla_text").getContent();
    if (text=="") {
      cb.modal("Error", "Please fill in the classified text.");
      return false;
    }

    // (E2) GET DATA
    var data = {
      cat : document.getElementById("cla_cat").value,
      title : document.getElementById("cla_title").value,
      summary : document.getElementById("cla_summary").value,
      text : text,
      images : [],
      person : document.getElementById("cla_person").value,
      email : document.getElementById("cla_email").value,
      tel : document.getElementById("cla_tel").value
    };
    var id = document.getElementById("cla_id").value;
    if (id!="") { data.id = id; }

    // (E3) GET IMAGES
    var images = document.querySelectorAll(".cla-img");
    for (let i of images) {
      if (i.nodeName=="IMG") {
        data.images.push(i.src.replace(/^.*[\\\/]/, ""));
      } else {
        data.images.push(false);
      }
    }
    data.images = JSON.stringify(data.images);

    // (E3) AJAX
    cb.api({
      mod : "classified", req : "save",
      data : data,
      passmsg : "Classified Ad Saved",
      onpass : cla.list
    });
    return false;
  },

  // (F) DELETE CLASSIFIED AD
  //  id : int, classified ID
  //  confirm : boolean, confirmed delete
  del : id => cb.modal("Please confirm", "Delete this entry?", () => cb.api({
    mod : "classified", req : "del",
    data : { id: id },
    passmsg : "Classified Ad Deleted",
    onpass : cla.list
  }))
};

var img = {
  // (A) INITIALIZE & SETUP IMAGE PICKER
  loaded : false, // already initialized?
  slot : 0, // current selected slot
  init : slot => {
    img.slot = slot;
    cb.page(2);
    if (!img.loaded) {
      document.getElementById("cb-page-3").innerHTML = '<div id="img-list" class="row"></div>';
      img.loaded = true;
      img.list();
    }
  },

  // (B) LOAD IMAGES
  pg : 1, // CURRENT PAGE
  list : () => cb.load({
    page : "admin/img/list", target : "img-list",
    data : {
      page : img.pg,
      pick : true,
    }
  }),

  // (C) GO TO PAGE
  //  pg : int, page number
  goToPage : pg => { if (pg!=img.pg) {
    img.pg = pg;
    img.list();
  }},

  // (C) PICK IMAGE
  pick : i => {
    // (C1) BACK TO FORM
    cb.page(1);

    // (C2) CREATE NEW IMAGE TAG
    var slot = img.slot,
        wrap = document.getElementById("cla_img_" + img.slot),
        nimg = document.createElement("img");
    nimg.src = cbhost.uploads + i;
    nimg.className = "thumb cla-img";
    nimg.onclick = () => { img.remove(slot); };
    wrap.innerHTML = "";
    wrap.appendChild(nimg);
  },

  // (D) REMOVE IMAGE
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
window.addEventListener("load", cla.list);