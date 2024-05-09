<?php
namespace App\Models;
class Database{
    public static function connection() {
        $con = mysqli_connect("localhost", "root", "@Abc1234");
        
        // Kiểm tra kết nối
        if (!$con) {
            die('Could not connect to database: ' . mysqli_connect_error());
        }
        
        // Chọn cơ sở dữ liệu
        mysqli_select_db($con, "cinema");
        
        // Return the database connection object
        return $con;
    }
}
?>
