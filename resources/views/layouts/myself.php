<link rel="stylesheet" href="../css/myself.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<?php 
use \Illuminate\Support\Facades\Cookie;
    $cookie = Cookie::get('jwt_role');
    $cookie_data = json_decode($cookie, true);
    $username = isset($cookie_data['username']) ? $cookie_data['username'] : 'Unknown';
    $email = isset($cookie_data['email']) ? $cookie_data['email'] : 'Unknown';
    $phone = isset($cookie_data['phone']) ? $cookie_data['phone'] : 'Unknown';
    $date_of_birth = isset($cookie_data['date_of_birth']) ? $cookie_data['date_of_birth'] : 'Unknown';
    $date_of_birth = date("Y-m-d", strtotime($date_of_birth));
    $gender = isset($cookie_data['gender']) ? $cookie_data['gender'] : 'Unknown';
    $address = isset($cookie_data['address']) ? $cookie_data['address'] : 'Unknown';
    $user_id = isset($cookie_data['user_id']) ? $cookie_data['user_id'] : 'Unknown';
    $coin = isset($cookie_data['coin']) ? $cookie_data['coin'] : '0';
    $rank = "Normal";
    if ($coin >= 2000000 && $coin < 5000000){
        $rank = "VIP";
    }
    else if ($coin >= 5000000){
        $rank = "Bạch Kim";
    }

    $personalInfo = array(
        "user_id"=> "",
        "full_name"=> "",
        "email"=> "",
        "phone"=> "",
        "date_of_birth"=> "",
        "gender"=> "",
        "address"=> "",
        "score"=> 0,
        "coin"=> null,
        "status"=> true,
        "role_id"=> null
    );

    $commentsOfUser = array(
        "comment_id" => 0,        
        "user_id" => "",
        "movie_id" => "",
        "content" => "",
        "post_time" => "",
        "like" => 0,
        "movie_name" => ""  
    );

    if (isset($_GET['personalInfo'])){
        $personalInfo = $_GET['personalInfo'];
    }
    if (isset($_GET['commentsOfUser'])){
        $commentsOfUser = $_GET['commentsOfUser'];
    }
    if (isset($_GET['payment'])){
        $payment = $_GET['payment'];
    }
