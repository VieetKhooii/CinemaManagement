<?php
 
use App\Models\Database;
$conn =  Database::connection();

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DATE_FORMAT(t.purchase_date, '%Y-%m') AS purchase_month, 
            SUM(t.total_cost) AS total_revenue
            FROM 
            transactions t";

// Kiểm tra xem có ngày được chọn không
if (isset($_GET['date']) && !empty($_GET['date'])) {
    // Nếu có ngày, thêm điều kiện WHERE vào truy vấn SQL
    $date = $_GET['date'];
    // Kiểm tra xem có phải là ngày, tháng và năm, hoặc chỉ năm không
    if (strlen($date) === 10) {
        // Ngày: 'YYYY-MM-DD'
        $sql .= " WHERE DATE(t.purchase_date) = '$date'";
    } else if (strlen($date) === 7) {
        // Tháng và năm: 'YYYY-MM'
        $sql .= " WHERE DATE_FORMAT(t.purchase_date, '%Y-%m') = '$date'";
    } else if (strlen($date) === 4) {
        // Chỉ năm: 'YYYY'
        $sql .= " WHERE YEAR(t.purchase_date) = '$date'";
    }
}

$sql .= " GROUP BY purchase_month
             ORDER BY total_revenue ASC
             LIMIT 1";

$result = $conn->query($sql);

// Kiểm tra và xử lý kết quả
if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); // Trả về kết quả dưới dạng JSON
} else {
    echo json_encode([]); // Trả về một mảng JSON rỗng nếu không có kết quả nào được tìm thấy
}

$conn->close();
