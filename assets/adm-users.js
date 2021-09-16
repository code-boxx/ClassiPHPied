var usr = {
  // (A) SHOW ALL USERS
  pg : 1, // CURRENT PAGE
  find : "", // CURRENT SEARCH
  list : function ()  {
    clp.page(1);
    clp.load({
      page : "users/list",
      target : "user-list",
      data : {
        page : usr.pg,
        search : usr.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : function (pg) { if (pg!=usr.pg) {
    usr.pg = pg;
    usr.list();
  }},

  // (C) SEARCH USER
  search : function () {
    usr.find = document.getElementById("user-search").value;
    usr.pg = 1;
    usr.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // id : user ID, for edit only
  addEdit : function (id) {
    clp.load({
      page : "users/form",
      target : "clp-page-2",
      data : { id : id ? id : "" },
      onload : function () { clp.page(2); }
    });
  },

  // (E) SAVE USER
  save : function () {
    // (E1) GET DATA
    var data = {
      name : document.getElementById("user_name").value,
      email : document.getElementById("user_email").value,
      password : document.getElementById("user_password").value
    };
    var id = document.getElementById("user_id").value;
    if (id!="") { data.id = id; }

    // (E2) AJAX
    clp.api({
      mod : "users",
      req : "save",
      data : data,
      passmsg : "User Saved",
      onpass : usr.list
    });
    return false;
  },

  // (F) DELETE USER
  //  id : int, user ID
  //  confirm : boolean, confirmed delete
  del : function (id, confirm) {
    if (confirm) {
      clp.api({
        mod : "users",
        req : "del",
        data : { id: id },
        passmsg : "User Deleted",
        onpass : usr.list
      });
    } else {
      clp.modal("Please confirm", "Delete user?", function(){
        usr.del(id, true);
      });
    }
  }
};
window.addEventListener("load", usr.list);
