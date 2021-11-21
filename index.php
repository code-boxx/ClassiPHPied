<?php
// (A) LOAD CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "GO.php";

// (B) GENERATE HTACCESS FILE
$htaccess = PATH_BASE . ".htaccess";
if (!file_exists($htaccess)) {
  if (file_put_contents($htaccess, implode("\r\n", [
    "RewriteEngine On",
    "RewriteBase " . HOST_BASE_PATH,
    "RewriteRule ^index\.php$ - [L]",
    "RewriteCond %{REQUEST_FILENAME} !-f",
    "RewriteCond %{REQUEST_FILENAME} !-d",
    "RewriteRule . " . HOST_BASE_PATH . "index.php [L]"
  ])) === false) { exit("Failed to create $htaccess"); }
  header("Location: " . $_SERVER["REQUEST_URI"]);
  exit();
}

// (C) STRIP PATH DOWN TO AN ARRAY
// E.G. HTTP://SITE.COM/HELLO/WORLD/ > $_PATH = ["HELLO", "WORLD"]
$_PATH = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
if (substr($_PATH, 0, strlen(HOST_BASE_PATH)) == HOST_BASE_PATH) {
  $_PATH = substr($_PATH, strlen(HOST_BASE_PATH));
}
$_PATH = rtrim($_PATH, "/");
$_PATH = explode("/", $_PATH);

// (D) PAGE MODE
$pgadm = $_PATH[0]===HOST_ADMIN; // ADMIN PANEL?
$pgajax = $pgadm ? (isset($_PATH[1]) && $_PATH[1]=="a") : $_PATH[0]=="a"; // AJAX CONTENT GET?

// (E) ADMIN LOGIN CHECKS
if ($pgadm) {
  if (!isset($_SESSION["user"])) {
    if ($pgajax) { exit("SE"); }
    if (count($_PATH)>2 || $_PATH[1]!="login") {
      header("Location: ". HOST_ADMIN_FULL ."login/");
      exit();
    }
  }
  if (isset($_SESSION["user"]) && isset($_PATH[1]) && $_PATH[1]=="login") {
    header("Location: ". HOST_ADMIN_FULL);
    exit();
  }
}

// (F) LOAD PAGE
// HTTP://SITE.COM/ >>> LOAD PAGE-HOME.PHP
// HTTP://SITE.COM/FOO/ >>> LOAD PAGE-FOO.PHP
// HTTP://SITE.COM/FOO/BAR/ >>> LOAD PAGE-FOO-BAR.PHP
// NOT FOUND >>> LOAD PAGE-404.PHP

// (F1) TARGET PAGE FILE TO LOAD
$pgfile = PATH_PAGES . "PAGE-" . ($pgadm ? "ADM-" : "");
if ($pgadm) {
  if (!isset($_PATH[1])) { $pgfile .= "home.php"; }
  else { $pgfile .= implode("-", array_splice($_PATH, 1)) . ".php"; }
} else {
  $pgfile .= $_PATH[0]=="" ? "home.php" : implode("-", $_PATH) . ".php";
}

// (F2) ATTEMPT TO LOAD PAGE
$pgexist = file_exists($pgfile);
if (!$pgexist) {
  http_response_code(404);
  if ($pgajax) { exit("PAGE NOT FOUND"); }
}
if (!$pgajax) { require PATH_PAGES . ($pgadm ? "ADM-" : "") . "TEMPLATE-top.php"; }
require $pgexist ? $pgfile : PATH_PAGES . "PAGE-404.php";
if (!$pgajax) { require PATH_PAGES . ($pgadm ? "ADM-" : "") . "TEMPLATE-bottom.php"; }
