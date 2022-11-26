var cla = {
  // (A) SHOW ALL CLASSIFIED ADS
  pg : 1, // current page
  find : "", // current search
  id : "", // current category
  list : () => cb.load({
    page : "cla/list", target : "cla-list",
    data : {
      page : cla.pg,
      id : cla.id,
      search : cla.find
    }
  }),

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
  }
};
window.addEventListener("load", cla.list);