<?php
class Category extends Core {
  // (A) ADD OR UPDATE CATEGORY
  //  $name : category name
  //  $desc : category description
  //  $id : category id (for updating only)
  function save ($name, $desc=null, $id=null) {
    // (A1) DATA SETUP
    $fields = ["cat_name", "cat_desc"];
    $data = [$name, $desc];

    // (A2) ADD/UPDATE CATEGORY
    if ($id===null) {
      $this->DB->insert("categories", $fields, $data);
    } else {
      $data[] = $id;
      $this->DB->update("categories", $fields, "`cat_id`=?", $data);
    }
    return true;
  }

  // (B) DELETE CATEGORY
  //  $id : category id
  function del ($id) {
    $this->DB->start();
    $this->DB->delete("categories", "`cat_id`=?", [$id]);
    $this->DB->delete("cla_to_cat", "`cat_id`=?", [$id]);
    $this->DB->end();
    return true;
  }

  // (C) GET CATEGORY
  //  $id : category id
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `categories` WHERE `cat_id`=?", [$id]
    );
  }

  // (D) GET ALL OR SEARCH CATEGORY
  //  $search : optional, search term
  //  $page : optional, current page number
  function getAll ($search=null, $page=null) {
    // (D1) PARITAL USERS SQL + DATA
    $sql = "FROM `categories`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `cat_name` LIKE ? OR `cat_desc` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }

    // (D2) PAGINATION
    if ($page != null) {
      $this->core->paginator(
        $this->DB->fetchCol("SELECT COUNT(*) $sql", $data), $page
      );
      $sql .= $this->core->page["lim"];
    }

    // (D3) RESULTS
    return $this->DB->fetchAll("SELECT * $sql", $data, "cat_id");
  }
}