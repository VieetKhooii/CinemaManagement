// *******************************************************hàm display none các sản phẩm ngoài 8 cái default*************
var itemsToShow = 8; // Số lượng sản phẩm hiển thị ban đầu
var currentShown = 0; // Số lượng sản phẩm đã hiển thị

function showItem(countMovie) {
    if (countMovie <= 8) {
        currentShown = countMovie;
        document.getElementById("foot_item").style.display = "none";
    } else {
        currentShown = 8;
        for (var i = currentShown + 1; i <= countMovie; i++) {
            var movieId = i; // ID của phim tính từ 1
            var item = document.getElementById(movieId);
            if (item) {
                item.classList.add('display');
            }
        }
    }
}
function type_film(movies) {
    var list_item_film = document.getElementById('list_item_film');
    var html = ''; // Chuỗi HTML sẽ được tạo ra
    // Duyệt qua mảng movies và tạo ra HTML cho mỗi phần tử
    movies.forEach(function(movie, index) {
        var count = index + 1; // Số thứ tự của bộ phim
        html += `
            <div class="item_film" id="${count}" value="${movie.movie_id}">
                <div id="img_film">
                    <img src="${movie.image}">
                    <span class="num">${count}</span>
                </div>
                <div class="hover_item">
                    <a href="#" data-url="film_booking.php" class="button" onclick="loadDetail(event)">Đặt Vé</a>
                    <a href="#" class="button" onclick="loadDetail(event,'content_main')">Chi Tiết</a>
                </div>
                <div id="text_film">
                    <dt id="name_film"><a href="#" title="${movie.movie_name}">${movie.movie_name}</a></dt>
                    <dd>
                        <span id="time">${movie.duration} Giờ</span>
                    </dd>
                </div>
            </div>`;
    });
    // Thêm phần foot_item vào cuối danh sách
    html += `
        <div class="foot_item" id="foot_item">
            <button type="button" id="Show" onclick="addShow(${movies.length})">Xem Thêm <i class="fa-solid fa-angle-down" id="down"></i></button>
        </div>
        <div class="foot_item display" id="foot_item_hidden">
            <button type="button" id="Show" onclick="Hidden(${movies.length})">Thu Gọn <i class="fa-solid fa-angle-up" id="down"></i></button>
        </div>`;
    // Cập nhật nội dung của list_item_film
    list_item_film.innerHTML = html;
}
//*****************************************************************hàm hiện nút xem thêm và thu gọn************************* */
function addShow(countMovie) {
    var tab = document.getElementById("tab_list");
    var heightshow = tab.offsetHeight;
    document.getElementById("list_item_film").style.height = (heightshow + 370) + "px";
    document.getElementById("tab_list").style.height = (heightshow + 370) + "px";
    var maxShown = currentShown + 4; // Số lượng sản phẩm cần hiển thị sau khi bấm nút
    for (var i = currentShown + 1; i <= maxShown && i <= countMovie; i++) {
        var movieId = i;
        // alert(movieId)
        var item = document.getElementById(movieId);
        if (item) {
            item.classList.remove('display'); // Hiển thị các sản phẩm mới
            currentShown++; // Tăng số lượng sản phẩm đã hiển thị
        }
    }
    if (maxShown >= countMovie) {
        document.getElementById("foot_item").classList.add('display');
        document.getElementById("foot_item_hidden").classList.remove('display');
    }
}

