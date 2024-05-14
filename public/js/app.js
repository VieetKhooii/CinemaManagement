function load_film(date_choose) {
  fetch('film_booking_controller', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ action: "load_film", date: date_choose }) // Truyền 'date_choose' thay vì 'date'
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Có lỗi xảy ra khi chọn ngày');
      }
      return response.json();
    })
    .then(data => {
      const selectFilmDiv = document.querySelector('.select_film ul');
      selectFilmDiv.innerHTML = ''; // Xóa nội dung cũ của thẻ ul trước khi thêm mới

      // Kiểm tra xem data.film_date có dữ liệu hay không
      if (data.film_date) {
        // Nếu data.film_date là mảng, lặp qua từng phim và tạo thẻ <li> tương ứng
        if (Array.isArray(data.film_date)) {
          data.film_date.forEach((film, index) => { // Thêm tham số index để sử dụng chỉ số của mảng
            const li = document.createElement('li');
            li.id = film.movie_id; // Sử dụng movie_id hoặc một thuộc tính khác của film làm id cho thẻ li
            li.onclick = function () { click_film(film.movie_id); }; // Gọi hàm click_film khi người dùng click vào li

            const span = document.createElement('span');
            span.textContent = index + 1;
            // span.textContent = film.movie_id; // Chỉ định nội dung cho thẻ span, thay thế bằng thông tin phù hợp với phim

            const a = document.createElement('a');
            // a.setAttribute('href',`/resources/controller/film_booking_controller.php`)
            a.textContent = film.movie_name; // Chỉ định nội dung cho thẻ a, thay thế bằng thông tin phù hợp với phim
            
            li.appendChild(span);
            li.appendChild(a);
            selectFilmDiv.appendChild(li);
          });
        }
      } else {
        alert("Không có phim");
      }
    })
    .catch(error => {
      console.error('Có lỗi xảy ra khi chọn ngày:', error);
      alert('Có lỗi xảy ra khi kiểm tra chọn ngày.');
    });
}


function action_click(labelId, dayOfWeek, event) {
  event.preventDefault()
  var labelElement = document.getElementById(labelId);
  var emElement = labelElement.querySelector('em');
  var allEmElements = document.querySelectorAll('.calendar .week_picker_field .calender_area label em');

  // Loại bỏ lớp active_click_day từ tất cả các thẻ em
  allEmElements.forEach(function (em) {
    em.classList.remove('active_click_day');
  });


  // Thêm lớp active_click_day cho thẻ em của label được click
  emElement.classList.add('active_click_day');

  // Loại bỏ lớp active_click_lable từ tất cả các label
  var allLabels = document.querySelectorAll('.calendar .week_picker_field .calender_area label');
  allLabels.forEach(function (label) {
    label.classList.remove('active_click_lable');
  });

  // Thêm lớp active_click_lable cho label được click
  labelElement.classList.add('active_click_lable');

  // Cập nhật ngày được chọn
  var datechoose = document.querySelector('.time_ticket .date dd');
  var newDate = labelId.substring(6, 8) + '/' + labelId.substring(4, 6) + '/' + labelId.substring(0, 4);
  datechoose.innerText = `${newDate} (${dayOfWeek})`;

  // Lấy ngày theo định dạng 'YYYYMMDD' từ labelId
  var date_choose = labelId.substring(0, 4) + '-' + labelId.substring(4, 6) + '-' + labelId.substring(6, 8);

  // Gọi hàm load_film và truyền vào ngày đã chuyển đổi định dạng
  load_film(date_choose);

  var ulshowtime = document.querySelector('.list_showtime ul');
  ulshowtime.innerHTML = '';
}
function showWeekNext(nextWeekArray) {
  var calendar_area = document.querySelector('.ticket_booking .cont_ticket .calendar .week_picker_field .calender_area');
  calendar_area.innerHTML = '';
  nextWeekArray.forEach(function (item) {
    var id = item.id;
    var newDay = item.newDay;
    var dayofweek = item.dayofweek;
    calendar_area.innerHTML += `
      <input type="radio" id="check_${id}">
      <label for="check_${id}" id="${id}" onclick="action_click('${id}','${dayofweek}')">
        <span>${dayofweek}</span>
        <em>${newDay}</em>
      </label>`;
  });
  var showprev = document.querySelector('.ticket_booking .cont_ticket .calendar .left');
  showprev.style.display = "flex";
  var hiddennext = document.querySelector('.ticket_booking .cont_ticket .calendar .right');
  hiddennext.style.display = "none";
}
var prevButton = document.querySelector('.ticket_booking .cont_ticket .calendar .left');

