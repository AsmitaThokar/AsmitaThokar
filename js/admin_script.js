
let navbar = document.querySelector('.header .navbar');
let accountBox = document.querySelector('.header .account-box');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   accountBox.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   accountBox.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   accountBox.classList.remove('active');
}

// document.querySelector('#close-update').onclick = () =>{
//    document.querySelector('.edit-package-form').style.display = 'none';
//    window.location.href = 'admin_packages.php';
// }

var el = document.getElementById('close-update');
if(el){
  el.addEventListener('click', addingClosingEventListener, false);
}

function addingClosingEventListener () { 
   document.querySelector('.edit-package-form').style.display = 'none';
   window.location.href = 'admin_packages.php';
 };