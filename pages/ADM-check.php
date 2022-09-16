<?php
// (A) FOR ADMIN ONLY
if (!isset($_SESS["user"]) && $_PATH!="admin/login/") {
  if ($_POST["ajax"]) { exit("E"); }
  $_CORE->redirect("admin/login/");
}

// (B) LOAD REQUESTED PAGE
$_PATH = explode("/", rtrim($_PATH, "/\\"));
array_shift($_PATH);
$_CORE->Route->load(
  count($_PATH)==0 ? "ADM-home.php" : "ADM-" . implode("-", $_PATH) . ".php"
);