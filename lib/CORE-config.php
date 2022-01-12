<?php
// (A) HOST
define("HOST_BASE", "http://localhost/"); // @CHANGE
define("HOST_NAME", parse_url(HOST_BASE, PHP_URL_HOST));
define("HOST_BASE_PATH", parse_url(HOST_BASE, PHP_URL_PATH));
define("HOST_API", HOST_BASE_PATH . "api/");
define("HOST_API_BASE", HOST_BASE . "api/");
define("HOST_ASSETS", HOST_BASE . "assets/");
define("HOST_UPLOADS", HOST_ASSETS . "uploads/");
define("HOST_ADMIN", "admin/");
define("HOST_ADMIN_BASE", HOST_BASE . HOST_ADMIN);

// (B) DATABASE - @CHANGE
define("DB_HOST", "localhost");
define("DB_NAME", "classiphpied");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (C) ERROR HANDLING
/* @CHANGE - DON'T DISPLAY ERRORS BUT KEEP IN ERROR LOG ON LIVE SYSTEMS
// (C1) RECOMMENDED FOR LIVE SERVER
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "PATH/error.log");
define("ERR_SHOW", false); */

// (C2) RECOMMENDED FOR DEVELOPMENT SERVER
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
ini_set("log_errors", 0);
define("ERR_SHOW", true);

// (D) JSON WEB TOKEN
define("JWT_SECRET", "YOUR-SECRET-KEY");
define("JWT_ISSUER", "YOUR-NAME");
define("JWT_ALGO", "HS256");
define("JWT_EXPIRE", 0); // in seconds, 0 for none

// (E) API ENDPOINT
define("API_HTTPS", false); // enforce https for api endpoint
define("API_CORS", false);
// define("API_CORS", false); // no cors, accept host_name only
// define("API_CORS", true); // any domain + mobile apps
// define("API_CORS", "site-a.com"); // this domain only
// define("API_CORS", ["site-a.com", "site-b.com"]); // multiple domains

// (F) AUTOMATIC SYSTEM PATH
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);
define("PATH_BASE", dirname(PATH_LIB) . DIRECTORY_SEPARATOR);
define("PATH_API", PATH_BASE . "api" . DIRECTORY_SEPARATOR);
define("PATH_ASSETS", PATH_BASE . "assets" . DIRECTORY_SEPARATOR);
define("PATH_UPLOADS", PATH_ASSETS . "uploads" . DIRECTORY_SEPARATOR);
define("PATH_PAGES", PATH_BASE . "pages" . DIRECTORY_SEPARATOR);

// (G) EMAIL - ENABLE IF USING MAIL MODULE
// define("EMAIL_FROM", "sys@core-boxx.com");

// (H) MISC
define("PAGE_PER", 20); // 20 entries per page by default
define("CLA_IMAGES", 3); // max number of images per ad
