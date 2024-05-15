<?php

namespace App\Models;
use App\Models\Database;
use Illuminate\Database\Eloquent\Model;

// Hàm để lấy thông tin phim từ CSDL dựa trên movie_id
class Film_booking_model extends Model{
    function get_movie_by_date($movie_date)
{
    $con = Database::connection();
    if (!$con) {
        die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $stmt = $con->prepare(
        "SELECT movies.movie_id, movies.movie_name
    FROM showtimes 
    JOIN movies ON movies.movie_id = showtimes.movie_id 
    WHERE showtimes.date = ?
    GROUP BY movies.movie_id, movies.movie_name;
    "
    );
    $stmt->bind_param("s", $movie_date);
    // Thực hiện truy vấn
    if (!$stmt->execute()) {
        die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
    }

    // Lấy kết quả trả về
    $result = $stmt->get_result();

    // Khởi tạo một mảng để lưu danh sách các phim
    $movies = array();

    // Lặp qua kết quả và lưu thông tin của mỗi phim vào mảng $movies
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }

    // Đóng statement
    $stmt->close();

    // Trả về mảng danh sách các phim
    return $movies;
}

// Lấy suất chiếu theo ngày
function get_showtime_by_date($showtime_date, $showtime_movie)
{
    $con = Database::connection();
    if (!$con) {
        die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $stmt = $con->prepare("SELECT *
    FROM showtimes
    JOIN rooms ON showtimes.room_id = rooms.room_id
    JOIN movies ON showtimes.movie_id = movies.movie_id
    WHERE showtimes.date = ? and showtimes.movie_id= ?
    ");
    $stmt->bind_param("ss", $showtime_date, $showtime_movie);
    // Thực hiện truy vấn
    if (!$stmt->execute()) {
        die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
    }

    // Lấy kết quả trả về
    $result = $stmt->get_result();

    // Khởi tạo một mảng để lưu danh sách các phim
    $showtime = array();

    // Lặp qua kết quả và lưu thông tin của mỗi phim vào mảng $showtime
    while ($row = $result->fetch_assoc()) {
        $showtime[] = $row;
    }

    // Đóng statement
    $stmt->close();

    // Trả về mảng danh sách các phim
    return $showtime;
}

function get_combos()
{
    $con = Database::connection();
    if (!$con) {
        die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $stmt = $con->prepare("select *
    FROM combos
    WHERE display = 1
    ");
    // Thực hiện truy vấn
    if (!$stmt->execute()) {
        die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
    }

    // Lấy kết quả trả về
    $result = $stmt->get_result();

    // Khởi tạo một mảng để lưu danh sách các phim
    $combos = array();

    // Lặp qua kết quả và lưu thông tin của mỗi phim vào mảng $combos
    while ($row = $result->fetch_assoc()) {
        $combos[] = $row;
    }

    // Đóng statement
    $stmt->close();

    // Trả về mảng danh sách các phim
    return $combos;
}


function get_reserved_seat($showtime_id)
{
    $con = Database::connection();
    if (!$con) {
        die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $stmt = $con->prepare("SELECT seat_id FROM reservations
    where showtime_id = ?;
    ");
    $stmt->bind_param("s", $showtime_id);
    // Thực hiện truy vấn
    if (!$stmt->execute()) {
        die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
    }

    // Lấy kết quả trả về
    $result = $stmt->get_result();

    // Khởi tạo một mảng để lưu danh sách các phim
    $seats = array();

    // Lặp qua kết quả và lưu thông tin của mỗi phim vào mảng $seats
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }

    // Đóng statement
    $stmt->close();

    // Trả về mảng danh sách các phim
    return $seats;
}

// Lấy ghế theo suất chiếu
function get_seat_by_showtime($showtime_id, $room_id)
{
    $con = Database::connection();
    if (!$con) {
        die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $stmt = $con->prepare("SELECT COUNT(*) AS total_reserved_seats
    FROM reservations
    WHERE showtime_id = ?
    ");
    $stmt->bind_param("s", $showtime_id);
    // Thực hiện truy vấn
    if (!$stmt->execute()) {
        die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
    }

    // Lấy kết quả trả về
    $result = $stmt->get_result();

    // Lấy dòng kết quả duy nhất
    $row = $result->fetch_assoc();

    // Lấy tổng số ghế đã đặt
    $total_reserved_seats = $row['total_reserved_seats'];

    // Đóng statement
    $stmt->close();

    // Lấy tổng số ghế trong phòng
    $stmt = $con->prepare("SELECT *
    FROM rooms
    where room_id = ?
    and display = '1' 
    ");
    $stmt->bind_param("s", $room_id);
    // Thực hiện truy vấn
    if (!$stmt->execute()) {
        die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
    }

    // Lấy kết quả trả về
    $result = $stmt->get_result();

    // Lấy dòng kết quả duy nhất
    $row = $result->fetch_assoc();

    // Lấy tổng số ghế trong phòng
    $total_seats = $row['number_of_seat'];

    // Đóng statement
    $stmt->close();

    // Tạo mảng kết quả với thông tin ghế và tổng số ghế
    $seat = array(
        'total_reserved_seats' => $total_reserved_seats,
        'total_seats' => $total_seats
    );

    // Trả về mảng thông tin ghế
    return $seat;
}
}
