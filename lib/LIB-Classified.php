<?php
class Classified extends Core {
  // (A) ADD OR UPDATE CLASSIFIED AD
  //  $title : title
  //  $summary : summary
  //  $text : text
  //  $images : JSON encoded string of image file names
  //  $cat : category
  //  $person : contact person/client name
  //  $email : (optional) contact email/client email
  //  $tel : (optional) contact email/client telephone
  //  $id : (for update only) classified id
  function save ($title, $summary, $text, $images, $cat, $person, $email=null, $tel=null, $id=null) {
    // (A1) DATA SETUP
    $fields = ["cla_title", "cla_summary", "cla_text", "cla_person", "cla_email", "cla_tel"];
    $data = [$title, $summary, $text, $person, $email, $tel];
    $this->DB->start();

    // (A2) ADD/UPDATE CLASSIFIED
    if ($id===null) {
      $pass = $this->DB->insert("classifieds", $fields, $data);
    } else {
      $data[] = $id;
      $pass = $this->DB->update("classifieds", $fields, "`cla_id`=?", $data);
    }

    // (A3) UPDATE CATEGORY
    // * NOTE : THIS IS RESTRICTED TO A SINGLE CATEGORY
    // UPDATE THIS SECTION IF YOU WANT TO ASSIGN MULTIPLE CATEGORIES
    // CHANGE $CAT TO AN ARRAY & INSERT ACCORDINGLY
    if ($pass) {
      if ($id===null) { $id = $this->DB->pdo->lastInsertId(); }
      else { $pass = $this->DB->query("DELETE FROM `cla_to_cat` WHERE `cla_id`=?", [$id]); }
      if ($pass && $cat!==null && $cat!=="") {
        $pass = $this->DB->insert("cla_to_cat", ["cla_id", "cat_id"], [$id, $cat]);
      }
    }

    // (A4) REMOVE OLD IMAGES
    if ($pass) {
      $pass = $this->DB->query("DELETE FROM `cla_images` WHERE `cla_id`=?", [$id]);
    }

    // (A5) ADD NEW IMAGES
    if ($pass) {
      $images = json_decode($images, true);
      $slot = 1;
      foreach ($images as $k=>$img) {
        if ($img!="" && $img!=null && $img!=false) {
          $pass = $this->DB->insert("cla_images",
            ["cla_id", "slot_id", "img_file"],
            [$id, $slot, $img]
          );
          if ($pass) { $slot++; }
          else { break; }
        }
      }
    }

    // (A6) DONE
    $this->DB->end($pass);
    return $pass;
  }

  // (B) DELETE CLASSIFIED AD
  //  $id : classified id
  function del ($id) {
    $this->DB->start();
    $pass = $this->DB->query("DELETE FROM `classifieds` WHERE `cla_id`=?", [$id]);
    if ($pass) { $this->DB->query("DELETE FROM `cla_to_cat` WHERE `cla_id`=?", [$id]); }
    if ($pass) { $pass = $this->DB->query("DELETE FROM `cla_images` WHERE `cla_id`=?", [$id]); }
    $this->DB->end($pass);
    return $pass;
  }

  // (C) GET CLASSIFIED AD
  //  $id : classified id
  function get ($id) {
    // (C1) GET MAIN ENTRY
    // * NOTE : IT IS POSSIBLE TO ASSIGN MULTIPLE CATEGORIES
    // CHANGE THIS SQL IF YOU DECIDE TO ALLOW MULTIPLE CATEGORIES
    $cla = $this->DB->fetch(
      "SELECT c.*, cc.`cat_id`
       FROM `classifieds` c LEFT JOIN `cla_to_cat` cc
       USING(`cla_id`) WHERE c.`cla_id`=?",
      [$id]
    );
    if ($cla===false) { return false; }
    if ($cla===null) { return null; }

    // (C2) GET IMAGES
    $cla["images"] = $this->DB->fetchAll(
      "SELECT `slot_id`, `img_file` FROM `cla_images` WHERE `cla_id`=?",
      [$id], "slot_id"
    );

    // (C3) RESULTS
    return $cla;
  }

  // (D) COUNT (FOR SEARCH & PAGINATION)
  //  $search : optional, search term
  function count ($search=null) {
    $sql = "SELECT COUNT(*) FROM `classifieds`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `cla_title` LIKE ? OR `cla_text` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    return $this->DB->fetchCol($sql, $data);
  }

  // (E) GET ALL OR SEARCH CLASSIFIED ADS
  //  $search : optional, search term
  //  $page : optional, current page number
  function getAll ($search=null, $page=1) {
    // (E1) PAGINATION
    $entries = $this->count($search);
    if ($entries===false) { return false; }
    $pgn = $this->core->paginator($entries, $page);

    // (E2) GET CLASSIFIED ADS
    $sql = "SELECT `cla_id`, `cla_title`, `cla_summary`, `cla_date`, `cla_person`, `cla_email`, `cla_tel` FROM `classifieds`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `cla_title` LIKE ? OR `cla_text` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    $sql .= " ORDER BY `cla_date` DESC LIMIT {$pgn["x"]}, {$pgn["y"]}";
    $entries = $this->DB->fetchAll($sql, $data, "cla_id");
    if ($entries===false) { return false; }

    // (E3) RESULTS
    return ["data" => $entries, "page" => $pgn];
  }

  // (F) COUNT BY CATEGORY (FOR PAGINATION)
  //  $id : optional, category id
  function countByCat ($id=null) {
    $sql = $id===null || $id==""
      ? "SELECT COUNT(*) FROM `classifieds`"
      : "SELECT COUNT(*) FROM `cla_to_cat` WHERE `cat_id`=?";
    $data = $id===null || $id=="" ? null : [$id];
    return $this->DB->fetchCol($sql, $data);
  }

  // (G) GET ALL BY CATEGORY
  //  $id : optional, category id
  //  $page : optional, current page number
  function getAllByCat ($id=null, $page=1) {
    // (G1) PAGINATION
    $entries = $this->countByCat($id);
    if ($entries===false) { return false; }
    $pgn = $this->core->paginator($entries, $page);

    // (G2) GET CLASSIFIED ADS
    $sql = "SELECT c.`cla_id`, c.`cla_title`, c.`cla_summary`, c.`cla_date`, ci.`img_file`, cat.`cat_name`
            FROM `classifieds` c
            LEFT JOIN `cla_images` ci ON (c.`cla_id`=ci.`cla_id` AND ci.`slot_id`=1)
            LEFT JOIN `cla_to_cat` cc ON (cc.`cla_id`=c.`cla_id`)
            LEFT JOIN `categories` cat ON (cc.`cat_id`=cat.`cat_id`)";
    $data = null;
    if ($id!==null && $id!="") {
      $sql .= " WHERE cc.`cat_id`=?";
      $data = [$id];
    }
    $sql .= " ORDER BY c.`cla_date` DESC LIMIT {$pgn["x"]}, {$pgn["y"]}";
    $entries = $this->DB->fetchAll($sql, $data, "cla_id");
    if ($entries===false) { return false; }

    // (G3) RESULTS
    return ["data" => $entries, "page" => $pgn];
  }
}
