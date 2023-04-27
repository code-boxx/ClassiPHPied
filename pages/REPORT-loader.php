<?php
// (A) FOR ADMIN ONLY
$_CORE->ucheck("A");

// (B) REQUESTED REPORT
$req = explode("/", $_CORE->Route->path);
if (count($req)!=3) { exit("Invalid report"); }

// (C) GENERATE REPORT
$_CORE->autoCall("Report", $req[1]);