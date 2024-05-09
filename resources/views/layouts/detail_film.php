<link rel="stylesheet" href="../css/detail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<?php
// $comments = [
//     ['author' => 'Alice', 'content' => 'Phim hay quá!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Bob', 'content' => 'Đúng vậy!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Charlie', 'content' => 'Tôi đồng ý!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'David', 'content' => 'Tuyệt vời!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Eva', 'content' => 'Cảm ơn về bài đánh giá!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Fiona', 'content' => 'Rất hữu ích!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'George', 'content' => 'Phim không ấn tượng lắm.', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Helen', 'content' => 'Tôi không thích cách kết thúc của phim.', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Ivy', 'content' => 'Phim tệ quá.', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Jack', 'content' => 'Một trong những bộ phim hay nhất mà tôi từng xem!', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))],
//     ['author' => 'Kate', 'content' => 'Tôi thích cách diễn xuất của diễn viên chính.', 'rating' => rand(0, 10), 'date' => date('Y-m-d H:i:s', rand(1, time()))]
// ];
// // Convert array to JSON
// $comments_json = json_encode($comments);
?>



<div class="container_detail" id="container_detail">
    <div class="trailer_container">
        <div class="trailer">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $detail_movie['trailer_code']?>?rel=0&modestbranding=1&controls=1&fs=0&showinfo=0&autohiden=0" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="wide_inner_main">
        <div class="wide_inner">
            <div class="wide_top">
                <div class="thumb">
                    <!-- <div id="img_icon">
                    <img src="/resources/img/film_icon-removebg-preview.png" alt="">
                </div> -->
                    <div id="film">
                        <img src="<?php echo $detail_movie['image'] ?>" alt="">
                        <button type="button" onclick=show()>Đặt Vé</button>
                    </div>
                </div>
                <div class="info_main" id="info_main">
                    <div class="header_detail">Nội Dung Phim</div>
                    <div class="info_main_text">
                        <div class="info_name"><?php echo $detail_movie['movie_name'] ?></div>
                        <div class="info_spec rate_main"><span>Xếp Hạng: </span><?php  echo number_format($rateUser, 1);?>
                            <div class="rate_info">
                                <input type="radio" name="rate">
                            </div>
                        </div>
                        <div class="info_spec"> <span>Ngày phát hành: </span><?php echo $detail_movie['first_show_date']?></div>
                        <div class="info_spec"> <span>Thời Lượng: </span><?php echo $detail_movie['duration'] ?> Phút</div>
                        <div class="info_spec"> <span>Loại: </span><?php echo $detail_movie['category_name'] ?></div>
                        <div class="info_summary">
                            <span>Tóm Tắt</span>
                            <p><?php echo $detail_movie['movie_description'] ?></p>
                        </div>
                    </div>
                    <div class="info_main_design">
                        <div id="img_ticket"><img src="/img/ticket_film-removebg-preview.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="review_box">
        <div class="review_wrap">
            <div class="review_top">
                <h3>Xếp Hạng Và Đánh Giá Phim</h3>
            </div>
            <div class="score_area">
                <fieldset>
                    <div class="score_star">
                        <strong>Xếp Hạng</strong>
                        <div class="star_wrap">
                            <input type="radio" name="rate" value="10">
                            <input type="radio" name="rate" value="9">
                            <input type="radio" name="rate" value="8">
                            <input type="radio" name="rate" value="7">
                            <input type="radio" name="rate" value="6">
                            <input type="radio" name="rate" value="5">
                            <input type="radio" name="rate" value="4">
                            <input type="radio" name="rate" value="3">
                            <input type="radio" name="rate" value="2">
                            <input type="radio" name="rate" value="1">
                        </div>
                        <em>0 điểm</em>
                    </div>
                    <?php 
                        use \Illuminate\Support\Facades\Cookie;
                            $cookie = Cookie::get('jwt_role');
                            $cookie_data = json_decode($cookie, true);
                            $user_id = isset($cookie_data['user_id']) ? $cookie_data['user_id'] : 'Unknown';
                        ?>
                    <div class="score_textarea"> <textarea id="txtComment" cols="30" rows="10" maxlength="200" placeholder="Vui Lòng Viết Đánh Giá Phim"></textarea></div>
                    <a href="#" class="btnsave" onclick="send_comments('<?php echo $detail_movie['movie_id'] ?>', '<?php echo $user_id?>',event)"><i class="fa-solid fa-comment-dots"></i><span>Bình Luận</span></a>
                    <p>0/200 Ký Tự</p>
                </fieldset>
            </div>
            <div class="review_entry">
                <ul class="ulReviews">
                    <!-- comments -->
                    <!-- <li>
                    <div class="score_box">
                        <div class="score_sum">
                            <div class="name_user_review">bùi Thành tài</div>
                            <div class="star_wrap">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                                <input type="radio" name="rate">
                            </div>
                            <div class="user_score">8 điểm</div>
                        </div>
                        <p class="result_txt">phim hay vl luôn</p>
                        <div class="result_footer">
                            <div class="date_post">12/4/2024</div>
                        </div>
                    </div>
                </li> -->
                </ul>
            </div>
            <div class="paging">
                <div class="paging_btn">
                    <a href="#" id="prevPageFirst"><i class="fa-solid fa-angles-left"></i></a>
                    <a href="#" id="prevPage"><i class="fa-solid fa-angle-left"></i></a>
                    <div class="num_page" id="pageNums">
                        <!-- <a href="#" class="chosen_paging" onclick="loadReviews(this,event)" value="1">1</a>
                    <a href="#" onclick="loadReviews(this, event)" value="2">2</a>
                    <span>...</span>
                    <a href="#" onclick="loadReviews(this,event)" value="4">4</a>
                    <a href="#" onclick="loadReviews(this,event)" value="5">5</a> -->
                    </div>
                    <a href="#" id="nextPage"><i class="fa-solid fa-angle-right"></i></a>
                    <a href="#" id="nextPageLast"><i class="fa-solid fa-angles-right"></i></a>
                </div>
                <div class="total">Tổng: <span>0</span></div>
            </div>
            <div class="warn_sbox">
                <div class="warn_header">
                    <i class="fa-solid fa-triangle-exclamation"></i> Lưu ý
                </div>
                <div class="warn_info">Mỗi tài khoản chỉ có thể đánh giá một lần cho mỗi lượt truy cập. Đánh giá khi đã thực hiện thì không thể chỉnh sửa.
                    Tài khoản của bạn phải là thành viên và đã mua vé xem phim mới có thể tham gia đánh giá phim.
                    Bạn có thể kiểm tra lại phần đánh giá của mình trong My Cinema.
                </div>
            </div>
        </div>
    </div>


</div>
<script src="../js/foot_item.js"></script>
<script>
    window.onload = function() {
        const comments_data =  <?php echo $comments_json?>;
        var sumPaging = Math.ceil(comments_data.length / 4);
        // console.log(comments_data)
        loadPaging(sumPaging, comments_data);
        var liReview = document.querySelectorAll('.ulReviews li')
        // console.log(liReview)
        if (liReview.length === 0) {
            var paging = document.querySelector('.paging')
            paging.style.display='none'
        }
        var starwrap = document.querySelectorAll('.score_area .score_star .star_wrap input');
        var textStar = document.querySelector('.score_area .score_star em');
        var currentScore = 0;
        starwrap.forEach(function(star) {
            star.addEventListener('mouseenter', function() {
                currentScore = parseInt(textStar.innerText); // Chuyển đổi giá trị thành số nguyên
                textStar.innerText = star.getAttribute('value') + " điểm";
            });

            star.addEventListener('click', function() {
                currentScore = parseInt(star.getAttribute('value'));
                textStar.innerText = star.getAttribute('value') + " điểm";
            });

            star.addEventListener('mouseleave', function() {
                textStar.innerText = currentScore + " điểm";
            });
        });


    };
</script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
