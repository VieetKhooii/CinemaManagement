<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem dữ liệu được gửi lên có đúng định dạng FormData hay không
    if (isset($_POST['tableName'])) {
        // Lấy tên bảng từ dữ liệu gửi lên
        $tableName = $_POST['tableName'];

        // Loại bỏ phần tử tableName từ mảng dữ liệu
        unset($_POST['tableName']);

        // Xử lý dữ liệu hình ảnh nếu có
        if (isset($_FILES['image_upload'])) {
            $imageFile = $_FILES['image_upload'];
            $imageFileName = isset($imageFile['name']) ? $imageFile['name'] : '';
            $imageTempName = isset($imageFile['tmp_name']) ? $imageFile['tmp_name'] : '';

            // Kiểm tra xem có file hình ảnh được gửi lên hay không
            if (!empty($imageFileName) && !empty($imageTempName)) {
                // Di chuyển và lưu trữ hình ảnh vào thư mục chỉ định
                $targetPath = "uploads/" . basename($imageFileName);
                move_uploaded_file($imageTempName, $targetPath);

                // Thêm đường dẫn hình ảnh vào dữ liệu để lưu vào cơ sở dữ liệu
                $_POST['image'] = $targetPath;
            } else {
                echo "Không có hình ảnh được gửi lên.";
                exit; // Thoát khỏi script nếu không có hình ảnh được gửi lên
            }
        }

        // Kiểm tra nếu seat_id vẫn là giá trị mặc định ' ', thì ghép room_id + seat_row + seat_number
        if ($tableName=='seat'&& $_POST['seat_id'] == '') {
            // Kiểm tra xem có đủ thông tin để tạo seat_id không
            if (isset($_POST['room_id']) && isset($_POST['seat_row']) && isset($_POST['seat_number'])) {
                // Ghép room_id + seat_row + seat_number để tạo seat_id
                $seat_id = $_POST['room_id'] . $_POST['seat_row'] . $_POST['seat_number'];
                $_POST['seat_id'] = $seat_id;
            }
        }
        else if ($tableName=='users'  && isset($_POST['user_id'])){
            $tempName='';
            if ($_POST['role_id']=='1') {
                $tempName='AD'; 
            }
            else if ($_POST['role_id']=='2' ){
                $tempName='EMP';
            }
            else if ($_POST['role_id']=='3' ){
                $tempName='CLI'; 
            }
            else if ($_POST['role_id']=='4' ){
                $tempName='VIP';
            }
            else if ($_POST['role_id']=='5' ){
                $tempName='PLA';
            }
            $query = "SELECT COUNT(*) AS ad_count FROM users WHERE user_id LIKE '$tempName%'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $row['ad_count']++;
            if ($row['ad_count']<10){
                $user_id = $tempName.'00' . $row['ad_count'];
            }
            else if($row['ad_count']>=10||$row['ad_count']<100){
                $user_id = $tempName.'0' . $row['ad_count'];
            }
            else{
                $user_id = $tempName . $row['ad_count'];
            }
            $_POST['user_id'] = $user_id;
        }
        

        // Xây dựng truy vấn INSERT dựa vào dữ liệu đã nhận được
        $columns = implode(", ", array_keys($_POST));
        $values = "'" . implode("', '", array_values($_POST)) . "'";
        $query = "INSERT INTO $tableName ($columns) VALUES ($values)";

        // Thực thi truy vấn INSERT
        if (mysqli_query($conn, $query)) {
            echo "Dữ liệu đã được chèn thành công vào bảng $tableName.";
        } else {
            echo "Lỗi: " . $query . "<br>" . mysqli_error($conn);
        }

        // Đóng kết nối cơ sở dữ liệu
        mysqli_close($conn);
    } else {
        echo "Dữ liệu không hợp lệ.";
    }
} else {
    echo "Phương thức không được hỗ trợ.";
}



// // Kết nối cơ sở dữ liệu
// include("connect.php");

// // Đọc dữ liệu được gửi từ JavaScript
// $data = json_decode(file_get_contents("php://input"), true);

// // Kiểm tra xem dữ liệu đã được gửi thành công hay không
// if (!empty($data)) {
//     // Lấy tên bảng từ dữ liệu gửi đi
//     $tableName = $data['tableName'];

//     // Kiểm tra nếu bảng là 'category'
//     if ($tableName === 'category') {
//         // Lấy các trường dữ liệu từ dữ liệu gửi đi
//         $category_id = $data['category_id'];
//         $category_name = $data['category_name'];
//         $display = $data['display'];

//         // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng 'category'
//         $query = "INSERT INTO category (category_id, category_name, display) VALUES ('$category_id', '$category_name', '$display')";

//         // Thực hiện truy vấn
//         if ($conn->query($query) === TRUE) {
//             // Trả về thông báo thành công nếu truy vấn được thực hiện thành công
//             echo "Dữ liệu đã được chèn thành công vào bảng 'category'!";
//         } else {
//             // Trả về thông báo lỗi nếu có lỗi xảy ra trong quá trình thực hiện truy vấn
//             echo "Đã xảy ra lỗi khi chèn dữ liệu vào bảng 'category': " . $conn->error;
//         }
//     } 
//     else if ($tableName === 'combo') {
//         // Lấy các trường dữ liệu từ dữ liệu gửi đi
//         $combo_id = $data['combo_id'];
//         $price = $data['price'];
//         $name = $data['name'];
//         $description=$data['description'];
//         $image=$data['image'];
//         $display=$data['display'];

//         // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng 'combo'
//         $query = "INSERT INTO combo (combo_id, price, name, description, image, display) VALUES ('$combo_id', '$price', '$name', '$description', '$image', '$display')";

//         // Thực hiện truy vấn
//         if ($conn->query($query) === TRUE) {
//             // Trả về thông báo thành công nếu truy vấn được thực hiện thành công
//             echo "Dữ liệu đã được chèn thành công vào bảng 'combo'!";
//         } else {
//             // Trả về thông báo lỗi nếu có lỗi xảy ra trong quá trình thực hiện truy vấn
//             echo "Đã xảy ra lỗi khi chèn dữ liệu vào bảng 'combo': " . $conn->error;
//         }
//     } 
    
//     else {
//         // Thông báo lỗi nếu tên bảng không hợp lệ
//         echo "Tên bảng không hợp lệ!";
//     }
// } else {
//     // Thông báo nếu không có dữ liệu được gửi đi
//     echo "Không có dữ liệu được gửi đi!";
// }

// // Đ



?>