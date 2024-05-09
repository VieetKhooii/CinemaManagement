<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$min_sql = "SELECT m.movie_id, m.movie_name, COUNT(r.seat_id) AS total_seats_booked
            FROM movies m
            JOIN showtimes s ON m.movie_id = s.movie_id
            JOIN reservations r ON s.showtime_id = r.showtime_id";

if (isset($_GET['date']) && !empty($_GET['date'])) {
    $date = $_GET['date'];
    if (strlen($date) === 10) {
        $min_sql .= " WHERE s.date = '$date'";
    } else if (strlen($date) === 7) {
        $min_sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m') = '$date'";
    } else if (strlen($date) === 4) {
        $min_sql .= " WHERE YEAR(s.date) = '$date'";
    }
}

$min_sql .= " GROUP BY m.movie_id, m.movie_name
              ORDER BY total_seats_booked ASC
              LIMIT 1";

$min_result = $conn->query($min_sql);

if ($min_result->num_rows > 0) {
    $min_row = $min_result->fetch_assoc();
    echo json_encode($min_row);
} else {
    echo json_encode([]);
}
$conn->close();
?>

