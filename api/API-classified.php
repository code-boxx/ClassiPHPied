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

  // (C) SAVE CLASSIFIED AD
  case "save":
    $_CORE->autoAPI("Classified", "save");
    break;

  // (D) DELETE CLASSIFIED AD
  case "del":
    $_CORE->autoAPI("Classified", "del");
    break;
}
