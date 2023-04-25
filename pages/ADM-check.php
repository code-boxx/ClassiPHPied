<?php
// (A) FOR ADMIN ONLY
if (!isset($_CORE->Session->data["user"]) && $_CORE->Route->path!="admin/login/") {
  if (isset($_POST["ajax"])) { exit("E"); }
  $_CORE->redirect("admin/login/");
}

// (B) STRIP "ADMIN/" FROM PATH
$_CORE->Route->path = substr($_CORE->Route->path, 6);

// (C) OK - LOAD PAGE
$_CORE->Route->load($_CORE->Route->path==""
  ? "ADM-home.php"
  : "ADM-" . str_replace("/", "-", rtrim($_CORE->Route->path, "/\\")) . ".php"
);