<?php
 
use App\Models\Database;
$conn =  Database::connection();
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            c.combo_id,
            c.name AS combo_name,
            SUM(ct.unit_quantity * c.price) AS revenue
        FROM 
            combos c
        JOIN 
            combo_transaction ct ON c.combo_id = ct.combo_id
        JOIN 
            transactions t ON ct.transaction_id = t.transaction_id";

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

$sql .= " GROUP BY c.combo_id, c.name
          ORDER BY revenue DESC";

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
