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
      return $this->DB->insert("categories", $fields, $data);
    } else {
      $data[] = $id;
      return $this->DB->update("categories", $fields, "`cat_id`=?", $data);
    }
  }

  // (B) DELETE CATEGORY
  //  $id : category id
  function del ($id) {
    $this->DB->start();
    $pass = $this->DB->query("DELETE FROM `categories` WHERE `cat_id`=?", [$id]);
    if ($pass) { $this->DB->query("DELETE FROM `cla_to_cat` WHERE `cat_id`=?", [$id]); }
    $this->DB->end($pass);
    return $pass;
  }

  // (C) GET CATEGORY
  //  $id : category id
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `categories` WHERE `cat_id`=?",
      [$id]
    );
  }

  // (D) COUNT (FOR SEARCH & PAGINATION)
  //  $search : optional, search term
  function count ($search=null) {
    $sql = "SELECT COUNT(*) FROM `categories`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `cat_name` LIKE ? OR `cat_desc` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    return $this->DB->fetchCol($sql, $data);
  }

  // (E) GET ALL OR SEARCH CATEGORY
  //  $search : optional, search term
  //  $page : optional, current page number (use "A" to fetch all)
  function getAll ($search=null, $page=1) {
    // (E1) PAGINATION
    if ($page!="A") {
      $entries = $this->count($search);
      if ($entries===false) { return false; }
      $pgn = $this->core->paginator($entries, $page);
    }

    // (E2) GET CATEGORIES
    $sql = "SELECT * FROM `categories`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `cat_name` LIKE ? OR `cat_desc` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    if ($page!="A") { $sql .= " LIMIT {$pgn["x"]}, {$pgn["y"]}"; }
    $cat = $this->DB->fetchAll($sql, $data, "cat_id");
    if ($cat===false) { return false; }

    // (E3) RESULTS
    if ($page=="A") { return $cat; }
    else { return ["data" => $cat, "page" => $pgn]; }
  }
}
