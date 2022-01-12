<?php
// (A) FOR ADMIN ONLY
if (!isset($_SESS["user"]) && $_PATH!="login/") {
  if ($_POST["ajax"]) { exit("SE"); } // POSSIBLE SESSION EXPIRE IN AJAX LOAD
  $_CORE->redirect("login", HOST_ADMIN_BASE);
}

// (B) AUTO RESOLVE PATH
$_CORE->Route->pathload ($_PATH, "ADM");