function showWeekPrev(prevWeekArray) {
  var calendar_area = document.querySelector('.ticket_booking .cont_ticket .calendar .week_picker_field .calender_area');
  calendar_area.innerHTML = '';
  prevWeekArray.forEach(function (item) {
    var id = item.id;
    var newDay = item.newDay;
    var dayofweek = item.dayofweek;
    calendar_area.innerHTML += `
      <input type="radio" id="check_${id}">
      <label for="check_${id}" id="${id}" onclick="action_click('${id}','${dayofweek}')">
        <span>${dayofweek}</span>
        <em>${newDay}</em>
      </label>`;
  });
  var showprev = document.querySelector('.ticket_booking .cont_ticket .calendar .left');
  showprev.style.display = "none";
  var hiddennext = document.querySelector('.ticket_booking .cont_ticket .calendar .right');
  hiddennext.style.display = "flex";
}

prevButton.addEventListener('click', function () {
  var prevWeekArray = JSON.parse(prevWeekEncoded);
  showWeekPrev(prevWeekArray);
});

function click_film(liId) {
  // event.preventDefault();
  var liElement = document.getElementById(liId);
  var allLiElements = document.querySelectorAll('.select_film ul li');

  if (liElement.classList.contains('action_film')) {
    liElement.classList.remove('action_film');
    var spanToRotate = liElement.querySelector('span');
    spanToRotate.classList.remove('rotateOnPress');
    spanToRotate.style.boxShadow = 'none';
    var ulchoose = document.querySelector('.time_ticket .film .film_choose');
    ulchoose.innerHTML = '';
    var ulshowtime = document.querySelector('.list_showtime ul');
    ulshowtime.innerHTML = '';
  } else {
    // Nếu chưa có, loại bỏ class action_film từ tất cả các phần tử và thêm vào phần tử được bấm vào
    allLiElements.forEach(function (li) {
      var span = li.querySelector('span');
      span.classList.remove('rotateOnPress');
      span.style.boxShadow = 'none';
      li.classList.remove('action_film');
    });
    liElement.classList.add('action_film');
    var spanToRotate = liElement.querySelector('span');
    spanToRotate.classList.add('rotateOnPress');
    spanToRotate.style.boxShadow = '4px 4px 8px rgb(131, 131, 131)';
    var text_film = liElement.childNodes[1].textContent.trim();
    // Thêm nội dung phim được chọn

    var ulchoose = document.querySelector('.time_ticket .film .film_choose');
    ulchoose.innerHTML = `<li class="li_choose">${text_film}<a onclick="exit()"><i id="exit" class="fa-solid fa-square-xmark"></i></a></li>`;
    document.querySelector('.time_inner .time_box_data h4').innerHTML = text_film
    load_showtime();
  }
}

function exit() {
  var ulchoose = document.querySelector('.time_ticket .film .film_choose')
  ulchoose.innerHTML = ''
  var ulshowtime = document.querySelector('.list_showtime ul');
  ulshowtime.innerHTML = '';
  var allLiElements = document.querySelectorAll('.select_film ul li');
  allLiElements.forEach(function (li) {
    var span = li.querySelector('span');
    span.classList.remove('rotateOnPress');
    span.style.boxShadow = 'none';
    li.classList.remove('action_film');
  });
}

// var slideIndex = 0;
// showSlides(slideIndex);

// function plusSlides(n) {
//   showSlides(slideIndex += n);
// }

// function currentSlide(n) {
//   showSlides(slideIndex = n - 1);
// }

// function showSlides(n) {
//   let i;
//   let slides = document.getElementsByClassName("slides");
//   let dots = document.getElementsByClassName("dot");

//   if (n >= slides.length) {
//     slideIndex = 0;
//   }
//   if (n < 0) {
//     slideIndex = slides.length - 1;
//   }

//   // Ẩn tất cả các slide
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }

//   // Loại bỏ tất cả các lớp active từ nút tròn
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }

