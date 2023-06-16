<?php
// (A) ALREADY SIGNED IN
if (isset($_SESSION["user"])) { $_CORE->redirect("", HOST_ADMIN); }

// (B) LOGIN PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."ADM-login.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border" style="max-width:1000px">
<div class="row">
  <div class="col-3" style="background:url('<?=HOST_ASSETS?>login.webp') center;background-size:cover"></div>
  <form class="col-9 p-4" onsubmit="return login();">
    <img src="<?=HOST_ASSETS?>favicon.png" class="p-2 mb-3 rounded-circle" style="background:#f1f1f1">
    <h3 class="m-0">SIGN IN</h3>
    <div class="mb-3 text-secondary">
      Enter your email/password
    </div>

    <div class="form-floating mb-4">
      <input type="email" id="login-email" class="form-control" placeholder="Email" required>
      <label>Email</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="login-pass" class="form-control" placeholder="Password" required>
      <label>Password</label>
    </div>
    
    <input type="submit" class="btn btn-primary py-2 mb-4" value="Sign in">
    <div><a href="<?=HOST_BASE?>forgot">Forgot Password</a></div>
  </div>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>