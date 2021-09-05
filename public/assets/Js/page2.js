const hindi = document.querySelectorAll(".hindi");
const english = document.querySelectorAll(".english");
const gujrati = document.querySelectorAll(".gujrati");


function changeImg1() {
    var image = document.getElementById('sp1');

    if (image.src.match("./Resources/images/on.png")) {
        image.src = "../../Resources/images/off.png";
    }
    else {
        image.src = "./Resources/images/on.png";
    }

}
function changeImg2() {
    var image = document.getElementById('sp2');

    if (image.src.match("./Resources/images/on.png")) {
        image.src = "../../Resources/images/off.png";
    }
    else {
        image.src = "./Resources/images/on.png";
    }

}
function changeImg3() {
    var image = document.getElementById('sp3');

    if (image.src.match("./Resources/images/on.png")) {
        image.src = "../../Resources/images/off.png";
    }
    else {
        image.src = "./Resources/images/on.png";
    }

}
function changeImg4() {
    var image = document.getElementById('sp4');

    if (image.src.match("./Resources/images/on.png")) {
        image.src = "../../Resources/images/off.png";
    }
    else {
        image.src = "./Resources/images/on.png";
    }

}


const eng = () => {
    hindi.forEach(e => {
        e.classList.remove('active')
    })
    gujrati.forEach(e => {
        e.classList.remove('active')
    })
    english.forEach(e => {
        e.classList.add('active')
    })
}

const hin = () => {
    gujrati.forEach(e => {
        e.classList.remove('active')
    })
    english.forEach(e => {
        e.classList.remove('active')
    })
    hindi.forEach(e => {
        e.classList.add('active')
    })
}

const guj = () => {
    hindi.forEach(e => {
        e.classList.remove('active')
    })
    english.forEach(e => {
        e.classList.remove('active')
    })
    gujrati.forEach(e => {
        e.classList.add('active')
    })
}
