<?php
// CALLED BY $_CORE->ROUTES->RESOLVE()
// USE THIS TO OVERRIDE URL PAGE ROUTES

$wild = [
  "admin/" => "ADM-check.php",
  "category/" => "PAGE-category.php",
  "show/" => "PAGE-show.php",
  "report/" => "REPORT-loader.php"
];