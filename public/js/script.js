
const openModalBtn = document.getElementById("punkt-bir");


const modal = document.getElementById("modal");
const m_cnt =document.querySelector(".m_cnt");

const closeModalBtn = document.getElementById("closeModalBtn");


openModalBtn.addEventListener("click", function () {
    modal.style.display = "block";
    m_cnt.style.display = "block";

});


closeModalBtn.addEventListener("click", function () {
    modal.style.display = "none";
});


window.addEventListener("click", function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

//==================================================





const openModalBtn2 = document.getElementById('openModalBtn2');
const closeModalBtn2 = document.getElementById('closeModalBtn2');
const modal2 = document.getElementById('modal2');


openModalBtn2.addEventListener('click', function() {
    modal2.style.display = 'inline';
});


closeModalBtn2.addEventListener('click', function() {
    modal2.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
});

//==========================================



const openModalBtn3 = document.getElementById('openModalBtn3');
const closeModalBtn3 = document.getElementById('closeModalBtn3');
const modal3 = document.getElementById('modal3');


openModalBtn3.addEventListener('click', function() {
    modal3.style.display = 'block';
});


closeModalBtn3.addEventListener('click', function() {
    modal3.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal3) {
        modal3.style.display = "none";
    }
});


//==================================================



const openModalBtn4 = document.getElementById('openModalBtn4');
const closeModalBtn4 = document.getElementById('closeModalBtn4');
const modal4 = document.getElementById('modal4');


openModalBtn4.addEventListener('click', function() {
    modal4.style.display = 'block';
});


closeModalBtn4.addEventListener('click', function() {
    modal4.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal4) {
        modal4.style.display = "none";
    }
});
//===============================================


const openModalBtn5 = document.getElementById('openModalBtn5');
const closeModalBtn5 = document.getElementById('closeModalBtn5');
const modal5 = document.getElementById('modal5');


openModalBtn5.addEventListener('click', function() {
    modal5.style.display = 'block';
});


closeModalBtn5.addEventListener('click', function() {
    modal5.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal5) {
        modal5.style.display = "none";
    }
});

//=====================================================




const openModalBtn6 = document.getElementById('openModalBtn6');
const closeModalBtn6 = document.getElementById('closeModalBtn6');
const modal6 = document.getElementById('modal6');


openModalBtn6.addEventListener('click', function() {
    modal6.style.display = 'block';
});


closeModalBtn6.addEventListener('click', function() {
    modal6.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal6) {
        modal6.style.display = "none";
    }
});
//==========================================



const openModalBtn7 = document.getElementById('openModalBtn7');
const closeModalBtn7 = document.getElementById('closeModalBtn7');
const modal7 = document.getElementById('modal7');


openModalBtn7.addEventListener('click', function() {
    modal7.style.display = 'block';
});


closeModalBtn7.addEventListener('click', function() {
    modal7.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal7) {
        modal7.style.display = "none";
    }
});



//=====================================================



const openModalBtn8 = document.getElementById('openModalBtn8');
const closeModalBtn8 = document.getElementById('closeModalBtn8');
const modal8 = document.getElementById('modal8');


openModalBtn8.addEventListener('click', function() {
    modal8.style.display = 'block';
});


closeModalBtn8.addEventListener('click', function() {
    modal8.style.display = 'none';
});
window.addEventListener("click", function (event) {
    if (event.target == modal7) {
        modal7.style.display = "none";
    }
});