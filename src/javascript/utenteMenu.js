let button = document.querySelector('#user-icon');
let mynav = document.querySelector('.overlay');

button.onclick = () => {
    button.classList.toggle('bx-x');
    mynav.classList.toggle('active');
    
};

window.onscroll = () => {
    button.classList.remove('bx-x');
    mynav.classList.remove('active');
};