?>
<div id="myself">
    <div class="my_info">
        <h2>Rạp chiếu phim của tôi</h2>
        <div class="my_info_tit">
            <em>Xin chào <span><?php echo $username ?></span></em>
            <dl>
                <dt>Cấp độ thành viên</dt>
                <dd><?php echo $rank ?></dd>
            </dl>
        </div>
    </div>
    <div class="my_info_choose">
        <ul class="member_ul">
            <li class="member_li">
                <a href="#" id="ls" onclick="showMe('tab1','ls', event)">
                    Lịch sử mua vé / combo
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="blct" onclick="showMe('tab2','blct', event)">
                    Bình luận của tôi
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="tdtt" onclick="showMe('tab3','tdtt', event)">
                    Thay đổi thông tin
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="tdmk" onclick="showMe('tab4','tdmk', event)">
                    Thay đổi mật khẩu
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="xtk" onclick="showMe('tab5','xtk', event)">
                    Xóa tài khoản
                </a>
            </li>
        </ul>

        <div class="show_me" id="tab1" style="display:none">
            <div class="item_history">
                <?php 
                    foreach($payment as $row){
                        echo '
                        <div class="ticket">
                            <p>Phim: <span class="phim_display">'.$row['movie_name'].'</span></p>
                            <p>Ngày: <span class="ngay_display">'.date("Y-m-d", strtotime($row['purchase_date'])).'</span></p>
                            <p>Suất: <span class="suat_display">'.$row['seat_id'].'</span></p>
                            <p>Phòng <span class="phong_display">'.$row['room_id'].'</span></p>
                            <p>Ghế: <span class="ghe_display">'.$row['movie_name'].'</span></p>
                        </div>
                        <div class="combo">
                            <p>Combo: <span class="combo_display"></span></p>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>
        <div class="show_me" id="tab2" style="display:none">
        <?php 
            foreach ($commentsOfUser as $row){
                echo '<div class="list_comment">' . 
                        '<p>Ngày: <span class="ngay_display">'.date("d-m-Y", strtotime($row['post_time'])).'</span></p>' .
                        '<p>Đánh giá: <span class="danhGia_display">'.$row['like'].' sao</span></p>'.
                        '<p>Bình luận của tôi: <span class="binhLuan_display">'.$row['content'].'</span></p>'.
                        '<p>Phim: <span class="phim_display">'.$row['movie_name'].'</span></p>'.
                     '</div>';
            }
        ?>
        </div>
        <div class="show_me" id="tab3" style="display:none">
            <table class="tbl_thongTinVip">
                <tr>
                    <th>Họ và tên: <strong style="color:red">*</strong></th>
                    <td> <input value="<?php echo $personalInfo['full_name'] ?>" type="text" id="fullname" name="fullname" maxlength="50" placeholder="Vui lòng nhập họ và tên" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Số điện thoại <strong style="color:red">*</strong></th>
                    <td> <input value="<?php echo $personalInfo['phone'] ?>" type="tel" id="phone" name="phone" maxlength="10" placeholder="Vui lòng nhập số điện thoại" pattern="[0-9]{10}" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Email <strong style="color:red">*</strong></th>
                    <td> <input value="<?php echo $personalInfo['email'] ?>" type="email" id="email" name="email" maxlength="50" placeholder="Vui lòng nhập email" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Giới tính<strong style="color:red">*</strong></th>
                    <td>
                        <select name="gender_choose" id="gender">
                            <option value="Nam" <?php echo ($personalInfo['gender'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                            <option value="Nữ" <?php echo ($personalInfo['gender'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                            <!-- Add more options if needed -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Ngày sinh:<strong style="color:red">*</strong></th>
                    <td> 
                        <input value="<?php echo date("Y-m-d", strtotime($personalInfo['date_of_birth'])); ?>" type="date" id="birth" name="birth" required oninvalid="this.setCustomValidity('Vui lòng chọn Ngày sinh.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>

                <tr>
                    <th>Địa chỉ <strong style="color:red">*</strong></th>
                    <td> <input value="<?php echo $personalInfo['address'] ?>" type="text" id="diachi" name="diachi" maxlength="50" placeholder="Vui lòng nhập địa chỉ" required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
            </table>

            <div class="cancel_send_tdtt">
                <a href="" class="cancel_tdtt">Hủy bỏ</a>
                <a href="" class="send_tdtt">Thay đổi</a>
            </div>
        </div>
        <div class="show_me" id="tab4" style="display:none">
            <table class="tbl_thongTinVip">
                <input type="hidden" id="EmailForChangingPassword" name="EmailForChangingPassword" value="<?php echo $email ?>">
                <tr>
                    <th>Mật khẩu hiện tại: <strong style="color:red">*</strong></th>
                    <td>
                        <input type="password" id="password_now" name="password_now" placeholder="Vui lòng nhập mật khẩu hiện tại" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Mật khẩu mới <strong style="color:red">*</strong></th>
                    <td>
                        <input type="password" id="password_new" name="password_new" placeholder="Vui lòng nhập mật khẩu mới" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Nhập lại mật khẩu <strong style="color:red">*</strong></th>
                    <td>
                        <input type="password" id="password_check" name="password_check" placeholder="Vui lòng nhập lại mật khẩu mới" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
            </table>

            <div class="cancel_send_tdmk">
                <a href="" class="cancel_tdmk">Hủy bỏ</a>
                <a href="" class="send_tdmk">Thay đổi</a>
            </div>
        </div>
        <div class="show_me" id="tab5" style="display:none">
            <table class="tbl_thongTinVip">
                <div class="dotted">
                    <li> Bằng việc bấm nút xác nhận hủy đăng ký hội viên, quý khách đồng ý và hiểu rõ rằng toàn bộ thông tin thành viên, lịch sử giao dịch, điểm thưởng tích lũy, voucher quà tặng, cấp độ thành viên của quý khách sẽ bị xóa vĩnh viễn và không thể khôi phục lại.</li>
                    <li>Quý khách vui lòng kiểm tra lại điểm tích lũy và voucher quà tặng còn hạn sử dụng, Cinema mong rằng quý khách sử dụng hết trước khi hủy bỏ tài khoản hội viên này để đảm bảo quyền lợi tốt nhất cho quý khách</li>
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id ?>">
                <tr>
                    <th>Mật khẩu của bạn <strong style="color:red">*</strong></th>
                    <td>
                        <input type="password" id="password_now_del" name="password_new" placeholder="Vui lòng nhập mật khẩu" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Nhập lại mật khẩu <strong style="color:red">*</strong></th>
                    <td>
                        <input type="password" id="password_check_del" name="password_check" placeholder="Vui lòng nhập lại mật khẩu" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
            </table>

            <div class="cancel_send_xtk">
                <a href="" class="send_xtk">Hủy bỏ</a>
                <a href="" class="cancel_xtk">Xóa tài khoản</a>
            </div>
        </div>
    </div>
</div>
<script src="/js/myself.js"></script>