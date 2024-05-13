<?php
namespace App\Models;
// include_once 'database.php';
use App\Models\Database;

class Detail_model{

    // Hàm để lấy thông tin phim từ CSDL dựa trên movie_id
    static function get_movie_by_id($movie_id)
    {
        $con = Database::connection();
        if (!$con) {
            die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
        }
        $stmt = $con->prepare("SELECT movies.*, categories.*, MIN(showtimes.date) AS first_show_date
        FROM movies
        JOIN categories ON movies.category_id = categories.category_id
        JOIN showtimes ON movies.movie_id = showtimes.movie_id
        WHERE movies.movie_id = ?
        GROUP BY movies.movie_id"
        );
        $stmt->bind_param("s", $movie_id);
        // Thực hiện truy vấn
        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        // Lấy kết quả trả về
        $result = $stmt->get_result();

        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            // Lấy thông tin phim từ kết quả trả về
            $movie = $result->fetch_assoc();
            return $movie;
        } else {
            // Trả về null nếu không tìm thấy thông tin phim
            return null;
        }

        // Đóng statement
        
    }
    //hàm tính số điểm trung bình của phim khi được đánh giá
    static function getRank($movie_id) {
        $con = Database::connection();
        if (!$con) {
            die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
        }

        $stmt = $con->prepare("SELECT AVG(`like`) AS avg_like FROM `comments` WHERE `movie_id` = ?");
        $stmt->bind_param("s", $movie_id);

        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $average_like = $row['avg_like'];
            // Kiểm tra nếu $average_like là NULL, trả về 0 thay vì NULL
            if ($average_like === null) {
                return 0;
            } else {
                return $average_like;
            }
        } else {
            return 0;
        }

        
    }
    // hàm lấy danh sách comment của phim

    // Hàm để lấy danh sách các comment của phim dựa trên movie_id
    static function get_comment_by_id($movie_id)
    {
        $con = Database::connection();
        if (!$con) {
            die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
        }
        
        // Truy vấn SQL để lấy các comment của phim dựa trên movie_id
        $stmt = $con->prepare("SELECT comments.*, users.full_name 
                                FROM comments 
                                LEFT JOIN users ON comments.user_id = users.user_id 
                                WHERE comments.movie_id = ?
                                ORDER BY comments.post_time DESC");
        $stmt->bind_param("s", $movie_id);

        // Thực hiện truy vấn
        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        // Lấy kết quả trả về
        $result = $stmt->get_result();

        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            // Khởi tạo mảng để chứa danh sách các comment
            $comments = array();

            // Lặp qua các dòng kết quả để lấy thông tin từng comment
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row; // Thêm comment vào mảng
            }

            return $comments; // Trả về danh sách các comment
        } else {
            // Trả về mảng rỗng nếu không có comment nào
            return array();
        }

        // Đóng statement
        
    }

    static function get_comment_by_user($user_id)
    {
        $con = Database::connection();
        if (!$con) {
            die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
        }
        
        // Truy vấn SQL để lấy các comment của phim dựa trên user_id
        $stmt = $con->prepare("SELECT comments.*, movies.movie_name
                                FROM comments
                                LEFT JOIN movies ON comments.movie_id = movies.movie_id
                                WHERE comments.user_id = ?
                                ORDER BY comments.post_time DESC");
        $stmt->bind_param("s", $user_id);

        // Thực hiện truy vấn
        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        // Lấy kết quả trả về
        $result = $stmt->get_result();

        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            // Khởi tạo mảng để chứa danh sách các comment
            $comments = array();

            // Lặp qua các dòng kết quả để lấy thông tin từng comment
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row; // Thêm comment vào mảng
            }

            return $comments; // Trả về danh sách các comment
        } else {
            // Trả về mảng rỗng nếu không có comment nào
            return array();
        }

        // Đóng statement
        
    }

    // Hàm để thêm comment vào bảng comments
    static function send_comment($commentData) {
        $con = Database::connection();

        // Extract dữ liệu từ commentData
        $user_id = $commentData['user_id'];
        $movie_id = $commentData['movie_id'];
        $content = $commentData['content'];
        $post_time = $commentData['post_time'];
        $like = $commentData['like'];

        // Chuẩn bị câu truy vấn SQL
        $stmt = $con->prepare("INSERT INTO comments (user_id, movie_id, content, post_time, `like`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $user_id, $movie_id, $content, $post_time, $like);
        

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            // Trả về true nếu thêm thành công
            return true;
        } else {
            // Trả về false nếu thêm thất bại
            return false;
        }

        // Đóng statement
        
    }
    // Hàm để kiểm tra xem người dùng đã comment cho bộ phim này chưa
    static function hasUserCommented($user_id, $movie_id) {
        $con = Database::connection();

        if (!$con) {
            die("Lỗi kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
        }

        // Chuẩn bị câu truy vấn để kiểm tra số lượng comment của người dùng cho bộ phim
        $stmt = $con->prepare("SELECT COUNT(*) AS count FROM comments WHERE user_id = ? AND movie_id = ?");
        $stmt->bind_param("ss", $user_id, $movie_id);

        // Thực thi câu truy vấn
        if (!$stmt->execute()) {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }

        // Lấy kết quả trả về
        $result = $stmt->get_result();

        // Lấy số lượng comment của người dùng cho bộ phim
        $row = $result->fetch_assoc();
        $comment_count = $row['count'];

        // Trả về true nếu người dùng đã comment cho bộ phim này
        return $comment_count > 0;
    }

}