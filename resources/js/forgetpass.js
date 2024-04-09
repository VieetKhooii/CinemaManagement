// QUÊN MẬT KHẨU
function validateForm() {
    var contactInput = document.getElementById("contact");
    var captchaInput = document.getElementById("captcha");

    // Kiểm tra hợp lệ của số điện thoại hoặc email
    var contactValidity = (/^0\d{9}$/.test(contactInput.value) || /^\d{10}$/.test(contactInput.value)) ||
        (/^\S+@\S+\.\S+$/.test(contactInput.value));

    // Kiểm tra hợp lệ của mã captcha
    var captchaValidity = captchaInput.value.trim() !== "";

        if (contactValidity && captchaValidity) {
        return true;
    } else {
        // Nếu có lỗi, hiển thị thông báo cho người dùng và không chuyển hướng trang
        if (!contactValidity) {
            contactInput.setCustomValidity('Vui lòng nhập số điện thoại hoặc địa chỉ email.');
        } else {
            contactInput.setCustomValidity('');
        }
        if (!captchaValidity) {
            captchaInput.setCustomValidity('Vui lòng nhập mã captcha.');
        } else {
            captchaInput.setCustomValidity('');
        }
        return false;
    }
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
    ctx.font = "20px Arial";
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
        return true;
    } else {
        alert('Mã captcha không đúng');
        return false;
    }
}

// // Bắt sự kiện submit của form

function validateForgetPass(event) {
    event.preventDefault()
    document.getElementById('form_forgetPass').addEventListener("submit", function (event) {
        // Ngăn chặn hành động mặc định của form
        event.preventDefault();

        // Kiểm tra hợp lệ của form
        var isFormValid = validateForm();

        // Kiểm tra hợp lệ của captcha
        var isCaptchaValid = validateCaptcha();

        // Nếu cả form và captcha đều hợp lệ, chuyển hướng sang trang resetpass.php
        if (isFormValid && isCaptchaValid) {
            alert('Gửi mã thành công! Vui lòng kiểm tra điện thoại hoặc email của bạn!');
            window.location.href = "xacthuc.php";
        }
    });
}

function goBack() {
    var currentUrl = window.location.href;
    if (currentUrl.includes("forgetpass.php")) {
        window.location.href = "signin.php";
    } else if (currentUrl.includes("xacthuc.php")) {
        window.location.href = "forgetpass.php";
    } else if (currentUrl.includes("resetpass.php")) {
        window.location.href = "xacthuc.php";
    }
    else if (currentUrl.includes("signin.php")){
        window.location.href = "forgetpass.php"
    }
}

// XAC THỰC
var totalSeconds = 180; // Thời gian ban đầu là 3 phút
var interval; // Biến để lưu interval của hàm đếm ngược

// Hàm bắt đầu đếm ngược
function startCountdown() {
    var countdownBtn = document.getElementById('countdownBtn');

    function countdown() {
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;
        var display = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        countdownBtn.textContent = display;
        totalSeconds--;
        if (totalSeconds < 0) {
            clearInterval(interval);
            countdownBtn.disabled = false; // Kích hoạt lại nút button sau khi hết thời gian
        }
    }

    interval = setInterval(countdown, 1000);
}

// Hàm khởi động lại đếm ngược
function restartCountdown() {
    totalSeconds = 180; // Reset lại thời gian
    clearInterval(interval); // Dừng interval cũ
    startCountdown(); // Bắt đầu đếm ngược mới
}

// Gọi hàm bắt đầu đếm ngược khi trang đã tải hoàn toàn
window.onload = startCountdown;



