var x = 0;
function register() {
  if (x == 1) {
    document.getElementById("register").className = "register-container-hidden";
    document.getElementById("register").style.display = "block";
    document.getElementById("login").className = "dual-function-container";
    document.getElementById("login").style.display = "flex";
    x = 0;
  } else {
    document.getElementById("register").className = "register-container";
    document.getElementById("register").style.display = "block";
    document.getElementById("login").className = "dual-function-container-hidden";
    document.getElementById("login").style.display = "flex";
    x = 1;
  }
}