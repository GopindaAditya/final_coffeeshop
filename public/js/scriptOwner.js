
document.addEventListener("DOMContentLoaded", function () {
  // Mendapatkan URL saat ini
  var currentUrl = window.location.pathname;

  // Cari tautan di sidebar yang sesuai dengan URL saat ini
  var sidebarLinks = document.querySelectorAll(".sidebar-content a");

  sidebarLinks.forEach(function (link) {
    var href = link.getAttribute("href");

    // Memeriksa apakah URL saat ini cocok dengan href tautan
    if (currentUrl === href) {
      link.classList.add("active"); // Menambahkan kelas "active" ke tautan yang cocok
    } else {
      link.classList.remove("active"); // Menghapus kelas "active" dari tautan yang tidak cocok
    }
  });
});

$(document).ready(function(){
    $('#calendar-container').datepicker({
      inline: true,
      format: 'yyyy-mm-dd',
    });
  });
