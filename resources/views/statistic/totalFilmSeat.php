<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total_sql = "SELECT SUM(total_seats_booked) AS total_seats_booked FROM (
    SELECT COUNT(r.seat_id) AS total_seats_booked
    FROM movies m
    JOIN showtimes s ON m.movie_id = s.movie_id
    JOIN reservations r ON s.showtime_id = r.showtime_id";

if (isset($_GET['date']) && !empty($_GET['date'])) {
    $date = $_GET['date'];
    if (strlen($date) === 10) {
        $total_sql .= " WHERE s.date = '$date'";
    } else if (strlen($date) === 7) {
        $total_sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m') = '$date'";
    } else if (strlen($date) === 4) {
        $total_sql .= " WHERE YEAR(s.date) = '$date'";
    }
}

$total_sql .= " GROUP BY m.movie_id, m.movie_name) AS seats";

$total_result = $conn->query($total_sql);

if ($total_result->num_rows > 0) {
    $total_row = $total_result->fetch_assoc();
    echo json_encode($total_row);
} else {
    echo json_encode([]);
}

$conn->close();
?>