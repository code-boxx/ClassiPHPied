function signin () {
  clp.api({
    mod : "session", req : "login",
    data : {
      email : document.getElementById("user_email").value,
      password : document.getElementById("user_password").value
    },
    passmsg : false,
    onpass : function () { location.href = clphost.admin; }
  });
  return false;
}
