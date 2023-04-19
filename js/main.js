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

document.body.style.zoom = "80%";

var w = $(window), d = $(document), b = $('body');
window.resizeBy(0, ((b.height() - w.height()) || d.height() - w.height()));

const options = {
    bottom: '64px', // default: '32px'
    right: '82px', // default: '32px'
    left: 'unset', // default: 'unset'
    time: '0.5s', // default: '0.3s'
    mixColor: '#eee', // default: '#fff'
    backgroundColor: '#fff',  // default: '#fff'
    buttonColorDark: '#100f2c',  // default: '#100f2c'
    buttonColorLight: '#fff', // default: '#fff'
    saveInCookies: true, // default: true,
    label: '🌓', // default: ''
    autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();

butter.init({ cancelOnTouch: true });