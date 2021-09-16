<?php
// (A) MUST BE SIGNED IN
if (!isset($_SESSION["user"])) {
  $_CORE->respond("E", "Please sign in first");
}

switch ($_REQ) {
  // (B) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (C) SAVE CATEGORY
  case "save":
    $_CORE->autoAPI("Category", "save");
    break;

  // (D) DELETE CATEGORY
  case "del":
    $_CORE->autoAPI("Category", "del");
    break;
}
