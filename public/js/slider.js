let slideIndex = 0;
showSlides(slideIndex);

// Tự động chạy slide sau mỗi 3 giây (3000 milliseconds)
let slideInterval = setInterval(function() {
  plusSlides(1);
}, 3000);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n - 1);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("slides");
  let dots = document.getElementsByClassName("dot");

  if (n >= slides.length) {
    slideIndex = 0;
  }
  if (n < 0) {
    slideIndex = slides.length - 1;
  }

  // Ẩn tất cả các slide
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  // Loại bỏ tất cả các lớp active từ nút tròn
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  // Hiển thị slide hiện tại và đánh dấu nút tròn tương ứng
  slides[slideIndex].style.display = "block";
  dots[slideIndex].className += " active";
}