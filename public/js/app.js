let slideIndex = 0;
showSlides(slideIndex);

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

  // Hiển thị slide hiện tại và đánh dấu nút tròn tương ứng là active
  slides[slideIndex].style.display = "block";
  dots[slideIndex].className += " active";
}


document.getElementById("header_contain").addEventListener("click", function (event) {
  var target = event.target;
  var value = target.textContent;
  if (target.id === 'cinemaApp') {
    alert(target.textContent);
  }
  else if (target.id === 'cinemaFB') {
    alert(target.textContent);
  }
  else if (target.id === 'logIn') {
    alert(target.textContent);
  }
  else if (target.id === 'theTV') {
    alert(target.textContent);
  }
  else if (target.id === 'htKH') {
    alert(target.textContent);
  }
});


// Header và footer
document.getElementById("header_menu").addEventListener("click", function (event) {
  var target = event.target;
  if (target.id === 'shopquatang') {
    alert(target.textContent);
  }
  else if (target.id === 'muave') {
    alert(target.textContent);
  }
  else if (target.id === 'phim') {
    alert(target.textContent);
  }
  else if (target.id === 'rapchieuphim') {
    alert(target.textContent);
  }
  else if (target.id === 'khuyenmai') {
    alert(target.textContent);
  }
  else if (target.id === 'lienhe') {
    alert(target.textContent);
  }
});
function loadSign(file) {
  fetch(file).then(response => response.text())
  .then(data => {
    document.getElementById('content_main').innerHTML = data;
  })
  .catch(error => console.error('error', error));
}
// load phần content của app, đang là đăng nhập và đăng kí
function loadContent(file) {
  fetch(file).then(response => response.text())
    .then(data => {
      document.getElementById('content').innerHTML = data;
    })
    .catch(error => console.error('error', error));
}

// GATCHA

// Bắt sự kiện submit của form
document.getElementById('form_signUp').addEventListener("submit", function (event) {
  // Ngăn chặn hành động mặc định của form
  event.preventDefault();

  // Gọi hàm validateSignUp() khi submit form
  validateSignUp();
});

function validateSignUp() {
  // Kiểm tra captcha
  var isCaptchaValid = validateCaptcha();

  // Kiểm tra các trường của form
  var isFormValid = validateForm();

  // Nếu cả form và captcha đều hợp lệ, thì hiển thị thông báo đăng ký thành công và ẩn form
  if (isCaptchaValid && isFormValid) {
    alert('Bạn đã đăng kí thành công!');
    window.location.href="/login";
    document.getElementById("form_signUp").style.display = "none";
  }
}

// Hàm kiểm tra xem các trường đã được nhập đầy đủ chưa
function validateForm() {
  var fullname = document.getElementById('fullname').value;
  var phone = document.getElementById('phone').value;
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var dob = document.getElementById('dob').value;
  var gender = document.getElementById('gender').value;
  var region = document.getElementById('region').value;
  var captcha = document.getElementById('captcha').value;
  var check_captcha = document.getElementById('captchaCode').value;

  // Kiểm tra điều kiện của từng trường
  if (fullname === "" || phone === "" || email === "" || password === "" || dob === "" || gender === "" || region === "" || captcha != check_captcha) {
    // Nếu có trường nào chưa được điền đầy đủ, trả về false
    return false;
  }
  // Nếu tất cả các trường đều đã được điền đầy đủ, trả về true
  return true;
}

function generateCaptcha() {
  var canvas = document.getElementById("captchaCode");
  var ctx = canvas.getContext("2d");

  // Xóa nội dung cũ
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Tạo mã captcha ngẫu nhiên
  var captchaText = '';
  var possibleCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  for (var i = 0; i < 6; i++) {
    captchaText += possibleCharacters.charAt(Math.floor(Math.random() * possibleCharacters.length));
  }

  // Hiển thị mã captcha trên canvas
  ctx.font = "25px Arial";
  ctx.fillStyle = "black";
  ctx.textAlign = "center";
  ctx.fillText(captchaText, canvas.width / 2, canvas.height / 2);

  // Gán mã captcha vào canvas
  canvas.setAttribute("data-captcha", captchaText);

  // Trả về mã captcha để kiểm tra
  return captchaText;
}

