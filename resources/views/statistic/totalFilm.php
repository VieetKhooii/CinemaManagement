<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT
            SUM(total_bonus) AS all_total_bonus
        FROM
            (SELECT
                movie_id,
                movie_name,
                SUM(total_bonus) AS total_bonus
            FROM
                (SELECT
                    m.movie_id,
                    m.movie_name,
                    -- s.showtime_id,
                    COUNT(r.reservation_id) AS reservation_count,
                    m.bonus_price * COUNT(r.reservation_id) + r.price * COUNT(r.reservation_id) AS total_bonus
                FROM
                    movies m
                JOIN
                    showtimes s ON m.movie_id = s.movie_id
                LEFT JOIN
                    reservations r ON s.showtime_id = r.showtime_id";

// Kiểm tra xem có ngày được chọn không
if (isset($_GET['date']) && !empty($_GET['date'])) {
    // Nếu có ngày, thêm điều kiện WHERE vào truy vấn SQL
    $date = $_GET['date'];
    // Kiểm tra xem có phải là ngày, tháng và năm, hoặc chỉ năm không
    if (strlen($date) == 10) {
        // Ngày: 'YYYY-MM-DD'
        $sql .= " WHERE DATE(s.date) = '$date'";
    } else if (strlen($date) == 7) {
        // Tháng và năm: 'YYYY-MM'
        $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m') = '$date'";
    } else if (strlen($date) == 4) {
        // Chỉ năm: 'YYYY'
        $sql .= " WHERE YEAR(s.date) = '$date'";
    }
}

$sql .= "       GROUP BY
                    m.movie_id, m.movie_name, r.price) AS subquery
            GROUP BY
                movie_id, movie_name) AS subquery2";


$result = $conn->query($sql);

// Kiểm tra và xử lý kết quả
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    echo json_encode($row); // Trả về tổng dưới dạng JSON
} else {
    echo json_encode([]); // Trả về 0 nếu không có kết quả
}

$conn->close();
?>
