var myMenu= document.getElementById('menu');
var myBackdrop= document.getElementById('menu-backdrop');

function showMenu(){
    myMenu.style.left='0%';
    myBackdrop.style.display='block';
}

function hideMenu(){
    myMenu.style.left='-75%';
    myBackdrop.style.display='none';
}