<link rel="stylesheet" href="../css/screen_cwrap.css">
<?php
include('database.php');
$result = mysqli_query($con, "select * from movie, showtime,category where showtime.movie_id = movie.movie_id and movie.category_id=category.category_id and movie.display='1' and showtime.date <= now()");
// $result = mysqli_query($con, "select * from movie");
$result2 = mysqli_query($con, "select * from movie, showtime,category where showtime.movie_id = movie.movie_id and movie.category_id=category.category_id and movie.display='0' and showtime.date <= now()");

$moviesOnScreen = array();
$moviesComingUp = array();

// Duyệt qua từng dòng dữ liệu và thêm vào mảng
while ($row = mysqli_fetch_assoc($result)) {
    $movieInfo = array(
        'movie_id' => $row['movie_id'],
        'movie_name' => $row['movie_name'],
        'movie_description' => $row['movie_description'],
        'duration' => $row['duration'],
        'bonus_price' => $row['bonus_price'],
        'movie_description' =>  $row['movie_description'],
        'date' =>   date('d-m-y', strtotime($row['date'])),
        'start_time' =>  $row['start_time'],
        'category_name' =>  $row['category_name'],
    );
    $moviesOnScreen[] = $movieInfo;
}
while ($row = mysqli_fetch_assoc($result2)) {
    $movieInfo2 = array(
        'movie_id' => $row['movie_id'],
        'movie_name' => $row['movie_name'],
        'movie_description' => $row['movie_description'],
        'duration' => $row['duration'],
        'bonus_price' => $row['bonus_price'],
        'movie_description' =>  $row['movie_description'],
        'date' =>   date('d-m-y', strtotime($row['date'])),
        'start_time' =>  $row['start_time'],
        'category_name' =>  $row['category_name'],
    );
    $moviesComingUp[] = $movieInfo2;
}
?>
<!-- Hiển thị danh sách các bộ phim trên giao diện -->
<div id="content_film">
    <div class="screenwrap" id="screenwrap">
        <div class="head_film">
            <ol class="menu_head">
                <li><button type="button" class="hover_header Choosed" id="onScreen" data-movies="<?php echo htmlspecialchars(json_encode($moviesOnScreen), ENT_QUOTES, 'UTF-8'); ?>" onclick="header_choose('onScreen')">Phim Đang Chiếu</button></li>
                <li><button type="button" class="hover_header" id="coming_up" data-movies="<?php echo htmlspecialchars(json_encode($moviesComingUp), ENT_QUOTES, 'UTF-8'); ?>" onclick="header_choose('coming_up')">Phim Sắp Chiếu</button></li>
            </ol>
        </div>
        <div class="plottingQC" id="plottingQC">
            <img src="../img/film_hot_pick.jpg" alt="">
        </div>
        <?php ?>
        <div class="tab_list" id="tab_list">
            <div class="list_item_film" id="list_item_film">

            </div>
        </div>
    </div>
</div>

<script src="../js/foot_item.js"></script>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        var movies = <?php echo json_encode($movies); ?>;
        type_film(movies); // Gọi hàm type_film với tham số là biến movies
        showItem(movies.length);
    });
</script>
