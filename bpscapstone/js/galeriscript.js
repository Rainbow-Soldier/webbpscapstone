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
    // Handle upload foto logic here (modal, form, etc.)
});

document.getElementById('uploadVideoBtn').addEventListener('click', function() {
    // Handle upload video logic here (modal, form, etc.)
});


// Get modal elements
var uploadFotoModal = document.getElementById('uploadFotoModal');
var uploadVideoModal = document.getElementById('uploadVideoModal');

// Get open modal buttons
var uploadFotoBtn = document.getElementById('uploadFotoBtn');
var uploadVideoBtn = document.getElementById('uploadVideoBtn');

// Get close buttons
var closeFotoModal = document.getElementById('closeFotoModal');
var closeVideoModal = document.getElementById('closeVideoModal');

// Open modal for Foto
uploadFotoBtn.onclick = function() {
    uploadFotoModal.style.display = "block";
}

// Open modal for Video
uploadVideoBtn.onclick = function() {
    uploadVideoModal.style.display = "block";
}

// Close modal for Foto
closeFotoModal.onclick = function() {
    uploadFotoModal.style.display = "none";
}

// Close modal for Video
closeVideoModal.onclick = function() {
    uploadVideoModal.style.display = "none";
}

// Close modal if clicked outside the modal
window.onclick = function(event) {
    if (event.target == uploadFotoModal) {
        uploadFotoModal.style.display = "none";
    }
    if (event.target == uploadVideoModal) {
        uploadVideoModal.style.display = "none";
    }
}
