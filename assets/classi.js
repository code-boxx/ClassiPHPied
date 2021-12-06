var cla = {
  // (A) SHOW SELECTED CATEGORY
  cid : null, // category id
  page : 1, // current page
  cat : () => {
    cla.cid = document.getElementById("cla-cat").value;
    cla.page = 1;
    cla.list();
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : (pg) => { if (pg!=cla.page) {
    cla.page = pg;
    cla.list();
  }},

  // (C) LOAD LISTING
  list : () => {
    // (C1) FORM DATA
    var data = new FormData();
    data.append("id", cla.cid==null?"":cla.cid);
    data.append("page", cla.page);

    // (C2) AJAX LOAD
    fetch(cbhost.base + "a/clist", { method:"POST", body:data })
    .then((res)=>res.text())
    .then((txt) => {
      document.getElementById("cla-list").innerHTML = txt;
    });
  }
};
window.addEventListener("DOMContentLoaded", cla.list);