function Hidden() {
    var tab = document.getElementById("tab_list");
    var heightshow = tab.offsetHeight;
    document.getElementById("list_item_film").style.height = (heightshow - 370) + "px";
    document.getElementById("tab_list").style.height = (heightshow - 370) + "px";
    var minShown = currentShown - 4; // Số lượng sản phẩm cần hiển thị sau khi bấm nút
    if (minShown < 8) {
        minShown = 8;
    }
    for (var i = currentShown; i > minShown; i--) {
        var movieId = i;
        // alert(movieId)
        var item = document.getElementById(movieId);
        if (item) {
            item.classList.add('display');
            currentShown--;
        }
    }
    if (minShown <= 8) {
        document.getElementById("foot_item").classList.remove('display');
        document.getElementById("foot_item_hidden").classList.add('display');
    }
}
//đang kiểm tra lỗi
//*************************************************************hàm hiện 2 loại phim đang chiếu và sắp chiếu***********************
function header_choose(chooseID,movies) {
    var moviesData = document.getElementById(chooseID).getAttribute('data-movies');
    var movies = JSON.parse(moviesData);
    // console.log(movies);
    // Phim đang chiếu
    if (chooseID === "onScreen") {
        document.getElementById(chooseID).classList.add('Choosed');
        document.getElementById("coming_up").classList.remove('Choosed');
    } else {
        // Phim sắp chiếu
        // Thêm lớp Choosed cho phim sắp chiếu
        document.getElementById(chooseID).classList.add('Choosed');
        document.getElementById("onScreen").classList.remove('Choosed');
    }
    type_film(movies)
}
// function day() {
//     var date = new Date("2024-03-14");
//     var dayOfWeek = date.toLocaleDateString('en-US', { weekday: 'long' }); // Lấy thứ của ngày đã cho
//     // console.log(dayOfWeek); 
// }
// day()
// //-----------------------------------------------------------------sử lý đường dẫn URL, add nội dung****************************************

// function loadDetail(event,content) {
//     event.preventDefault();
//     var oldContent = document.getElementById(content).innerHTML;
//     window.history.replaceState({ content: oldContent }, '', window.location.href);
//     // Tạo đường dẫn mới và thêm nội dung của file detail_film.php
//     var detailURL = 'detail_film.php';
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 // Thêm nội dung vào content_film
//                 var newContent = xhr.responseText;
//                 document.getElementById(content).innerHTML = newContent;
//                 var newURL = 'app.php?detail_film.php';
//                 window.history.pushState({ content: newContent }, '', newURL);
//             } else {
//                 console.error('Error loading detail page:', xhr.statusText);
//             }
//         }
//     };
//     xhr.open('GET', detailURL);
//     xhr.send();
// }
// Sự kiện khi người dùng nhấn nút quay lại trình duyệt
window.onpopstate = function (event) {
    if (event.state && event.state.content) {
        document.getElementById('content_film').innerHTML = event.state.content;
    } else {
        console.log('Không có dữ liệu về nội dung cũ');
    }
};

function loadContent(file) {
    window.history.pushState({}, `?name = static`);
    fetch(file).then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })

        .catch(error => console.error('error', error));
}

function getMovies(){
    $.ajax({
      method: 'GET',
      url: 'http://localhost:8000/movies/customer',
      async: false,
      dataType: 'json',
      success: function(data) {
          if (data.status === 'success') {
            const current = data.cur;
            const currentFinal = Array.isArray(current) && current.length === 0 ? "" : current;
            const upComing = data.up;
            const upComingFinal = Array.isArray(upComing) && upComing.length === 0 ? "" : upComing;
        //   console.log(currentFinal)
            //   alert('succees')
            //  sendDataToPHP(data.data);
            $.ajax({
                method: 'POST',
                url: '/list_item_get',
                async: false,
                data: { 
                    curMovies: currentFinal,
                    upMovies: upComingFinal
                },
                success: function(response) {
                    // console.log(response)
                    document.getElementById('list_item_container').innerHTML = response;
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
          } else if (data.status === 'error'){
              const message = data.error;
              alert(message);
          }
        },
    });
  }

//   function getUpComingMovies(){
//     $.ajax({
//       method: 'GET',
//       url: 'http://localhost:8000/movies/customergetupcoming',
//       async: false,
//       dataType: 'json',
//       success: function(data) {
//           if (data.status === 'success') {
//             const message1 = data.data;
//           const message = Array.isArray(message1) && message1.length === 0 ? "" : message1;
//           console.log(message)
//             //   alert('succees')
//             //  sendDataToPHP(data.data);
//             $.ajax({
//                 method: 'POST',
//                 url: '/list_item_get1',
//                 async: false,
//                 data: { 
//                     movies2: message
//                 },
//                 success: function(response) {
//                     // console.log(response)
//                     document.getElementById('list_item_container').innerHTML = response;
//                 },
//                 error: function(xhr, status, error) {
//                     console.error(error);
//                 }
//             });
//           } else if (data.status === 'error'){
//               const message = data.error;
//               alert(message);
//           }
//         },
//     });
//   }