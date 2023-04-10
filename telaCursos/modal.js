var modalCr = document.querySelector(".modalCr");
var triggerCr = document.querySelector(".triggerCr");
var closeButtonCr = document.querySelector(".close-button3");

var modalUc = document.querySelector(".modal-uc");
var triggerUc = document.querySelector(".trigger-uc");
var closeButtonUc = document.querySelector(".close-button1");

function toggleModalCr() {
    modalCr.classList.toggle("show-modal");
}

function toggleModal1() {
    modalUc.classList.toggle("show-modal");
}

function windowOnClick2(event) {
    if (event.target === modalCr) {
        toggleModalCr();
    }
}

function windowOnClick1(event) {
    if (event.target === modalUc) {
        toggleModal1();
    }
}


triggerCr.addEventListener("click", toggleModalCr);
closeButtonCr.addEventListener("click", toggleModalCr);
window.addEventListener("click", windowOnClick2);

triggerUc.addEventListener("click", toggleModal1);
closeButtonUc.addEventListener("click", toggleModal1);
window.addEventListener("click", windowOnClick1);
