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
    let reveals = document.querySelectorAll(".reveal");
    for (const element of reveals) {
        let windowHeight = window.innerHeight;
        let elementTop = element.getBoundingClientRect().top;
        let elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            element.classList.add("active");
        } else {
            element.classList.remove("active");
        }
    }
}
window.addEventListener("scroll", reveal);