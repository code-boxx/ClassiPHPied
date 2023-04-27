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
  //  $end : (optional) classified end date
  //  $id : (for update only) classified id
  function save ($title, $summary, $text, $images, $cat, $person, $email=null, $tel=null, $end=null, $id=null) {
    // (A1) DATA SETUP
    if ($end=="") { $end = null; }
    $fields = ["cla_title", "cla_summary", "cla_text", "cla_person", "cla_email", "cla_tel", "cla_end"];
    $data = [$title, $summary, $text, $person, $email, $tel, $end];
    $this->DB->start();

    // (A2) ADD/UPDATE CLASSIFIED
    if ($id===null) {
      $this->DB->insert("classifieds", $fields, $data);
    } else {
      $data[] = $id;
      $this->DB->update("classifieds", $fields, "`cla_id`=?", $data);
    }

    // (A3) UPDATE CATEGORY
    // * NOTE : THIS IS RESTRICTED TO A SINGLE CATEGORY
    // UPDATE THIS SECTION IF YOU WANT TO ASSIGN MULTIPLE CATEGORIES
    // CHANGE $CAT TO AN ARRAY & INSERT ACCORDINGLY
    if ($id===null) { $id = $this->DB->pdo->lastInsertId(); }
    else { $this->DB->delete("cla_to_cat", "`cla_id`=?", [$id]); }
    if ($cat!==null && $cat!=="") {
      $this->DB->insert("cla_to_cat", ["cla_id", "cat_id"], [$id, $cat]);
    }

    // (A4) REMOVE OLD IMAGES
    $this->DB->delete("cla_images", "`cla_id`=?", [$id]);

    // (A5) ADD NEW IMAGES
    $images = json_decode($images, true);
    $slot = 1;
    foreach ($images as $k=>$img) { if ($img!="" && $img!=null && $img!=false) {
      $this->DB->insert("cla_images",
        ["cla_id", "slot_id", "img_file"],
        [$id, $slot, $img]
      );
      $slot++;
    }}

    // (A6) DONE
    $this->DB->end();
    return true;
  }

  // (B) DELETE CLASSIFIED AD
  //  $id : classified id
  function del ($id) {
    $this->DB->start();
    $this->DB->delete("classifieds", "`cla_id`=?", [$id]);
    $this->DB->delete("cla_to_cat", "`cla_id`=?", [$id]);
    $this->DB->delete("cla_images", "`cla_id`=?", [$id]);
    $this->DB->end();
    return true;
  }

  // (C) GET CLASSIFIED AD
  //  $id : classified id
  function get ($id) {
    // (C1) GET MAIN ENTRY
    // * NOTE : IT IS POSSIBLE TO ASSIGN MULTIPLE CATEGORIES
    // CHANGE THIS SQL IF YOU DECIDE TO ALLOW MULTIPLE CATEGORIES
    $cla = $this->DB->fetch(
      "SELECT c.*, cc.`cat_id`,
       DATE_FORMAT(c.`cla_date`, '".DT_LONG."') `cd`, DATE_FORMAT(c.`cla_end`, '".DT_LONG."') `ed`
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

  // (D) GET ALL OR SEARCH CLASSIFIED ADS
  //  $search : optional, search term
  //  $id : optional, category id
  //  $end : exclude ads that have ended? default false.
  //  $page : optional, current page number
  function getAll ($search=null, $id=null, $end=false, $page=null) {
    // (D1) PARTIAL SQL
    $where = "";
    $data = null;
    if ($search != null) {
      $where = " WHERE (c.`cla_title` LIKE ? OR c.`cla_text` LIKE ?)";
      $data = ["%$search%", "%$search%"];
    }
    if ($id != null) {
      if ($where == "") {
        $where = " WHERE cc.`cat_id`=?";
        $data = [$id];
      } else {
        $where .= " AND cc.`cat_id`=?" ;
        $data[] = $id;
      }
    }
    if ($end) {
      if ($where == "") {
        $where = " WHERE c.`cla_end` IS NULL OR c.cla_end >= ?";
        $data = [date("Y-m-d 00:00:00")];
      } else {
        $where .= " AND (c.`cla_end` IS NULL OR c.cla_end >= ?)";
        $data[] = date("Y-m-d 00:00:00");
      }
    }

    // (D2) PAGINATION
    if ($page != null) {
      $this->Core->paginator(
        $this->DB->fetchCol(
          "SELECT COUNT(*)
           FROM `classifieds` c
           LEFT JOIN `cla_to_cat` cc USING (`cla_id`)$where", $data),
        $page
      );
    }

    // (D3) GET CLASSIFIED ADS
    $sql = "SELECT c.`cla_id`, c.`cla_title`, c.`cla_summary`, c.`cla_date`, c.`cla_end`, ci.`img_file`, cat.`cat_name`,
            DATE_FORMAT(c.`cla_date`, '".DT_LONG."') `cd`, DATE_FORMAT(c.`cla_end`, '".DT_LONG."') `ce`
            FROM `classifieds` c
            LEFT JOIN `cla_images` ci ON (c.`cla_id`=ci.`cla_id` AND ci.`slot_id`=1)
            LEFT JOIN `cla_to_cat` cc ON (cc.`cla_id`=c.`cla_id`)
            LEFT JOIN `categories` cat ON (cc.`cat_id`=cat.`cat_id`)$where
            ORDER BY c.`cla_date` DESC";
    if ($page != null) { $sql .= $this->Core->page["lim"]; }
    return $this->DB->fetchAll($sql, $data, "cla_id");
  }

  // (E) GET IN CATEGORY
  //  $id : category id
  function getInCat ($id) {
    $sql = "SELECT c.`cla_id`, c.`cla_title`, c.`cla_summary`, c.`cla_date`, c.`cla_end`, ci.`img_file`,
            DATE_FORMAT(c.`cla_date`, '".DT_LONG."') `cd`, DATE_FORMAT(c.`cla_end`, '".DT_LONG."') `ce`
            FROM `classifieds` c
            LEFT JOIN `cla_images` ci ON (c.`cla_id`=ci.`cla_id` AND ci.`slot_id`=1)
            LEFT JOIN `cla_to_cat` cc ON (cc.`cla_id`=c.`cla_id`)
            WHERE cc.`cat_id`=?
            ORDER BY c.`cla_date` DESC";
    return $this->DB->fetchAll($sql, [$id], "cla_id");
  }
}