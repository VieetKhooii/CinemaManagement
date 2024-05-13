<?php
namespace App\Http\Controllers;
use App\Models\Film_booking_model;

// Xử lý gửi đánh giá khi nhận yêu cầu POST từ JavaScript
class Film_booking_controller extends Controller{
    protected $film_booking_model;
    public function __construct(Film_booking_model $film_booking_model){
        $this->film_booking_model = $film_booking_model;
    }
    function filmBooking(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date_choose = json_decode(file_get_contents('php://input'), true);
            if ($date_choose["action"] === "load_film") {
                $result = $this->film_booking_model->get_movie_by_date($date_choose['date']);
                if ($result) {
                    // Trả về kết quả cho client
                    http_response_code(200);
                    echo json_encode(['message' => 'Load ngày thành công!', 'film_date' => $result]);
                } else {
                    // Trả về thông báo lỗi cho client
                    http_response_code(500);
                    echo json_encode(['message' => 'Hông có phim', 'film_date' => $result]);
                }
            } elseif ($date_choose["action"] === "load_showtime") {
                $result = $this->film_booking_model->get_showtime_by_date($date_choose['date'], $date_choose['movie']);
                if ($result) {
                    // Khởi tạo mảng để lưu thông tin ghế cho mỗi room_id
                    $seat_info = array();
        
                    // Lặp qua từng dòng kết quả
                    foreach ($result as $row) {
                        // Lấy giá trị của cột room_id từ dòng kết quả hiện tại
                        $showtime_id = $row['showtime_id'];
                        $room_id = $row['room_id'];
                        // Gọi hàm get_seat_by_showtime để lấy thông tin ghế cho room_id hiện tại
                        $seats = $this->film_booking_model->get_seat_by_showtime($showtime_id,$room_id);
                        $combos = $this->film_booking_model->get_combos();
                        $reserved_seats = $this->film_booking_model->get_reserved_seat($showtime_id);
                        // Lưu thông tin vào mảng seat_info
                        $seatcount[$showtime_id] = $seats;
                    }
                    http_response_code(200);
                    echo json_encode(['message' => 'Load suất chiếu thành công!', 'showtime' => $result, 'seatcount' => $seatcount, 'combos' => $combos, 'reserved_seats' => $reserved_seats]);
                } else {
                    foreach ($result as $row) {
                        $showtime_id = $row['showtime_id'];
                        $room_id = $row['room_id'];
                        // Gọi hàm get_seat_by_showtime để lấy thông tin ghế cho room_id hiện tại
                        $seats = $this->film_booking_model->get_seat_by_showtime($showtime_id,$room_id);
                        $combos = $this->film_booking_model->get_combos();
                        $reserved_seats = $this->film_booking_model->get_reserved_seat($showtime_id);
                        // Lưu thông tin vào mảng seat_info
                        $seatcount[$showtime_id] = $seats;
                    }
                    // Trả về thông báo lỗi cho client
                    http_response_code(200);
                    echo json_encode(['message' => 'Hông có suất chiếu', 'showtime' => $result, 'seatcount' => $seatcount, 'combos' => $combos, 'reserved_seats' => $reserved_seats]);
                }
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Xử lý yêu cầu GET
            // $movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : '';
        
            // if (!empty($movie_id)) {
        
                // $movie_focus = $movie_id;
                // echo "<script>var movieFocus = '$movie_focus';</script>";
                // include '../views/film_booking.php'; // Hiển thị view chi tiết phim
        
            // } else {
            //     // http_response_code(400);
            //     // echo json_encode(['error' => 'Không có movie_id `được cung cấp']);
            //     include '../views/film_booking.php'; // Hiển thị vi`ew chi tiết phim
        
            // }
        } else {
            // Trả về thông báo lỗi cho client nếu không phải là yêu cầu POST hoặc GET
            http_response_code(405);
            echo json_encode(['message' => 'Phương thức không được hỗ trợ.']);
        }
    }
}