//   // Hiển thị slide hiện tại và đánh dấu nút tròn tương ứng là active
//   slides[slideIndex].style.display = "block";
//   dots[slideIndex].className += " active";
// }


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
  // else if (target.id === 'theTV') {
  //   alert(target.textContent);
  // }
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
    (target.textContent);
  }
  else if (target.id === 'lienhe') {
    alert(target.textContent);
  }
});

function logout() {
  $.ajax({
    method: 'GET',
    url: 'http://localhost:8000/logout',
    async: false,
    success: function (data) {
      if (data.status == 'success') {
        window.location.replace('/login');
      }
      else {
        alert(data.message)
      }
    }
  });
}

function getCookie(cookieName) {
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(cookieName + '=')) {
      return cookie.substring(cookieName.length + 1);
    }
  }
  return null;
}

function pleaseLogIn() {
  alert("Hãy đăng nhập!")
}

function loadViewOnly(file) {
  window.history.pushState({}, "dashboard", `dashboard?${file}`);
  if (file == "myself") {
    $.ajax({
      method: 'GET',
      url: 'users/' + $('#user_id').val(),
      async: false,
      success: function (personalInfo) {
        $.ajax({
          method: 'GET',
          url: 'comments/' + $('#user_id').val(),
          async: false,
          success: function (commentsOfUser) {
            $.ajax({
              method: 'GET',
              url: 'transactions/customerget/' + $('#user_id').val(),
              async: false,
              success: function (payment) {
                $.ajax({
                  method: 'GET',
                  url: 'myself',
                  data: {
                    personalInfo: personalInfo,
                    commentsOfUser: commentsOfUser.data,
                    payment: payment.data
                  },
                  async: false,
                  success: function (data) {
                    document.getElementById('content_main').innerHTML = data;
                    var script1 = document.createElement('script');
                    script1.src = '/js/myself.js';
                    document.head.appendChild(script1);
                  },
                  error: function (xhr, status, error) {
                    console.log(personalInfo)
                  }
                })
              }
            })
            
          },
          //Error of getting comments by user
          error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
              var errorMessage = xhr.responseJSON.message;
              alert(errorMessage);
            } else {
              alert('An error occurred while getting comments by user.');
            }
          }
        })
      },
      // Error of personal information 
      error: function (xhr, status, error) {
        if (xhr.responseJSON && xhr.responseJSON.message) {
          var errorMessage = xhr.responseJSON.message;
          alert(errorMessage);
        } else {
          alert('An error occurred while getting personal information.');
        }
      }
    })
  }
  else {
    fetch(file).then(response => response.text())
      .then(data => {
        document.getElementById('content_main').innerHTML = data;
        var script1 = document.createElement('script');
        script1.src = '/js/myself.js';
        document.head.appendChild(script1);
      })
      .catch(error => console.error('error', error));
  }
}

// window.addEventListener('popstate', function(event) {
//   // When user navigates back/forward, load the content based on the state
//   var state = event.state;
//   if (state && state.page) {
//       loadSign(state.page);
//   }
// });

