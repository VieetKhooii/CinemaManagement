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
    movies.forEach(function (movie, index) {
        var count = index + 1; // Số thứ tự của bộ phim
        html += `
            <div class="item_film" id="${count}" value="${movie.movie_id}">
                <div id="img_film">
                    <img src="${movie.image}">
                    <span class="num">${count}</span>
                </div>
                <div class="hover_item">
                    <a href="dashboard/film_booking" class="button">Đặt Vé</a>
                    <a href="detail_film/get?movie_id=${movie.movie_id}" class="button" onclick="loadDetail(event,'content_main', ${movie.movie_id})">Chi Tiết</a>
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

// function film_booking(){
//     const urlParams = new URLSearchParams(window.location.search);
//     fetch('dashboard/film_booking').then(response => response.text())
//       .then(data => {
//         document.getElementById('content_main').innerHTML = data;
//       })
//       .catch(error => console.error('error', error));
// }

function getSeatsOfRoom(id) {
    $.ajax({
        method: 'GET',
        url: 'http://localhost:8000/seats/' + id,
        async: false,
        dataType: 'json',
        success: function (data) {
            if (data.status === 'success') {
                const result = data.data;
                const resultFinal = Array.isArray(result) && result.length === 0 ? "" : result;
                $.ajax({
                    method: 'POST',
                    url: '/seat-wrap',
                    async: false,
                    data: {
                        seatArray: resultFinal
                    },
                    success: function (response) {
                        console.log(response)
                        document.getElementById('content_main').innerHTML = response;
                        loadContentSeatWrap()
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
    });
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
function header_choose(chooseID, movies) {
    var moviesData = document.getElementById(chooseID).getAttribute('data-movies');
    var movies = JSON.parse(moviesData);
    showItem(movies.length)
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

function loadDetail(event, content) {
    event.preventDefault();
    // var movie_id = event.currentTarget.parentElement.parentElement.getAttribute("value");
    const urlParams = new URLSearchParams(window.location.search);
    const movie_id = urlParams.get('movie_id');
    // alert(movie_id)
    // Gọi AJAX chỉ khi cần thiết
    fetch('dashboard/detail_film/get?movie_id=' + movie_id, {
        method: 'GET',
    })
        .then(response => response.text()) // Chuyển đổi dữ liệu nhận được sang dạng văn bản
        .then(data => {
            // Thêm nội dung vào content_main
            document.getElementById(content).innerHTML = data;
        })
        .catch(error => console.error('Error loading detail page:', error));
}

function loadContent(file) {
    window.history.pushState({}, `?name = static`);
    fetch(file).then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })

        .catch(error => console.error('error', error));
}

function getMovies() {
    $.ajax({
        method: 'GET',
        url: 'http://localhost:8000/movies/customer',
        async: false,
        dataType: 'json',
        success: function (data) {
            if (data.status === 'success') {
                const test = [
                    {
                        "movie_id": "",
                        "movie_name": "",
                        "movie_description": null,
                        "image": "",
                        "duration": 0,
                        "bonus_price": 0,
                        "category_id": 0,
                        "display": false,
                        "category_name": "",
                        "start_time": ""
                    }]
                const current = data.cur;
                const currentFinal = Array.isArray(current) && current.length === 0 ? test : current;
                const upComing = data.up;
                const upComingFinal = Array.isArray(upComing) && upComing.length === 0 ? test : upComing;
                // console.log(upComing)
                $.ajax({
                    method: 'POST',
                    url: '/list_item_get',
                    async: false,
                    data: {
                        curMovies: currentFinal,
                        upMovies: upComingFinal
                    },
                    success: function (response) {
                        document.getElementById('list_item_container').innerHTML = response;
                        var scripts = document.getElementById('list_item_container').getElementsByTagName('script');
                        for (var i = 0; i < scripts.length; i++) {
                            eval(scripts[i].innerText || scripts[i].textContent);
                        }
                        // header_choose('onScreen');
                    },
                    error: function (xhr, status, error) {
                        console.error("error: " + error);
                    }
                });
            } else if (data.status === 'error') {
                const message = data.error;
                alert(message);
            }
        },
    });
}

// ****************************đánh giá sao
function score() {
    var score_area = document.querySelector('.score_area fieldset .score_star a')
    var score = document.querySelector('.score_area fieldset .score_star a span')
    score_area.addEventListener('mouseenter', function (event) {
        // vị trí của score_area so với khung chính
        var scoreAreaRect = score_area.getBoundingClientRect();
        // event.clientX là vị trí của con chuột so với khung theo chiều ngang
        // công thức sau
        //! là vị trí con chuột và -- là vị trí của thẻ a so với khung
        // -----------||thẻ ! a||
        //=> công thức vt con chuột trong thẻ a bằng kc từ //- đến ! trừ cho //-
        var mouseX = event.clientX - scoreAreaRect.left;
        var scoreAreaWidth = score_area.offsetWidth;
        var newWidth = 100 - (mouseX / scoreAreaWidth) * 100 + '%';
        // Gán width mới cho score
        score.style.left = '-' + newWidth;
    });
}
// score()
// *****************************************************pagination****************************************8
var comments;
var sumPaging;
var hiddenPages = [];// chứa các giá trị ... ẩn đi
var loadPagingCalled = true;
var currentPaging = 1
const pageNumContainer = document.getElementById('pageNums');

function loadPaging(sumPaging_data, comments_data) {
    pageNumContainer.innerHTML = '';
    var total = document.querySelector('.paging')
    total.querySelector('span').innerText = sumPaging_data
    comments = comments_data;
    sumPaging = sumPaging_data;
    // console.log('comments: ', comments);
    pageNumContainer.innerHTML = loadPaging_Click(currentPaging, sumPaging_data)
    loadReviews(pageNumContainer.querySelector('.chosen_paging_css'), new Event('click'));
}
function loadPaging_Click(chosen_paging, sumPaging_data) {
    // console.log('sumPaging_data: ' + (Math.floor(sumPaging_data / 2) - 1))
    var htmlPaging = '';
    var chosen_paging = parseInt(chosen_paging)
    if (sumPaging_data <= 5) {
        for (var i = 1; i <= sumPaging_data; i++) {
            if (chosen_paging === i) {
                htmlPaging += `<a href="#" class="chosen_paging_css" onclick="loadReviews(this, event)" value="${i}">${i}</a>`;
            } else {
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${i}">${i}</a>`;
            }
        }
    } else if (sumPaging_data > 5) {
        if (chosen_paging === 1) {
            htmlPaging += `<a href="#" class="chosen_paging_css"  onclick="loadReviews(this, event)" value="1">1</a>`;
            htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="2">2</a>`;
            htmlPaging += `<span>...</span>`;
            htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging - 1}">${sumPaging - 1}</a>`;
            htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging}">${sumPaging}</a>`;
            // console.log(hiddenPages)
            // console.log(hiddenPages[hiddenPages.length - 2])
        } else if (chosen_paging === sumPaging_data) {
            htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="1">1</a>`;
            htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="2">2</a>`;
            htmlPaging += `<span>...</span>`;
            htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging - 1}">${sumPaging - 1}</a>`;
            htmlPaging += `<a href="#" class="chosen_paging_css" onclick="loadReviews(this, event)" value="${sumPaging}">${sumPaging}</a>`;
        } else {
            // [3,4,5,6|,7,8]10
            if (chosen_paging + 4 < sumPaging_data) {
                //=5
                console.log('bé hơn')
                htmlPaging += `<a href="#" class="chosen_paging_css" onclick="loadReviews(this, event)" value="${chosen_paging}">${chosen_paging}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${chosen_paging + 1}">${chosen_paging + 1}</a>`;
                htmlPaging += `<span>...</span>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging - 1}">${sumPaging - 1}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging}">${sumPaging}</a>`;
            } else if (chosen_paging + 4 === sumPaging_data) {
                //=6
                console.log('= nhau')
                htmlPaging += `<a href="#" class="chosen_paging_css"  onclick="loadReviews(this, event)" value="${chosen_paging}">${chosen_paging}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${chosen_paging + 1}">${chosen_paging + 1}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${chosen_paging + 2}">${chosen_paging + 2}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging - 1}">${sumPaging - 1}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${sumPaging}">${sumPaging}</a>`;
            } else {
                console.log('lớn hơn')
                htmlPaging += `<a href="#"onclick="loadReviews(this, event)" value="1">1</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="2">2</a>`;
                htmlPaging += `<span>...</span>`;
                htmlPaging += `<a href="#" class="chosen_paging_css" onclick="loadReviews(this, event)" value="${chosen_paging}">${chosen_paging}</a>`;
                htmlPaging += `<a href="#" onclick="loadReviews(this, event)" value="${chosen_paging + 1}">${chosen_paging + 1}</a>`;
            }
        }
    }
    return htmlPaging;
}

