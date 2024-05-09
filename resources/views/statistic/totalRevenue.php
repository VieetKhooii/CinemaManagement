<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT
            YEAR(purchase_date) AS purchase_year,
            SUM(total_cost) AS total_revenue
        FROM
            transactions";

// Kiểm tra xem có ngày được chọn không
if (isset($_GET['date']) && !empty($_GET['date'])) {
    // Nếu có ngày, thêm điều kiện WHERE vào truy vấn SQL
    $date = $_GET['date'];
    // Kiểm tra xem có phải là ngày, tháng và năm, hoặc chỉ năm không
    if (strlen($date) === 10) {
        // Ngày: 'YYYY-MM-DD'
        $sql .= " WHERE DATE(purchase_date) = '$date'";
    } else if (strlen($date) === 7) {
        // Tháng và năm: 'YYYY-MM'
        $sql .= " WHERE DATE_FORMAT(purchase_date, '%Y-%m') = '$date'";
    } else if (strlen($date) === 4) {
        // Chỉ năm: 'YYYY'
        $sql .= " WHERE YEAR(purchase_date) = '$date'";
    }
}

$sql .= " GROUP BY purchase_year"; // Nhóm kết quả theo năm

$result = $conn->query($sql);

// Kiểm tra và xử lý kết quả
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo json_encode($row); // Trả về kết quả dưới dạng JSON
} else {
    echo json_encode([]); // Trả về mảng rỗng nếu không có kết quả
}

$conn->close();
