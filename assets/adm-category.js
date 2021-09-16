var cat = {
  // (A) SHOW ALL CATEGORIES
  pg : 1, // CURRENT PAGE
  find : "", // CURRENT SEARCH
  list : function ()  {
    clp.page(1);
    clp.load({
      page : "cat/list",
      target : "cat-list",
      data : {
        page : cat.pg,
        search : cat.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : function (pg) { if (pg!=cat.pg) {
    cat.pg = pg;
    cat.list();
  }},

  // (C) SEARCH CATEGORIES
  search : function () {
    cat.find = document.getElementById("cat-search").value;
    cat.pg = 1;
    cat.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // id : category ID, for edit only
  addEdit : function (id) {
    clp.load({
      page : "cat/form",
      target : "clp-page-2",
      data : { id : id ? id : "" },
      onload : function () { clp.page(2); }
    });
  },

  // (E) SAVE CATEGORY
  save : function () {
    // (E1) GET DATA
    var data = {
      name : document.getElementById("cat_name").value,
      desc : document.getElementById("cat_desc").value
    };
    var id = document.getElementById("cat_id").value;
    if (id!="") { data.id = id; }
    // (E2) AJAX
    clp.api({
      mod : "category",
      req : "save",
      data : data,
      passmsg : "Category Saved",
      onpass : cat.list
    });
    return false;
  },

  // (F) DELETE CATEGORY
  //  id : int, category ID
  //  confirm : boolean, confirmed delete
  del : function (id, confirm) {
    if (confirm) {
      clp.api({
        mod : "category",
        req : "del",
        data : { id: id },
        passmsg : "Category Deleted",
        onpass : cat.list
      });
    } else {
      clp.modal("Please confirm", "Delete category?", function(){
        cat.del(id, true);
      });
    }
  }
};
window.addEventListener("load", cat.list);
