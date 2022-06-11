function showbar() {
    document.getElementById('bar').style.display = 'inline-block';
    document.getElementById('icon').style.display = 'none';
    document.getElementById('icon2').style.display = 'inline-block';
}

function hidebar() {
    document.getElementById('icon2').style.display = 'none';
    document.getElementById('icon').style.display = 'inline-block';
    document.getElementById('bar').style.display = 'none';
}

document.addEventListener('mouseup', function (e) {
    let container = document.getElementById('bar');
    if (!container.contains(e.target)) {
        document.getElementById('bar').style.display = 'none';
        document.getElementById('icon2').style.display = 'none';
        document.getElementById('icon').style.display = 'inline-block';
    }
});


window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    if (document.documentElement.scrollTop > 5) {
        document.getElementById("bgr").style.width = '60%';
        document.getElementById("bgr").style.backgroundPosition = 'left';
        document.getElementById("bgr").style.height = "90px";
        document.getElementById("bgr").style.top = "200px";
        document.getElementById("bgr").style.backgroundImage = "url('../../resources/img/home page/hotel1.jpg')";
        document.getElementById("maintext").style.display = "none";
        document.getElementById('items').style.visibility = 'visible';
        document.getElementById('items').style.opacity = '1';
        document.getElementById('items').style.transition = '1.5s';
        document.getElementById('book').style.color = "var(--yellow0-color)";
        document.getElementById('book').style.background = "var(--brown4--color)";
    } else {
        document.getElementById("bgr").style.width = '100%';
        document.getElementById("bgr").style.height = "100vh";
        document.getElementById("bgr").style.top = "0px";
        document.getElementById("bgr").style.backgroundImage = "linear-gradient(rgba(0,0,0,0.35),rgba(0,0,0,0.15)) ,url('../../resources/img/home page/hotel1.jpg')";
        document.getElementById("maintext").style.display = "block";
        document.getElementById('items').style.visibility = 'hidden';
        document.getElementById('items').style.opacity = '0';
        document.getElementById('items').style.transition = '0.1s';
        document.getElementById('book a').style.color = "var(--brown2-color)";
        document.getElementById('book').style.background = "linear-gradient( 45deg , rgba(255, 250, 232, 0.174), rgba(255, 255, 255, 0))";
    }
}

function reveal() {
    var reveals = document.querySelectorAll(".reveal")
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

window.addEventListener("scroll", reveal);


function show() {
    var reveals = document.querySelectorAll(".show")
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        if (document.documentElement.scrollTop > 5) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

window.addEventListener("scroll", show);