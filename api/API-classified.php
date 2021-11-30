<?php
// (A) MUST BE SIGNED IN
if ($_USER===false) {
  $_CORE->respond("E", "Please sign in first", null, null, 403);
}

switch ($_REQ) {
  // (B) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
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
