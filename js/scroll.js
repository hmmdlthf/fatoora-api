let table_top = document.getElementById("cart__table").getBoundingClientRect().top;
let totals_height = document.querySelector(".totals").getBoundingClientRect().height;
let window_height = window.innerHeight;
let cart_height = window_height - totals_height - table_top;
document.getElementById("cart__table").style.height = `${cart_height}px`;

let category_height = window.innerHeight - document.querySelector(".category__btns").getBoundingClientRect().top;
document.querySelector(".category__btns").style.height = `${category_height}px`;