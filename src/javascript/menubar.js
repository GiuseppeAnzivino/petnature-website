let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

let button = document.querySelector('#user-icon');
let mynav = document.querySelector('.overlay');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    button.classList.remove('bx-x');
    mynav.classList.remove('active');
};

button.onclick = () => {
    button.classList.toggle('bx-x');
    mynav.classList.toggle('active');
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
    button.classList.remove('bx-x');
    mynav.classList.remove('active');
};