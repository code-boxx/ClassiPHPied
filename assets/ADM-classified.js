var cla = {
  // (A) SHOW ALL CLASSIFIED ADS
  pg : 1, // current page
  find : "", // current search
  id : "", // current category
  list : () =>  {
    cb.page(0);
    cb.load({
      page : "admin/cla/list", target : "cla-list",
      data : {
        page : cla.pg,
        id : cla.id,
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
    cla.id = document.getElementById("cla-cat").value;
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
      end : document.getElementById("cla_end").value,
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
window.addEventListener("load", cla.list);