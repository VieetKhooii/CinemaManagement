// Chuyển tab
function showMe(tabName, idon, event) {
  event.preventDefault();
  // Lấy danh sách tất cả các tab
  var id = document.getElementById(idon)
  // if (idon == "tdtt"){
  //   $.ajax ({
  //     method: 'GET',
  //     url: 'users/'+$('#user_id').val(),
  //     async: false,
  //     success: function(personalInfo){
  //       $.ajax ({
  //         method: 'GET',
  //         url: 'myself',
  //         data: {
  //           personalInfo: personalInfo
  //         },
  //         async: false,
  //         success: function(data){
  //           // document.getElementById('content_main').innerHTML += data;
  //         },
  //         error: function(xhr, status, error){
  //           console.log("error")
  //         }
  //       })
  //     },
  //     error: function(xhr, status, error){
  //       if (xhr.responseJSON && xhr.responseJSON.message) {
  //         var errorMessage = xhr.responseJSON.message;
  //         alert(errorMessage);
  //     } else {
  //         alert('An error occurred while processing your request.');
  //     }
  //     }
  //   })
  // }
  var idof = document.querySelectorAll('.member_ul .member_li a')
  idof.forEach(element => {
    element.classList.remove('on')
  });
  id.classList.add('on')

  // Ẩn tất cả các nội dung tab
  var vipContent = document.querySelectorAll('.show_me');
  vipContent.forEach(function (content) {
    content.style.display = 'none';
  });

  // Hiển thị nội dung của tab được click
  document.getElementById(tabName).style.display = 'block';
}

// Thay đổi thông tin
// Lấy tham chiếu đến nút "Thay đổi"
var sendButtonTT = document.querySelector(".send_tdtt");

// Hàm xử lý sự kiện khi nút "Thay đổi" được nhấn
sendButtonTT.addEventListener("click", function (event) {
  // Ngăn chặn hành vi mặc định của nút "Thay đổi" (tránh gửi biểu mẫu)
  event.preventDefault();
  // Lấy tham chiếu đến các trường input
  var fullnameInput = document.getElementById("fullname");
  var phoneInput = document.getElementById("phone");
  var emailInput = document.getElementById("email");
  var birthInput = document.getElementById("birth");
  var diachiInput = document.getElementById("diachi");

  // Kiểm tra từng trường input
  if (checkField(fullnameInput) && checkField(phoneInput) && checkField(emailInput) && checkField(birthInput) && checkField(diachiInput)) {
    $.ajax({
      method: 'PUT',
      url: 'users/'+$('#user_id').val(),
      data: {
        'full_name': $('#fullname').val(),
        'phone': $('#phone').val(),
        'email': $('#email').val(),
        'gender': $('#gender').val(),
        'date_of_birth': $('#birth').val(),
        'address': $('#diachi').val(),
      },
      async: false,
      success: function(data){
        alert(data.message);
      },
      error: function(xhr, status, error){
        if (xhr.responseJSON && xhr.responseJSON.message) {
          var errorMessage = xhr.responseJSON.message;
          alert(errorMessage);
      } else {
          alert('An error occurred while processing your request.');
      }
      }
    })
  }
});

// Hàm kiểm tra trường input và trả về true nếu không trống, ngược lại trả về false
// Hàm kiểm tra trường input và trả về true nếu hợp lệ, ngược lại trả về false
function checkField(inputField) {
  if (inputField.value.trim() === "") {
    inputField.setCustomValidity("Vui lòng nhập thông tin.");
    inputField.reportValidity();
    return false;
  } else {
    inputField.setCustomValidity("");

    // Kiểm tra định dạng cho trường email
    if (inputField.type === "email" && !validateEmail(inputField.value)) {
      inputField.setCustomValidity("Vui lòng nhập đúng định dạng Email.");
      inputField.reportValidity();
      return false;
    }

    // Kiểm tra định dạng cho trường số điện thoại
    if (inputField.type === "tel" && !validatePhone(inputField.value)) {
      inputField.setCustomValidity("Vui lòng nhập Số điện thoại 10 chữ số.");
      inputField.reportValidity();
      return false;
    }

    return true;
  }
}

// Hàm kiểm tra định dạng email
function validateEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Hàm kiểm tra định dạng số điện thoại (10 chữ số)
function validatePhone(phone) {
  var phoneRegex = /^[0-9]{10}$/;
  return phoneRegex.test(phone);
}

// Lưu trạng thái ban đầu của các trường input khi trang được tải lên
var initialData = {};

