<link rel="stylesheet" href="/css/app.css">

<div class="slideshow-container">
  <div class="slides">
    <img src="../img/slides/slide_1.jpg" alt="Slide 1">
  </div>
  <div class="slides">
    <img src="../img/slides/slide_2.jpg" alt="Slide 2">
  </div>
  <div class="slides">
    <img src="../img/slides/slide_3.jpg" alt="Slide 3">
  </div>

  <!-- Nút điều hướng trước và sau -->  
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

  <!-- Nút tròn để chọn slide -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
</div>

<script src="/js/slider.js"></script>