function loadReviews(elementchoose, event) {
    // console.log('loadReviews run')
    const ulReviews = document.querySelector('.ulReviews');
    const pageNumber = parseInt(elementchoose.getAttribute('value'));
    // console.log(typeof pageNumber);
    if (!loadPagingCalled) {
        pageNumContainer.innerHTML = '';
        pageNumContainer.innerHTML = loadPaging_Click(pageNumber, sumPaging)
    }
    loadPagingCalled = false
    const aTags = pageNumContainer.querySelectorAll('a');
    // console.log(elementchoose)
    aTags.forEach(function (a) {
        a.classList.remove('chosen_paging')
    })
    elementchoose.classList.add('chosen_paging')
    event.preventDefault();
    currentPaging = pageNumber;
    // console.log(currentPaging)
    // console.log("Trang được chọn: " + pageNumber);
    const startIndex = (pageNumber - 1) * 4;
    ulReviews.innerHTML = '';
    for (let i = startIndex; i < startIndex + 4 && i < comments.length; i++) {
        const comment = comments[i];
        const li = document.createElement('li');
        li.innerHTML = `
                <div class="score_box">
                    <div class="score_sum">
                        <div class="name_user_review">${comment.full_name}</div>
                        <div class="star_wrap">
                            ${generateRadioInputs(comment.like, i)}
                        </div>
                        <div class="user_score">${comment.like} điểm</div>
                    </div>
                    <p class="result_txt">${comment.content}</p>
                    <div class="result_footer">
                        <div class="date_post">${comment.post_time}</div>
                    </div>
                </div>
            `;
        ulReviews.appendChild(li);
    }
}
// hàm đành giá sao
function generateRadioInputs(rating, rated_id) {
    let inputs = '';
    for (let i = 10; i >= 1; i--) {
        inputs += `<input type="radio" name="rated_${rated_id}" value="${i}" ${rating === i ? 'checked' : ''}>`;
    }
    return inputs;
}


