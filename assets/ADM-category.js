var cat = {
  // (A) SHOW ALL CATEGORIES
  pg : 1, // current page
  find : "", // current search
  list : () => {
    cb.page(0);
    cb.load({
      page : "admin/cat/list", target : "cat-list",
      data : {
        page : cat.pg,
        search : cat.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : pg => { if (pg!=cat.pg) {
    cat.pg = pg;
    cat.list();
  }},

  // (C) SEARCH CATEGORIES
  search : () => {
    cat.find = document.getElementById("cat-search").value;
    cat.pg = 1;
    cat.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // id : category ID, for edit only
  addEdit : id => cb.load({
    page : "admin/cat/form", target : "cb-page-2",
    data : { id : id ? id : "" },
    onload : () => cb.page(1)
  }),

  // (E) SAVE CATEGORY
  save : () => {
    // (E1) GET DATA
    var data = {
      name : document.getElementById("cat_name").value,
      desc : document.getElementById("cat_desc").value
    };
    var id = document.getElementById("cat_id").value;
    if (id!="") { data.id = id; }

    // (E2) AJAX
    cb.api({
      mod : "category", req : "save",
      data : data,
      passmsg : "Category Saved",
      onpass : cat.list
    });
    return false;
  },

  // (F) DELETE CATEGORY
  //  id : int, category ID
  //  confirm : boolean, confirmed delete
  del : id => cb.modal("Please confirm", "Delete category?", () => cb.api({
    mod : "category", req : "del",
    data : { id : id },
    passmsg : "Category Deleted",
    onpass : cat.list
  }))
};
window.addEventListener("load", cat.list);