<?php
// (A) FOR ADMIN ONLY
if (!isset($_CORE->Session->data["user"]) && $_CORE->Route->path!="admin/login/") {
  if (isset($_POST["ajax"])) { exit("E"); }
  $_CORE->redirect("admin/login/");
}

// (B) REQUESTED REPORT
$req = explode("/", $_CORE->Route->path);
if (count($req)!=3) { exit("Invalid report"); }

// (C) GENERATE REPORT
$_CORE->autoCall("Report", $req[1]);