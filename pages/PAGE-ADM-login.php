<!-- (A) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>adm-login.js"></script>

<!-- (B) LOGIN FORM -->
<form onsubmit="return signin();" class="col-md-6 offset-md-3 bg-light border p-4">
<div class="row justify-content-center">
  <h4 class="mb-4">ADMIN SIGN IN</h4>

  <div class="mb-4">
    <label class="form-label" for="user_email">Email</label>
    <input type="email" id="user_email" class="form-control form-control-lg" required/>
  </div>

  <div class="mb-4">
    <label class="form-label" for="user_password">Password</label>
    <input type="password" id="user_password" class="form-control form-control-lg" required/>
  </div>

  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in"/>
</div>
</form>