//*********************************************************next and prev********************************

document.addEventListener('DOMContentLoaded', function () {
    const prevPageFirst = document.getElementById('prevPageFirst');
    const prevPage = document.getElementById('prevPage');
    const nextPage = document.getElementById('nextPage');
    const nextPageLast = document.getElementById('nextPageLast');
    // const pageNumContainer = document.getElementById('pageNums');

    prevPageFirst.addEventListener('click', function (event) {
        event.preventDefault();
        pageNumContainer.innerHTML = loadPaging_Click(1, sumPaging);

        loadReviews(document.querySelector(`#pageNums a:first-child`), new Event('click'));
    });

    prevPage.addEventListener('click', function (event) {
        event.preventDefault();
        if (currentPaging > 1) {
            pageNumContainer.innerHTML = loadPaging_Click(currentPaging - 1, sumPaging);
            loadReviews(document.querySelector(`#pageNums [value="${currentPaging - 1}"]`), new Event('click'));
        }
    });

    nextPage.addEventListener('click', function (event) {
        event.preventDefault();
        if (currentPaging < sumPaging) {
            pageNumContainer.innerHTML = loadPaging_Click(currentPaging + 1, sumPaging);
            loadReviews(document.querySelector(`#pageNums [value="${currentPaging + 1}"]`), new Event('click'));
        }
    });

    nextPageLast.addEventListener('click', function (event) {
        event.preventDefault();
        pageNumContainer.innerHTML = loadPaging_Click(sumPaging, sumPaging);
        loadReviews(document.querySelector(`#pageNums a:last-child`), new Event('click'));
    });
});

// gửi comment
function send_comments(movie_id, user_id, event) {
    event.preventDefault();
    var ratingInput = document.querySelector('input[name="rate"]:checked');
    var rating = ratingInput ? ratingInput.value : '';
    var commentText = document.getElementById('txtComment').value.trim();

    if (!rating || !commentText) {
        alert('Vui lòng chọn xếp hạng và nhập nội dung đánh giá.');
        return;
    }

    // Kiểm tra xem người dùng đã comment cho bộ phim này chưa
    fetch('post', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'check_comment', user_id: user_id, movie_id: movie_id })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Có lỗi xảy ra khi kiểm tra comment.');
            }
            return response.json();
        })
        .then(data => {
            if (data.has_commented) {
                alert('Bạn đã comment cho bộ phim này.');
            } else {
                // Người dùng chưa comment, tiến hành gửi đánh giá
                var now = moment();
                var formattedPostTime = now.utcOffset('+07:00').format('YYYY-MM-DD HH:mm:ss');

                var commentData = {
                    action: 'send_comment',
                    user_id: user_id,
                    movie_id: movie_id,
                    content: commentText,
                    post_time: formattedPostTime,
                    like: parseInt(rating)
                };

                // Gửi đánh giá mới lên server
                fetch('post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(commentData)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Có lỗi xảy ra khi gửi đánh giá.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message); // Hiển thị thông báo từ server
                        console.log('Đánh giá đã được gửi thành công!');
                        if (data.comments_json) {
                            const comments_data = data.comments_json;
                            loadPaging(Math.ceil(comments_data.length / 4), comments_data);
                        } else {
                            loadPaging();
                        }
                    })
                    .catch(error => {
                        console.error('Có lỗi xảy ra khi gửi đánh giá:', error);
                        alert('Có lỗi xảy ra khi gửi đánh giá.');
                    });
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra khi kiểm tra comment:', error);
            alert('Có lỗi xảy ra khi kiểm tra comment.');
        });
}
