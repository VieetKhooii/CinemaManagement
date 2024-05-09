<?php
namespace App\Http\Controllers;

use App\Models\Detail_model;
use Illuminate\Http\Request;



// Xử lý gửi đánh giá khi nhận yêu cầu POST từ JavaScript
class DetailController extends Controller{

    public function get(Request $request){
        $movie_id = $request->query('movie_id');
        // $movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : '';
        if (!empty($movie_id)) {
            $detail_movie = Detail_model::get_movie_by_id($movie_id);
            $rateUser = Detail_model::getRank($movie_id);
            $comments = Detail_model::get_comment_by_id($movie_id);
            $comments_json = json_encode($comments);
    
            if ($detail_movie) {
                return view("/layouts/detail_film", [
                    'detail_movie' => $detail_movie,
                    'rateUser' => $rateUser,
                    'comments' => $comments,
                    'comments_json' => $comments_json
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Không tìm thấy thông tin phim']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Không có movie_id được cung cấp']);
        }
    } 
        
    public function post(){
        $input = json_decode(file_get_contents('php://input'), true);
    
        if (!empty($input['action'])) {
            $action = $input['action'];
    
            if ($action === 'check_comment') {
                // Xử lý kiểm tra người dùng đã comment cho bộ phim này chưa
                $user_id = $input['user_id'];
                $movie_id = $input['movie_id'];
    
                $has_commented = Detail_model::hasUserCommented($user_id, $movie_id);
    
                // Trả về kết quả cho client
                http_response_code(200);
                echo json_encode(['has_commented' => $has_commented]);
            } elseif ($action === 'send_comment') {
                // Xử lý gửi đánh giá từ người dùng
                $user_id = $input['user_id'];
                $movie_id = $input['movie_id'];
                $content = $input['content'];
                $post_time = $input['post_time'];
                $like = $input['like'];
    
                $result = Detail_model::send_comment([
                    'user_id' => $user_id,
                    'movie_id' => $movie_id,
                    'content' => $content,
                    'post_time' => $post_time,
                    'like' => $like
                ]);
    
                if ($result) {
                    $comments = Detail_model::get_comment_by_id($movie_id); // Lấy danh sách comment sau khi gửi
    
                    // Trả về kết quả cho client
                    http_response_code(200);
                    echo json_encode(['message' => 'Đánh giá đã được gửi thành công!', 'comments_json' => $comments]);
                } else {
                    // Trả về thông báo lỗi cho client
                    http_response_code(400);
                    echo json_encode(['message' => 'Có lỗi xảy ra khi gửi đánh giá.']);
                }
            } else {
                // Trả về thông báo lỗi cho client nếu action không hợp lệ
                http_response_code(400);
                echo json_encode(['message' => 'Hành động không hợp lệ.']);
            }
        } else {
            // Trả về thông báo lỗi cho client nếu action trống
            http_response_code(400);
            echo json_encode(['message' => 'Yêu cầu không hợp lệ.']);
        }
    }
}