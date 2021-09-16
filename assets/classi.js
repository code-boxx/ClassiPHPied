var cla = {
  // (A) SHOW SELECTED CATEGORY
  cid : null, // category id
  page : 1, // current page
  cat : function (id) {
    cla.cid = id;
    cla.page = 1;
    cla.list();
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : function (pg) { if (pg!=cla.page) {
    cla.page = pg;
    cla.list();
  }},

  // (C) LOAD LISTING
  list : function () {
    // (C1) FORM DATA
    var data = new FormData();
    data.append("id", cla.cid==null?"":cla.cid);
    data.append("page", cla.page);

    // (C2) AJAX LOAD
    var xhr = new XMLHttpRequest();
    xhr.open("POST", clphost.base + "a/clist");
    xhr.onload = function () {
      document.getElementById("cla-list").innerHTML = this.response;
    };
    xhr.send(data);
  }
};
window.addEventListener("DOMContentLoaded", cla.list);
