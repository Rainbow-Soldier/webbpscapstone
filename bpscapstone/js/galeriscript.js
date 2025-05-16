let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', function () {
  let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop && currentScroll > 50) {
    navbar.classList.add('hide');
  } else {
    navbar.classList.remove('hide');
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

document.getElementById('uploadFotoBtn').addEventListener('click', function() {

});

document.getElementById('uploadVideoBtn').addEventListener('click', function() {
 
});


var uploadFotoModal = document.getElementById('uploadFotoModal');
var uploadVideoModal = document.getElementById('uploadVideoModal');

var uploadFotoBtn = document.getElementById('uploadFotoBtn');
var uploadVideoBtn = document.getElementById('uploadVideoBtn');

var closeFotoModal = document.getElementById('closeFotoModal');
var closeVideoModal = document.getElementById('closeVideoModal');

uploadFotoBtn.onclick = function() {
    uploadFotoModal.style.display = "block";
}

uploadVideoBtn.onclick = function() {
    uploadVideoModal.style.display = "block";
}

closeFotoModal.onclick = function() {
    uploadFotoModal.style.display = "none";
}

closeVideoModal.onclick = function() {
    uploadVideoModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == uploadFotoModal) {
        uploadFotoModal.style.display = "none";
    }
    if (event.target == uploadVideoModal) {
        uploadVideoModal.style.display = "none";
    }
}
