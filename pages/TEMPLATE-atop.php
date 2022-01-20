<!DOCTYPE html>
<html>
  <head>
    <!-- (A) HEAD -->
    <!-- (A1) TITLE, DESC, CHARSET, FAVICON, VIEWPORT -->
    <title><?=isset($_PMETA["title"])?$_PMETA["title"]:"Classiphpied Admin"?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?=isset($_PMETA["desc"])?$_PMETA["desc"]:"Classiphpied Admin"?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <meta name="robots" content="noindex">
    <link rel="icon" href="<?=HOST_ASSETS?>favicon.png" type="image/png">

    <!-- (A2) ANDROID/CHROME -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="white">

    <!-- (A3) IOS APP ICON + MOBILE SAFARI -->
    <link rel="apple-touch-icon" href="<?=HOST_ASSETS?>icon-512.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Hello World">

    <!-- (A4) WINDOWS -->
    <meta name="msapplication-TileImage" content="<?=HOST_ASSETS?>icon-512.png">
    <meta name="msapplication-TileColor" content="#ffffff">

    <?php if (isset($_SESS["user"])) { ?>
    <!-- (A5) WEB APP MANIFEST -->
    <!-- https://web.dev/add-manifest/ -->
    <link rel="manifest" href="<?=HOST_BASE?>manifest-adm.json">

    <!-- (A6) SERVICE WORKER -->
    <script>if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("<?=HOST_BASE?>CB-worker.js", {scope: "/admin"});
    }</script>
    <?php } ?>

    <!-- (A7) BOOTSTRAP -->
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="<?=HOST_ASSETS?>bootstrap.min.css">
    <script defer src="<?=HOST_ASSETS?>bootstrap.bundle.min.js"></script>

    <!-- (A8) BURN-IN CSS -->
    <style>
    /* MATERIAL ICONS */
    /* https://fonts.google.com/icons */
    @font-face{font-family:"Material Icons";font-style:normal;font-weight:400;src:url(<?=HOST_ASSETS?>maticon.woff2) format("woff2");}
    .mi{font-family:"Material Icons";font-weight:400;font-style:normal;font-size:24px;letter-spacing:normal;text-transform:none;display:inline-block;white-space:nowrap;word-wrap:normal;direction:ltr;-webkit-font-feature-settings:"liga";-webkit-font-smoothing:antialiased}
    .mi-big{font-size:32px}.mi-smol{font-size:18px}
    /* SHOW-HIDE */
    #cb-loading{transition:opacity .3s}.cb-hide{opacity:0;visibility:hidden;height:0}.cb-pg-hide{display:none}
    /* NOW LOADING */
    #cb-loading{width:100vw;height:100vh;position:fixed;top:0;left:0;z-index:999;background:rgba(0,0,0,.7)}#cb-loading .spinner-border{width:80px;height:80px}
    /* COMMON & FORM */
    #cb-body,body{min-height:100vh}#cb-toggle{display:none}#cb-side{min-width:170px}#cb-side a{color:#fff}#cb-side .mi{color:#6a6a6a}@media screen and (max-width:768px){#cb-toggle{display:block}#cb-side{display:none}#cb-side.show{display:block}}
    .zebra .d-flex:nth-child(odd){background:#f7f7f7}#reader video{height:400px}.pagination{border:1px solid #c7daf7;background:#f0f6ff}
    </style>

    <!-- (A9) COMMON INTERFACE -->
    <script>var cbhost={base:"<?=HOST_BASE?>",admin:"<?=HOST_ADMIN_BASE?>",api:"<?=HOST_API_BASE?>",assets:"<?=HOST_ASSETS?>",uploads:"<?=HOST_UPLOADS?>"};</script>
    <script defer src="<?=HOST_ASSETS?>ADM-cb.js"></script>

    <!-- (A10) ADDITIONAL SCRIPTS -->
    <?php if (isset($_PMETA["load"])) { foreach ($_PMETA["load"] as $load) {
      if ($load[0]=="s") {
        printf("<script src='%s'%s></script>", $load[1], isset($load[2]) ? " ".$load[2] : "");
      } else {
        printf("<link rel='stylesheet' href='%s'>", $load[1], isset($load[2]) ? " ".$load[2] : "");
      }
    }}
    if (isset($_PMETA)) { unset($_PMETA); } ?>
  </head>
  <body class="bg-light">
    <!-- (B) COMMON SHARED INTERFACE -->
    <!-- (B1) NOW LOADING -->
    <div id="cb-loading" class="d-flex justify-content-center align-items-center cb-hide">
      <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- (B2) TOAST MESSAGE -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:11">
      <div id="cb-toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <span id="cb-toast-icon" class="mi"></span>
          <strong id="cb-toast-head" class="me-auto p-1"></strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="cb-toast-body" class="toast-body"></div>
      </div>
    </div>

    <!-- (B3) MODAL DIALOG BOX -->
    <div id="cb-modal" class="modal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
      <div class="modal-header">
        <h5 id="cb-modal-head" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="cb-modal-body" class="modal-body"></div>
      <div id="cb-modal-foot" class="modal-footer">
      </div>
    </div></div></div>

    <!-- (C) MAIN INTERFACE -->
    <div id="cb-body" class="d-flex">
      <?php if (isset($_SESS["user"])) { ?>
      <!-- (C1) LEFT SIDEBAR -->
      <nav id="cb-side" class="bg-dark text-white p-3">
        <img src="<?=HOST_ASSETS?>favicon.png" loading="lazy" width="32" height="32"/>
        <hr>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_ADMIN_BASE?>">
              <span class="mi mi-smol">campaign</span> Ads
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_ADMIN_BASE?>category">
              <span class="mi mi-smol">category</span> Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_ADMIN_BASE?>images">
              <span class="mi mi-smol">image</span> Images
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_ADMIN_BASE?>users">
              <span class="mi mi-smol">people</span> Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_ADMIN_BASE?>settings">
              <span class="mi mi-smol">settings</span> Settings
            </a>
          </li>
        </ul>
        <hr>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_ADMIN_BASE?>about">
              <span class="mi mi-smol">info</span> About
            </a>
          </li>
        </ul>
      </nav>
      <?php } ?>

      <!-- (C2) RIGHT CONTENTS -->
      <div class="flex-grow-1">
        <?php if (isset($_SESS["user"])) { ?>
        <!-- (C2-1) TOP NAV -->
        <nav class="d-flex bg-dark text-white p-1">
          <div class="flex-grow-1">
            <button id="cb-toggle" class="btn btn-sm mi text-white" onclick="cb.toggle()">
              menu
            </button>
          </div>
          <a class="btn btn-sm mi text-white me-2" href="<?=HOST_BASE?>">
            compare_arrows
          </a>
          <button class="btn btn-sm mi text-white" onclick="cb.bye()">
            logout
          </button>
        </nav>
        <?php } ?>

        <!-- (C2-2) CONTENTS -->
        <div class="p-4">
          <div id="cb-page-1">
