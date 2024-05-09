<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$max_sql = "SELECT m.movie_id, m.movie_name, COUNT(r.seat_id) AS total_seats_booked
FROM movies m
JOIN showtimes s ON m.movie_id = s.movie_id
JOIN reservations r ON s.showtime_id = r.showtime_id";
$date = $_GET['date'];

    if (isset($date) && !empty($date)) {
        if (strlen($date) === 10) {
            $max_sql .= " WHERE s.date = '$date'";
        } else if (strlen($date) === 7) {
            $max_sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m') = '$date'";
        } else if (strlen($date) === 4) {
            $max_sql .= " WHERE YEAR(s.date) = '$date'";
        }
    }

$max_sql .= " GROUP BY m.movie_id, m.movie_name
  ORDER BY total_seats_booked DESC
  LIMIT 1";

$max_result = $conn->query($max_sql);

if ($max_result->num_rows > 0) {
    $max_row = $max_result->fetch_assoc();
    echo json_encode($max_row);
} else {
    // Trả về một đối tượng JSON rỗng nếu không có kết quả nào được tìm thấy
    echo json_encode([]);
}

$conn->close();
?>