function loadSign(file) {
  if (file == 'login') {
    window.location.href = "/login"
  }
  else if (file == 'sign-up') {
    window.location.href = "/sign-up"
  }
  else if (file == 'dashboard') {
    window.location.href = "/dashboard"
  }
  else {
    $.ajax({
      method: 'GET',
      url: 'http://localhost:8000/' + file,
      async: false,
      dataType: 'json',
      success: function (data) {
        if (data.status === 'success') {
          const message1 = data.data.data;
          const message = Array.isArray(message1) && message1.length === 0 ? "" : message1;
          console.log(message)
          $.ajax({
            method: 'POST',
            url: '/' + file + '_get',
            async: false,
            data: {
              result: message
            },
            success: function (data) {
              // fetch(file).then(response => response.text())
              // .then(data => {
              document.getElementById('content_main').innerHTML = data;
              // history.pushState({ page: file }, null, '/' + file);
              // })
              // .catch(error => console.error('error', error));
            },
          });
        } else if (data.status === 'error') {
          const message = data.error;
          alert(message);
        }
      },
      error: function (xhr, status, error) {
        // console.error(xhr.responseText);
        alert("Hãy đăng nhập lại!");
        location.reload(true);
      }
    });
  }
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
    window.location.href = "/login";
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

function submit() {
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
    success: function (data) {
      if (data.status === 'success') {
        // alert('Sign up successful!');
        flag = true;
      } else if (data.status === 'error') {
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

function hidden_detail_ticket() {
  var show_detail_ticket = document.querySelector('.show_detail_ticket');
  show_detail_ticket.innerHTML = ``
  show_detail_ticket.style.display = 'none'
}

//-------------- Load suất chiếu---------------
function load_showtime() {
  var click_film = document.querySelectorAll('.select_film ul li');
  var date_choose1 = document.querySelector('.calendar fieldset .calender_area .active_click_lable');
  var date_choose_id = date_choose1.id;
  var date_choose = date_choose_id.substring(0, 4) + '-' + date_choose_id.substring(4, 6) + '-' + date_choose_id.substring(6, 8);

  for (var i = 0; i < click_film.length; i++) {
    var li = click_film[i];
    if (li.classList.contains('action_film')) {
      var movie_choose = li.id;
      fetch('film_booking_controller', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: "load_showtime", date: date_choose, movie: movie_choose })
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Có lỗi xảy ra khi chọn suất');
          }
          return response.json();
        })
        .then(data => {
          const selectFilmDiv = document.querySelector('.list_showtime ul');
          selectFilmDiv.innerHTML = ''; // Xóa nội dung cũ của thẻ ul trước khi thêm mới

          // Kiểm tra xem data.showtime có dữ liệu hay không
          if (data.showtime && data.combos && data.reserved_seats) {

            // Nếu data.showtime là mảng, lặp qua từng suất chiếu
            if (Array.isArray(data.showtime)) {
              data.showtime.forEach((st) => { // Thêm tham số index để sử dụng chỉ số của mảng
                const li = document.createElement('li');
                li.setAttribute('onclick', "getSeatsOfRoom(" + JSON.stringify(data.combos) + ", " + JSON.stringify(st) + ", '" + st.room_id + "')");
                const showtime_id = st.showtime_id;

                const span1 = document.createElement('span');
                const span2 = document.createElement('span');
                const span3 = document.createElement('span');

                span1.textContent = st.room_name;
                span2.textContent = st.start_time;

                // Hiển thị thông tin ghế tương ứng với room_id của suất chiếu
                if (data.seatcount && data.seatcount[showtime_id]) {

                  const seatInfo = data.seatcount[showtime_id];
                  const reservedSeats = seatInfo.total_reserved_seats;
                  const totalSeats = seatInfo.total_seats;

                  const availableSeats = totalSeats - reservedSeats;
                  span3.textContent = `${availableSeats} / ${totalSeats} ghế`;

                } else {
                  span3.textContent = "Dữ liệu ghế không có sẵn";
                }

                li.appendChild(span1);
                li.appendChild(span2);
                li.appendChild(span3);

                selectFilmDiv.appendChild(li);
              });
            }
          } else {
            alert("Không có suất chiếu");
          }
        })
        .catch(error => {
          console.error('Có lỗi xảy ra khi chọn suất:', error);
          alert('Có lỗi xảy ra khi kiểm tra chọn suất.');
        });

    }
  }

}

function getSeatsOfRoom(combos, st, id) {
  $.ajax({
      method: 'GET',
      url: 'http://localhost:8000/seats/' + id+'/'+st.showtime_id,
      async: false,
      dataType: 'json',
      success: function (data) {
          if (data.status === 'success') {
              const result = data.data;
              const resultFinal = Array.isArray(result) && result.length === 0 ? "" : result;
              console.log(combos)
              $.ajax({
                  method: 'POST',
                  url: '/seat-wrap',
                  async: false,
                  data: {
                    combos: combos,
                    necessaryData: st,
                    seatArray: resultFinal
                  },
                  success: function (response) {

                    document.getElementById('container_booking').innerHTML = response;
                    var script1 = document.createElement('script');
                    var script2 = document.createElement('script');
                    script1.src = '/js/seatwrap.js';
                    document.head.appendChild(script1);
                    script2.src = '/js/bookingCombo.js';
                    document.head.appendChild(script2);

                  },
                  error: function (xhr, status, error) {
                      console.error(error);
                  }
              });
          } else if (data.status === 'error') {
              const message = data.error;
              alert(message);
          }
      },
      error: function (xhr, status, error) {
        if (xhr.responseJSON && xhr.responseJSON.message) {
          var errorMessage = xhr.responseJSON.message;
          alert(errorMessage);
        } else {
          alert('An error occurred while getting seat.');
        }
      }
  });
}