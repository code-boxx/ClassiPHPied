var img = {
  // (A) SHOW ALL IMAGES
  pg : 1, // current page
  find : "", // current search
  list : () => {
    cb.page(0);
    cb.load({
      page : "admin/img/list",
      target : "img-list",
      data : {
        page : img.pg,
        search : img.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : pg => { if (pg!=img.pg) {
    img.pg = pg;
    img.list();
  }},

  // (C) SEARCH IMAGE
  search : () => {
    img.find = document.getElementById("img-search").value;
    img.pg = 1;
    img.list();
    return false;
  },

  // (D) COPY LINK
  //  i : image file
  copy : i => {
    navigator.clipboard.writeText(cbhost.uploads + i)
    .then(
      () => cb.toast(1, "Success", "Link copied"),
      () => cb.toast(0, "Failed", "No permission to access clipboard")
    )
    .catch(err => console.error(err));
  },

  // (E) DELETE IMAGE
  //  i : image file
  //  confirm : boolean, confirmed delete
  del : i => cb.modal("Please confirm", "Delete image?", () => cb.api({
    mod : "images", req : "del",
    data : { file: i },
    passmsg : "Image Deleted",
    onpass : img.list
  })),

  // (F) UPLOAD IMAGE (ONE AT A TIME)
  //  i : current upload file number (none to start new upload session)
  upqueue : {
    list : null, // upload list
    now : 0, // current file
    all : 0 // all files
  },
  upload : i => {
    // (F1) NEW UPLOAD
    if (i==undefined) {
      cb.loading(1);
      var field = document.getElementById("img-up");
      img.upqueue.list = field.files;
      img.upqueue.now = 0;
      img.upqueue.all = field.files.length;
      img.upload(img.upqueue.now);
      return false;
    }

    // (F2) PROCEED AJAX UPLOAD
    else {
      cb.api({
        mod : "images", req : "upload",
        data : { "upfile": img.upqueue.list[img.upqueue.now] },
        loading : false,
        passmsg : "Image Uploaded",
        onpass : () => {
          img.upqueue.now++;
          if (img.upqueue.now == img.upqueue.all) {
            cb.loading(0);
            document.getElementById("img-up").value = "";
            img.list();
          } else {
            img.upload(img.upqueue.now);
          }
        },
        onfail : () => {
          cb.loading(0);
          document.getElementById("img-up").value = "";
          img.list();
        }
      });
    }
  }
};
window.addEventListener("load", img.list);