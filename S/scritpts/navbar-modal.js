var x = 0;
function usermodal() {
    console.log (x);
  if (x == 1) {
    document.getElementById("modal-content").style.display = "none";
    document.getElementById("modal-wrapper").style.display = "none";
    document.getElementById("modal-content").style.zIndex = "1";
    document.getElementById("modal-wrapper").style.zIndex = "1";
    x = 0;
  } else {
    document.getElementById("modal-content").style.width = "320px";
    document.getElementById("modal-content").style.height = "180px";
    document.getElementById("modal-content").style.display = "flex";
    document.getElementById("modal-wrapper").style.display = "flex";
    document.getElementById("modal-content").style.zIndex = "6";
    document.getElementById("modal-wrapper").style.zIndex = "6";
    x = 1;
  }
}