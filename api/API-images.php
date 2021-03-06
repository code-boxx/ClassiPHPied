<?php
// (A) REGISTERED USERS ONLY
if (!isset($_SESS["user"])) {
  $_CORE->respond(0, "Please sign in first", null, null, 403);
}

switch ($_REQ) {
  // (B) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (C) UPLOAD FILE
  case "upload":
    $_CORE->autoAPI("Images", "upload");
    break;

  // (D) DELETE FILE
  case "del":
    $_CORE->autoAPI("Images", "del");
    break;
}
