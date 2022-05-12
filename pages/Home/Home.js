window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.documentElement.scrollTop > 5) {
      document.getElementById("bgr").style.width = '60%';
      document.getElementById("bgr").style.backgroundPosition = 'left';
      document.getElementById("bgr").style.height = "90px";
      document.getElementById("bgr").style.top = "200px";
      document.getElementById("bgr").style.backgroundImage = "url('../../resources/img/home page/hotel1..jpg')";
      document.getElementById("maintext").style.display = "none";
      document.getElementById('items').style.visibility = 'visible';
      document.getElementById('items').style.opacity = '1';
      document.getElementById('items').style.transition = '1.5s';
      document.getElementById('book').style.color = "var(--yellow0-color)";
      document.getElementById('book').style.background = "var(--brown4--color)";
  } 
  else {
      document.getElementById("bgr").style.width = '100%';
      document.getElementById("bgr").style.height = "100vh";
      document.getElementById("bgr").style.top = "0px";
      document.getElementById("bgr").style.backgroundImage = "linear-gradient(rgba(0,0,0,0.35),rgba(0,0,0,0.15)) ,url('../../resources/img/home page/hotel1..jpg')";
      document.getElementById("maintext").style.display = "block";
      document.getElementById('items').style.visibility = 'hidden';
      document.getElementById('items').style.opacity = '0';
      document.getElementById('items').style.transition = '0.1s';
      document.getElementById('book').style.color = "var(--brown2-color)";
      document.getElementById('book').style.background = "linear-gradient( 45deg , rgba(255, 250, 232, 0.174), rgba(255, 255, 255, 0))";
  }
}

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



function show() {
    let reveals = document.querySelectorAll(".show");
    for (let i = 0; i < reveals.length; i++) {
        if (document.documentElement.scrollTop > 5) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}
window.addEventListener("scroll", show);