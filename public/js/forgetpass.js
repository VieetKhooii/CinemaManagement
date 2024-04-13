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
        
        var isEmailSent = sentToMail();
        // Nếu cả form và captcha đều hợp lệ, chuyển hướng sang trang resetpass.php
        if (isFormValid && isCaptchaValid && isEmailSent) {
            alert('Gửi mã thành công! Vui lòng kiểm tra điện thoại hoặc email của bạn!');
            window.location.href = "/xacthuc?email="+isEmailSent;
        }
    });
}

function sentToMail(){
    const email = $('#contact').val();
    flag = false;
    $.ajax({
        method: 'POST',
        url: 'http://localhost:8000/password/resent',
        data: {
            'email': email
        },
        async: false,
        dataType: 'json',
        success: function(response){
            console.log("Helooooo")
            if (response.status === 'success'){
                flag = email;
            }
            // else if (data.status === 'error'){
            //     console.log("Fail")
            //     const message = data.error
            //     alert(message);
            // }
        },
        error: function(xhr, status, error) {
            if (xhr.status === 422) {
              var responseJSON = xhr.responseJSON;
              if (responseJSON  && responseJSON.error) {
                alert(responseJSON.error);
              } else {
                alert('Validation error occurred.');
              }
            } 
            else if (xhr.status === 403){
                var responseJSON = xhr.responseJSON;
              if (responseJSON  && responseJSON.error) {
                alert(responseJSON.error);
              } 
            }
            else {
              console.error('AJAX request failed:', status, error);
            }
          }
    });
    return flag;
}

function show_hidden(check) {
    var show_hidden_pass = document.querySelector('.show_hidden_pass');
    var showpass = document.getElementById('password');
    if (check === true) {
        show_hidden_pass.innerHTML = `<i class="fa-solid fa-eye-slash" onclick="show_hidden(false)"></i>`;
        showpass.setAttribute('type', 'password');
    } else if(check === false){
        show_hidden_pass.innerHTML = `<i class="fa-solid fa-eye" onclick="show_hidden(true)"></i>`;
        showpass.setAttribute('type', 'text');
    }
}

function goBack() {
    var currentUrl = window.location.href;
    if (currentUrl.includes("forget_pass")) {
        window.location.href = "login";
    } else if (currentUrl.includes("xacthuc")) {
        window.location.href = "forget_pass";
    }
    //  else if (currentUrl.includes("reset")) {
    //     window.location.href = "xacthuc";
    // }
    else if (currentUrl.includes("login")) {
        window.location.href = "forget_pass"
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

document.getElementById('form_rePass').addEventListener("submit", function (event) {
    // Ngăn chặn hành động mặc định của form
    event.preventDefault();
  
    // Gọi hàm validateSignUp() khi submit form
    validateForgetPass2();
  });

function validateForgetPass2(){
    const urlString = window.location.href;
    const url = new URL(urlString);

    const token = url.pathname.split('/').pop(); // Extract the reset string from the pathname
    const email = url.searchParams.get('email');

    console.log("Reset String:", token);
    console.log("Email:", email);

    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;

    if (password === password2) {
        // Mật khẩu nhập lại trùng khớp, có thể thực hiện các hành động tiếp theo ở đây
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8000/password/pass-reset',
            data: {
                'email': email,
                'password': password,
                'password_confirmation': password2,
                'token': token
            },
            async: false,
            success: function(response) {
                alert(response.message)
                // alert("Mật khẩu thay đổi thành công!");
                window.location.replace("http://localhost:8000/login");
                
            },
            error: function(xhr, status, error) {
                
                  var responseJSON = xhr.responseJSON;
                  if (responseJSON  && responseJSON.error) {
                    alert(responseJSON.error);
                  } else {
                    alert('Validation error occurred.');
                  }
                
              }
        });
    } else {
        // Mật khẩu nhập lại không khớp, hiển thị thông báo cho người dùng và ngăn form từ việc submit
        alert("Mật khẩu nhập lại không khớp!");
        // return false;
    }
}