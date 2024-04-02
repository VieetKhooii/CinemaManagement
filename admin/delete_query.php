<?php
include("connect.php");

// Kiểm tra xem yêu cầu POST có tồn tại không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu gửi từ client và loại bỏ ký tự đặc biệt
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $value = mysqli_real_escape_string($conn, $_POST["value"]);
    $columnName = mysqli_real_escape_string($conn, $_POST["columnName"]);

    // Chuẩn bị câu lệnh SQL sử dụng Prepared Statements
    $query = "UPDATE $name SET display=0 WHERE $columnName = '$value'";
    
    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully"; // Phản hồi cho client
    } else {
        echo "Error updating record: " . mysqli_error($conn); // Phản hồi lỗi cho client nếu có lỗi xảy ra
    }

    // Đóng kết nối đến cơ sở dữ liệu
    mysqli_close($conn);
}

?>