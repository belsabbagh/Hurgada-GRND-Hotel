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

  function reveal() {
      let reveals = document.querySelectorAll(".reveal");
      for (let i = 0; i < reveals.length; i++) {
          let windowHeight = window.innerHeight;
          let elementTop = reveals[i].getBoundingClientRect().top;
          let elementVisible = 150;
          if (elementTop < windowHeight - elementVisible) {
              reveals[i].classList.add("active");
          } else {
              reveals[i].classList.remove("active");
          }
      }
  }
window.addEventListener("scroll", reveal);