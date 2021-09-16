<!DOCTYPE html>
<html>
  <head>
    <!-- (A) HTML HEAD & BACKGROUND LOADING STUFF -->
    <!-- (A1) META -->
    <title>ClassiPHPied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="<?=HOST_ASSETS?>favicon.png">

    <!-- (A2) BOOTSTRAP 5 -->
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="<?=HOST_ASSETS?>bootstrap.min.css"/>
    <script defer src="<?=HOST_ASSETS?>bootstrap.bundle.min.js"></script>
    <!-- HOST URL -->
    <script>var clphost={base:"<?=HOST_BASE?>",assets:"<?=HOST_ASSETS?>"};</script>
  </head>
  <body>
    <!-- (B) MAIN NAV BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container-fluid">
      <!-- (B1) BRANDING LOGO -->
      <a class="navbar-brand" href="<?=HOST_BASE?>">
        <img src="<?=HOST_ASSETS?>favicon.png" loading="lazy" width="32" height="32"/>
      </a>

      <!-- (B2) MENU TOGGLE BUTTON -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- (B3) LEFT MENU ITEMS -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=HOST_BASE?>contact">
              Contact Us
            </a>
          </li>
        </ul>
      </div>
    </div></nav>

    <!-- (C) MAIN PAGE -->
    <div class="container pt-4">
