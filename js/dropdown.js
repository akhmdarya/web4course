var acc = document.getElementsByClassName("footer-mobile-list__item");
var imgclass = document.getElementById("caret");

var i;
var j;
var flag=false;


for (i = 0; i < acc.length; i++) {
   // console.log(i);
  acc[i].addEventListener("click", function() {
    console.log('works');
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");
    this.getElementsByTagName('img')[0].classList.toggle('rotate');
  
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    
    } else {


      panel.style.display = "block";
    }
  });
}


function toggleDropList(node) {
    imgclass.onclick = function(){
        this.classList.toggle('rotate')
    }
}
