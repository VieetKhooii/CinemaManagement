<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT m.movie_id, m.movie_name, COUNT(r.seat_id) AS total_seats_booked
        FROM movies m
        JOIN showtimes s ON m.movie_id = s.movie_id
        JOIN reservations r ON s.showtime_id = r.showtime_id";

// Kiểm tra xem có ngày được chọn không
if (isset($_GET['date']) && !empty($_GET['date'])) {
    // Nếu có ngày, thêm điều kiện WHERE vào truy vấn SQL
    $date = $_GET['date'];
    // Kiểm tra xem có phải là ngày, tháng và năm, hoặc chỉ năm không
    if (strlen($date) === 10) {
        // Ngày: 'YYYY-MM-DD'
        $sql .= " WHERE s.date = '$date'";
    } else if (strlen($date) === 7) {
        // Tháng và năm: 'YYYY-MM'
        $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m') = '$date'";
    } else if (strlen($date) === 4) {
        // Chỉ năm: 'YYYY'
        $sql .= " WHERE YEAR(s.date) = '$date'";
    }
}

$sql .= " GROUP BY m.movie_id, m.movie_name
          ORDER BY total_seats_booked DESC";

$result = $conn->query($sql);

// Kiểm tra và xử lý kết quả
if ($result->num_rows > 0) {
    $output = array();
    while($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    echo json_encode($output); // Trả về kết quả dưới dạng JSON
} else {
    echo "0 results";
}

$conn->close();

?> 