var cla = {
  // (A) SHOW ALL CLASSIFIED ADS
  pg : 1, // CURRENT PAGE
  find : "", // CURRENT SEARCH
  list : () =>  {
    clp.page(1);
    clp.load({
      page : "cla/list",
      target : "cla-list",
      data : {
        page : cla.pg,
        search : cla.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : (pg) => { if (pg!=cla.pg) {
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
  addEdit : (id) => {
    clp.load({
      page : "cla/form",
      target : "clp-page-2",
      data : { id : id ? id : "" },
      onload : () => {
        clp.page(2);
        tinymce.remove();
        tinymce.init({
          selector : "#cla_text",
          menubar : false,
          plugins: "lists link",
          toolbar: "bold italic underline | forecolor | bullist numlist | alignleft aligncenter alignright alignjustify | link"
        });
      }
    });
  },

  // (E) SAVE CLASSIFIED AD
  save : () => {
    // (E1) MANUAL CHECK TINYMCE TEXT (HTML REQUIRED DOES NOT WORK)
    var text = tinymce.get("cla_text").getContent();
    if (text=="") {
      clp.modal("Error", "Please fill in the classified text.");
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
    clp.api({
      mod : "classified",
      req : "save",
      data : data,
      passmsg : "Classified Ad Saved",
      onpass : cla.list
    });
    return false;
  },

  // (F) DELETE CLASSIFIED AD
  //  id : int, classified ID
  //  confirm : boolean, confirmed delete
  del : (id, confirm) => {
    if (confirm) {
      clp.api({
        mod : "classified",
        req : "del",
        data : { id: id },
        passmsg : "Classified Ad Deleted",
        onpass : cla.list
      });
    } else {
      clp.modal("Please confirm", "Delete this entry?", () => {
        cla.del(id, true);
      });
    }
  }
};

var img = {
  // (A) INITIALIZE & SETUP IMAGE PICKER
  loaded : false, // ALREADY INITIALIZED?
  slot : 0, // CURRENT SELECTED SLOT
  init : (slot) => {
    img.slot = slot;
    clp.page(3);
    if (!img.loaded) {
      document.getElementById("clp-page-3").innerHTML = '<div id="img-list" class="row"></div>';
      img.loaded = true;
      img.list();
    }
  },

  // (B) LOAD IMAGES
  pg : 1, // CURRENT PAGE
  list : () => {
    clp.load({
      page : "img/list",
      target : "img-list",
      data : {
        page : img.pg,
        pick : true,
      }
    });
  },

  // (C) GO TO PAGE
  //  pg : int, page number
  goToPage : (pg) => { if (pg!=img.pg) {
    img.pg = pg;
    img.list();
  }},

  // (C) PICK IMAGE
  pick : (i) => {
    // (C1) BACK TO FORM
    clp.page(2);

    // (C2) CREATE NEW IMAGE TAG
    var slot = img.slot,
        wrap = document.getElementById("cla_img_" + img.slot),
        nimg = document.createElement("img");
    nimg.src = clphost.uploads + i;
    nimg.className = "img-thumbnail cla-img";
    nimg.onclick = () => { img.remove(slot); };
    wrap.innerHTML = "";
    wrap.appendChild(nimg);
  },

  // (D) REMOVE IMAGE
  //  slot : image slot number
  remove : (slot) => {
    var wrap = document.getElementById("cla_img_" + slot),
        nbtn = document.createElement("button");
    nbtn.className = "cla-img btn btn-primary btn-sm w-100 mb-3";
    nbtn.type = "button";
    nbtn.innerHTML = "Choose an image";
    nbtn.onclick = () => { img.init(slot); };
    wrap.innerHTML = "";
    wrap.appendChild(nbtn);
  }
};
window.addEventListener("load", cla.list);
