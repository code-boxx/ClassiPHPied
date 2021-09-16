<!DOCTYPE html>
<html>
  <head>
    <!-- (A) HTML HEAD & BACKGROUND LOADING STUFF -->
    <!-- (A1) META -->
    <title>ClassiPHPied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex, nofollow, nosnippet">
    <link rel="shortcut icon" href="<?=HOST_ASSETS?>favicon.png">

    <!-- (A2) BOOTSTRAP 5 -->
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="<?=HOST_ASSETS?>bootstrap.min.css"/>
    <script defer src="<?=HOST_ASSETS?>bootstrap.bundle.min.js"></script>

    <!-- (A3) GOOGLE MATERIAL ICONS -->
    <!-- https://fonts.google.com/icons -->
    <style>
    @font-face{font-family:"Material Icons";font-style:normal;font-weight:400;src:url(<?=HOST_ASSETS?>maticon.woff2) format("woff2");}
    .mi{font-family:"Material Icons";font-weight:400;font-style:normal;font-size:24px;letter-spacing:normal;text-transform:none;display:inline-block;white-space:nowrap;word-wrap:normal;direction:ltr;-webkit-font-feature-settings:"liga";-webkit-font-smoothing:antialiased}
    .mi-big{font-size:32px}.mi-smol{font-size:16px}
    </style>

    <!-- (A4) CLASSIPHIED CLIENT ENGINE -->
    <link rel="stylesheet" href="<?=HOST_ASSETS?>adm-classiphpied.css"/>
    <script>var clphost={base:"<?=HOST_BASE?>",admin:"<?=HOST_ADMIN_FULL?>",assets:"<?=HOST_ASSETS?>",uploads:"<?=HOST_UPLOADS?>",api:"<?=HOST_API_FULL?>"};</script>
    <script async src="<?=HOST_ASSETS?>adm-classiphpied.js"></script>
  </head>
  <body>
    <!-- (B) COMMON SHARED INTERFACE -->
    <!-- (B1) NOW LOADING -->
    <div id="clp-loading" class="d-flex justify-content-center align-items-center clp-hide">
      <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- (B2) TOAST MESSAGE -->
    <div class="position-fixed bottom-0 end-0 p-3">
      <div id="clp-toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <span id="clp-toast-icon" class="mi"></span>
          <strong id="clp-toast-head" class="me-auto p-1"></strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="clp-toast-body" class="toast-body"></div>
      </div>
    </div>

    <!-- (B3) MODAL DIALOG BOX -->
    <div id="clp-modal" class="modal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
      <div class="modal-header">
        <h5 id="clp-modal-head" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="clp-modal-body" class="modal-body"></div>
      <div id="clp-modal-foot" class="modal-footer">
      </div>
    </div></div></div>

    <?php if (isset($_SESSION["user"])) { ?>
    <!-- (C) MAIN NAV BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container-fluid">
      <!-- (C1) BRANDING LOGO
      <a class="navbar-brand" href="<?=HOST_BASE?>">
        <img src="<?=HOST_ASSETS?>favicon.png" loading="lazy" width="32" height="32"/>
      </a>
      -->

      <!-- (C2) MENU TOGGLE BUTTON -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="mi">menu</span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- (C3) LEFT MENU ITEMS -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=HOST_ADMIN_FULL?>">
              <span class="mi mi-big">featured_play_list</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=HOST_ADMIN_FULL?>category">
              <span class="mi mi-big">category</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=HOST_ADMIN_FULL?>images">
              <span class="mi mi-big">image</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=HOST_ADMIN_FULL?>users">
              <span class="mi mi-big">people</span>
            </a>
          </li>
        </ul>

        <!-- (C4) RIGHT LOGOUT -->
        <button class="btn btn-danger btn-sm" onclick="clp.bye()">
          <span class="mi">logout</span>
        </button>
      </div>
    </div></nav>
    <?php } ?>

    <!-- (D) PAGES -->
    <div class="container pt-4">
      <div id="clp-page-1" class="clp-page">
