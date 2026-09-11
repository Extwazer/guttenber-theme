document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.header');
    const burger = document.querySelector('.header__burger');

    if (burger) {
        burger.addEventListener('click', () => {
            header.classList.toggle('active');
        });
    }
});