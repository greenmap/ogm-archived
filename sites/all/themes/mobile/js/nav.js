function showElement(navwin){
var navwin = document.getElementById(navwin);
if(navwin.style.display=="none"){
navwin.style.display="block";
menu.backgroundPosition="top";
} else {
navwin.style.display="none";
}
}