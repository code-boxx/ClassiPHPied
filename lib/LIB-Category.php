<?php
class Category extends Core {
  // (A) ADD OR UPDATE CATEGORY
  //  $name : category name
  //  $desc : category description
  //  $parent : parent category
  //  $id : category id (for updating only)
  function save ($name, $desc=null, $parent=0, $id=null) {
    // (A1) DATA SETUP
    $fields = ["cat_name", "cat_desc", "parent_id"];
    $data = [$name, $desc, $parent];

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

  // (D) GET ALL CATEGORIES - "NOT IN ORDER, BUT WITH PAGINATION"
  //  $search : optional, search term
  //  $page : optional, current page number
  function getAll ($search=null, $page=null) {
    // (D1) PARITAL USERS SQL + DATA
    $sql = "";
    $data = null;
    if ($search != null) {
      $sql = " WHERE `cat_name` LIKE ? OR `cat_desc` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }

    // (D2) PAGINATION
    if ($page != null) {
      $this->Core->paginator(
        $this->DB->fetchCol("SELECT COUNT(*) FROM `categories` c$sql", $data), $page
      );
      $sql .= $this->Core->page["lim"];
    }

    // (D3) RESULTS
    return $this->DB->fetchAll(
      "SELECT c.*, cc.`cat_name` AS `parent_name` FROM `categories` c
       LEFT JOIN `categories` cc ON (c.`parent_id`=cc.`cat_id`)$sql",
       $data, "cat_id"
    );
  }

  // (E) RECURSIVE GET ALL CATEGORIES - "IN HIERARCHY ORDER"
  //  $id : parent id
  function getAllR ($id=0) {
    // (E1) GET CATEGORIES WITH GIVEN PARENT ID
    $this->DB->query("SELECT * FROM `categories` WHERE `parent_id`=?", [$id]);
    $cat = [];
    while ($r = $this->DB->stmt->fetch()) {
      $cat[$r["cat_id"]] = [
        "n" => $r["cat_name"],
        "d" => $r["cat_desc"],
        "c" => null
      ];
    }

    // (E2) GET CHILDREN
    if (count($cat)>0) {
      foreach ($cat as $id => $c) { $cat[$id]["c"] = $this->getAllR($id); }
      return $cat;
    } else { return null; }
  }

  // (F) GET ALL CHILD CATEGORIES
  function getChildren ($id) {
    $this->DB->query("SELECT `cat_id` FROM `categories` WHERE `parent_id`=?", [$id]);
    $cat = $this->DB->stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($cat as $cid) {
      $cat = array_merge($cat, $this->getChildren($cid));
    }
    return $cat;
  }

  // (G) GET POSSIBLE PARENTS
  function getSwitchable ($id=null) {
    // (G1) NEW CATEGORY - GET ALL CATEGORIES BY DEFAULT
    $sql = "SELECT * FROM `categories`";

    // (G2) EDIT CATEGORY - REMOVE CHILD CATEGORIES AND SELF
    if ($id != null) {
      $notin = $this->getChildren($id);
      $notin[] = $id;
      $sql .= " WHERE `cat_id` NOT IN (".implode(",", $notin).")";
    }

    // (E3) RESULT
    return $this->DB->fetchKV($sql, null, "cat_id", "cat_name");
  }
}