function refreshCaptcha() {
  var captchaInput = document.getElementById("captcha");
  captchaInput.value = '';
  generateCaptcha();
}

function validateCaptcha() {
  var captchaInput = document.getElementById("captcha").value;
  var captchaText = document.getElementById("captchaCode").getAttribute("data-captcha");

  if (captchaInput === captchaText) {
    return submit();
  } else {
    alert("Mã captcha không đúng. Vui lòng nhập lại.");
    return false;
  }
}

function submit(){
  const full_name = $('#full_name').val();
  const phone = $('#phone').val();
  const email = $('#email').val();
  const password = $('#password').val();
  const dateOfBirth = $('#date_of_birth').val();
  const gender = $('#gender').val();
  const address = $('#address').val();
  flag = false;
  $.ajax({
    method: 'POST',
    url: 'http://localhost:8000/sign-up',
    data: {
        'full_name': full_name,
        'phone': phone,
        'email': email,
        'password': password,
        'date_of_birth': dateOfBirth,
        'gender': gender,
        'address': address
    },
    async: false,
    dataType: 'json',
    success: function(data) {
        if (data.status === 'success') {
            // alert('Sign up successful!');
            flag = true;
        } else if (data.status === 'error'){
            const message = data.error;
            alert(message);
        }
      },
  });
  return flag;
}
// Hỗ trợ KH 

function showTab(tabName) {
  // Lấy danh sách tất cả các tab
  // Ẩn tất cả các nội dung tab
  var tabContent = document.querySelectorAll('.tab_hoTro2');
  tabContent.forEach(function (content) {
    content.style.display = 'none';
  });

  // Hiển thị nội dung của tab được click
  document.getElementById(tabName).style.display = 'block';
}

function showDetails(element) {
  var detailsDiv = element.querySelector('.detailsDiv');
  if (detailsDiv.classList.contains('active')) {
    detailsDiv.classList.remove('active');
  } else {
    // Loại bỏ lớp active từ tất cả các .detailsDiv khác
    var allDetailsDivs = document.querySelectorAll('.detailsDiv');
    allDetailsDivs.forEach(function (item) {
      item.classList.remove('active');
    });
    detailsDiv.classList.add('active');
  }
}

function handleFileSelect(event) {
  const input = event.target;
  if ('files' in input && input.files.length > 0) {
    const file = input.files[0];
    console.log('Selected file:', file);
    // Thực hiện các xử lý với tệp tại đây, ví dụ: upload lên server, hiển thị thông tin về tệp, vv.
  }
}

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('fileInput').addEventListener('change', handleFileSelect);
});


// Điểm thành viên
// Tính phần trăm tiến độ dựa trên điểm
function updateProgressBar(points) {
  var vipThreshold = 5000000;
  var percentage = (points / vipThreshold) * 100;
  document.getElementById('progressBar').style.width = percentage + '%';
  document.getElementById('progressBar').textContent = points.toLocaleString() + ' điểm';
}

// Cập nhật thanh điểm khi trang web được tải
document.addEventListener('DOMContentLoaded', function () {
  var currentPoints = 2500000; // Điểm hiện tại, thay đổi theo nhu cầu
  updateProgressBar(currentPoints);
});


// Thẻ thành viên

function showVip(tabName, idon) {
  // Lấy danh sách tất cả các tab
  var id = document.getElementById(idon)
  var idof = document.querySelectorAll('.member_ul .member_li a')
  idof.forEach(element => {
    element.classList.remove('on')
  });
  id.classList.add('on')

  // Ẩn tất cả các nội dung tab
  var vipContent = document.querySelectorAll('.show_vip');
  vipContent.forEach(function (content) {
    content.style.display = 'none';
  });

  // Hiển thị nội dung của tab được click
  document.getElementById(tabName).style.display = 'block';
}

