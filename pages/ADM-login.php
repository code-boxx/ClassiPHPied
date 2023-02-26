<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect("", HOST_ADMIN); }

// (B) LOGIN PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."ADM-login.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border" style="max-width:1000px">
<div class="row">
  <div class="col-3" style="background:url('<?=HOST_UPLOADS?>login.webp') center;background-size:cover"></div>
  <form class="col-9 p-4" onsubmit="return login();">
    <img src="<?=HOST_ASSETS?>favicon.png" class="p-2 mb-3 rounded-circle" style="background:#f1f1f1">
    <h3 class="m-0">SIGN IN</h3>
    <div class="mb-3 text-secondary">
      Enter your email/password
    </div>

    <div class="input-group mb-4">
      <div class="input-group-prepend">
        <span class="input-group-text mi">email</span>
      </div>
      <input type="email" id="login-email" class="form-control" placeholder="Email" required>
    </div>

    <div class="input-group mb-4">
      <div class="input-group-prepend">
        <span class="input-group-text mi">lock</span>
      </div>
      <input type="password" id="login-pass" class="form-control" placeholder="Password" required>
    </div>
    
    <input type="submit" class="btn btn-primary py-2 mb-4" value="Sign in">
    <div><a href="<?=HOST_BASE?>forgot">Forgot Password</a></div>
  </div>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>