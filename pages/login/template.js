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