var slideUp = {
    distance: '10%',
    origin: 'bottom',
    delay: 365
};

ScrollReveal().reveal('.con_head', slideUp);
ScrollReveal().reveal('.container', slideUp);

// hamburger menu
function w3_open() {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

