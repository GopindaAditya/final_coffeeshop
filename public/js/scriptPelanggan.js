// Ambil URL halaman saat ini
var currentUrl = window.location.href;

// Ambil semua item navbar
var navbarItems = document.querySelectorAll(".navbar-nav .nav-item");

// Periksa setiap item navbar
navbarItems.forEach(function (item) {
    // Cari elemen .nav-link dalam item navbar
    var navLink = item.querySelector(".nav-link");
    
    // Periksa apakah elemen .nav-link ada dalam item
    if (navLink) {
        // Ambil URL dari tautan item navbar
        var itemUrl = navLink.href;

        // Bandingkan URL item navbar dengan URL halaman saat ini
        if (currentUrl === itemUrl) {
            // Jika cocok, tambahkan kelas '.active' ke item tersebut
            item.classList.add("active");
        }
    }
});

var navbar = document.querySelector('.navbar');

// Tambahkan event listener untuk discroll
window.addEventListener('scroll', function() {
  if (window.scrollY > 0) {
    navbar.classList.add('navbar-scrolled');
  } else {
    navbar.classList.remove('navbar-scrolled');
  }
});
