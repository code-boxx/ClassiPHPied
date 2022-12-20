<?php
// (A) FOR ADMIN ONLY
if (!isset($_SESS["user"])) {
  if ($_POST["ajax"]) { exit("E"); }
  $_CORE->redirect("admin/login/");
}

// (B) GENERATE REPORT
$_PATH = explode("/", $_PATH);
if (count($_PATH)!=3) { exit("Invalid report"); }
$_CORE->autoCall("Report", $_PATH[1]);