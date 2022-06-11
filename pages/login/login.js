function emailCheck(email) {
    var r = new XMLHttpRequest();
    r.open("post", "check.php?email=" + email, true);
    r.send();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            document.getElementById("message").innerHTML = email + " " + r.responseText;
        }
    }
}
function showbar(){
    document.getElementById('bar').style.display='inline-block';
    document.getElementById('icon').style.display='none';
    document.getElementById('icon2').style.display='inline-block';
}
function hidebar(){
    document.getElementById('icon2').style.display='none';
    document.getElementById('icon').style.display='inline-block';
    document.getElementById('bar').style.display='none';
}
document.addEventListener('mouseup', function(e) {
    let container = document.getElementById('bar');
    if (!container.contains(e.target)) {
        document.getElementById('bar').style.display='none';
        document.getElementById('icon2').style.display='none';
        document.getElementById('icon').style.display='inline-block';
    }
});