document.addEventListener("DOMContentLoaded", function () {
  initialData.fullname = document.getElementById("fullname").value;
  initialData.phone = document.getElementById("phone").value;
  initialData.email = document.getElementById("email").value;
  initialData.gender = document.getElementById("gender").value;
  initialData.birth = document.getElementById("birth").value;
  initialData.diachi = document.getElementById("diachi").value;
});

// Hàm xử lý sự kiện khi nút "Hủy bỏ" được nhấn
var cancelButtonTT = document.querySelector(".cancel_tdtt");
cancelButtonTT.addEventListener("click", function (event) {
  event.preventDefault();

  // Khôi phục lại trạng thái ban đầu của các trường input
  document.getElementById("fullname").value = initialData.fullname;
  document.getElementById("phone").value = initialData.phone;
  document.getElementById("email").value = initialData.email;
  document.getElementById("gender").value = initialData.gender;
  document.getElementById("birth").value = initialData.birth;
  document.getElementById("diachi").value = initialData.diachi;
});

// Thay đổi mật khẩu
// Hàm xử lý sự kiện khi nút "Thay đổi" được nhấn
var sendButtonMK = document.querySelector(".send_tdmk");

sendButtonMK.addEventListener("click", function (event) {
  // Ngăn chặn hành vi mặc định của nút "Thay đổi" (tránh gửi biểu mẫu)
  event.preventDefault();

  // Lấy giá trị của mật khẩu hiện tại, mật khẩu mới và nhập lại mật khẩu
  var currentPassword = document.getElementById("password_now");
  var newPassword = document.getElementById("password_new");
  var confirmPassword = document.getElementById("password_check");
  // Kiểm tra xem có trường nào để trống không
  if (checkField(currentPassword) && checkField(newPassword) && checkField(confirmPassword)) {
    if (newPassword.value !== confirmPassword.value) {
      // Nếu mật khẩu nhập lại không trùng khớp, đặt thông báo lỗi
      document.getElementById("password_check").setCustomValidity("Mật khẩu nhập lại không trùng khớp.");
      document.getElementById("password_check").reportValidity();
    } else {
      $.ajax({
        method: 'POST',
        url: 'password/update',
        data: {
          'password_now': $('#password_now').val(),
          'password_new': $('#password_new').val(),
          'email': document.getElementById('EmailForChangingPassword').value,
        },
        async: false,
        success: function(data){
          alert(data.message);
        },
        error: function(xhr, status, error){
          if (xhr.responseJSON && xhr.responseJSON.message) {
            var errorMessage = xhr.responseJSON.message;
            alert(errorMessage);
        } else {
            alert('An error occurred while processing your request.');
        }
        }
      })
    }
  }

});

var cancelButtonMK = document.querySelector(".cancel_tdmk");
cancelButtonMK.addEventListener("click", function (event) {
  event.preventDefault();

  // Khôi phục lại trạng thái ban đầu của các trường input
  document.getElementById("password_now").value = "";
  document.getElementById("password_new").value = "";
  document.getElementById("password_check").value = "";
});

var sendButtonTK = document.querySelector(".cancel_xtk");

sendButtonTK.addEventListener("click", function (event) {
  // Ngăn chặn hành vi mặc định của nút "Thay đổi" (tránh gửi biểu mẫu)
  event.preventDefault();

  // Lấy giá trị của mật khẩu hiện tại, mật khẩu mới và nhập lại mật khẩu
  var currentPassword = document.getElementById("password_now_del");
  var confirmPassword = document.getElementById("password_check_del");
  // Kiểm tra xem có trường nào để trống không
  if (checkField(currentPassword) && checkField(confirmPassword)) {
    if (currentPassword.value !== confirmPassword.value) {
      // Nếu mật khẩu nhập lại không trùng khớp, đặt thông báo lỗi
      document.getElementById("password_check_del").setCustomValidity("Mật khẩu nhập lại không trùng khớp.");
      document.getElementById("password_check_del").reportValidity();
    } else {
      $.ajax({
        method: 'PUT',
        url: 'users/hideFromClient/'+$('#user_id').val(),
        data: {
          'password_now': $('#password_now_del').val(),
        },
        async: false,
        success: function(data){
          alert(data.message);
          logout()
          window.location.replace("/home")
        },
        error: function(xhr, status, error){
          if (xhr.responseJSON && xhr.responseJSON.message) {
            var errorMessage = xhr.responseJSON.message;
            alert(errorMessage);
        } else {
            alert('An error occurred while processing your request.');
        }
        }
      })
    }
  }

});

var cancelButtonTK = document.querySelector(".send_xtk");
cancelButtonTK.addEventListener("click", function (event) {
  event.preventDefault();

  // Khôi phục lại trạng thái ban đầu của các trường input
  document.getElementById("password_now_del").value = "";
  document.getElementById("password_check_del").value = "";
});

