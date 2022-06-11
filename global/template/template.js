function showbar() {
    console.log("Showing bar")
    document.getElementById('bar').style.display = 'inline-block';
    document.getElementById('icon').style.display = 'none';
    document.getElementById('icon2').style.display = 'inline-block';
}

function hidebar() {
    console.log("Hiding bar")
    document.getElementById('icon2').style.display = 'none';
    document.getElementById('icon').style.display = 'inline-block';
    document.getElementById('bar').style.display = 'none';
}
document.addEventListener('mouseup', function(e) {
    let container = document.getElementById('bar');
    if (!container.contains(e.target)) {
        document.getElementById('bar').style.display = 'none';
        document.getElementById('icon2').style.display = 'none';
        document.getElementById('icon').style.display = 'inline-block';
    }
});
