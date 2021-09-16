var img = {
  // (A) SHOW ALL IMAGES
  pg : 1, // CURRENT PAGE
  list : function ()  {
    clp.page(1);
    clp.load({
      page : "img/list",
      target : "img-list",
      data : { page : img.pg }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : function (pg) { if (pg!=img.pg) {
    img.pg = pg;
    img.list();
  }},

  // (C) COPY LINK
  //  i : image file
  copy : function (i) {
    navigator.clipboard.writeText(clphost.uploads + i).then(function() {
      clp.toast(1, "Success", "Link copied");
    }, function() {
      clp.toast(0, "Failed", "No permission to access clipboard");
    });
  },

  // (D) DELETE IMAGE
  //  i : image file
  //  confirm : boolean, confirmed delete
  del : function (i, confirm) {
    if (confirm) {
      clp.api({
        mod : "images",
        req : "del",
        data : { file: i },
        passmsg : "Image Deleted",
        onpass : img.list
      });
    } else {
      clp.modal("Please confirm", "Delete image?", function(){
        img.del(i, true);
      });
    }
  },

  // (E) UPLOAD IMAGE (ONE AT A TIME)
  //  i : current upload file number (none to start new upload session)
  upqueue : {
    list : null, // upload list
    now : 0, // current file
    all : 0 // all files
  },
  upload : function (i) {
    // (E1) NEW UPLOAD
    if (i==undefined) {
      clp.loading(1);
      var field = document.getElementById("img-up");
      img.upqueue.list = field.files;
      img.upqueue.now = 0;
      img.upqueue.all = field.files.length;
      img.upload(img.upqueue.now);
      return false;
    }

    // (E2) PROCEED AJAX UPLOAD
    else {
      clp.api({
        mod : "images",
        req : "upload",
        data : { "upfile": img.upqueue.list[img.upqueue.now] },
        loading : false,
        passmsg : "Image Uploaded",
        onpass : function () {
          img.upqueue.now++;
          if (img.upqueue.now == img.upqueue.all) {
            clp.loading(0);
            img.list();
          } else {
            img.upload(img.upqueue.now);
          }
        }
      });
    }
  }
};
window.addEventListener("load", img.list);
