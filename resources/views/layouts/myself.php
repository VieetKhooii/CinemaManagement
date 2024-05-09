<link rel="stylesheet" href="../css/myself.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div id="myself">
    <div class="my_info">
        <h2>Rạp chiếu phim của tôi</h2>
        <div class="my_info_tit">
            <em>Xin chào <span>VÕ LÊ KIM TIỄN</span></em>
            <dl>
                <dt>Cấp độ thành viên</dt>
                <dd>Normal</dd>
            </dl>
        </div>
    </div>
    <div class="my_info_choose">
        <ul class="member_ul">
            <li class="member_li">
                <a href="#" id="ls" onclick="showMe('tab1','ls')">
                    Lịch sử mua vé / combo
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="blct" onclick="showMe('tab2','blct')">
                    Bình luận của tôi
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="tdtt" onclick="showMe('tab3','tdtt')">
                    Thay đổi thông tin
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="tdmk" onclick="showMe('tab4','tdmk')">
                    Thay đổi mật khẩu
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="xtk" onclick="showMe('tab5','xtk')">
                    Xóa tài khoản
                </a>
            </li>
        </ul>

        <div class="show_me" id="tab1" style="display:none">
            <div class="item_history">
                <div class="ticket">
                    <p>Phim: <span class="phim_display"></span></p>
                    <p>Ngày: <span class="ngay_display"></span></p>
                    <p>Suất: <span class="suat_display"></span></p>
                    <p>Phòng <span class="phong_display"></span></p>
                    <p>Ghế: <span class="ghe_display"></span></p>
                </div>
                <div class="combo">
                    <p>Combo: <span class="combo_display"></span></p>
                </div>
            </div>
        </div>
        <div class="show_me" id="tab2" style="display:none">
            <div class="list_comment">
                <p>Ngày: <span class="ngay_display"></span></p>
                <p>Đánh giá: <span class="danhGia_display"></span></p>
                <p>Bình luận của tôi: <span class="binhLuan_display"></span></p>
                <p>Phim: <span class="phim_display"></span></p>
            </div>
        </div>
        <div class="show_me" id="tab3" style="display:none">
            <table class="tbl_thongTinVip">
                <tr>
                    <th>Họ và tên: <strong style="color:red">*</strong></th>
                    <td> <input type="text" id="fullname" name="fullname" maxlength="50" placeholder="Vui lòng nhập họ và tên" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Số điện thoại <strong style="color:red">*</strong></th>
                    <td> <input type="tel" id="phone" name="phone" maxlength="10" placeholder="Vui lòng nhập số điện thoại" pattern="[0-9]{10}" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Email <strong style="color:red">*</strong></th>
                    <td> <input type="email" id="email" name="email" maxlength="50" placeholder="Vui lòng nhập email" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Giới tính<strong style="color:red">*</strong></th>
                    <td>
                        <select name="gender_choose" id="gender">
                            <option value="">Nam</option>
                            <option value="">Nữ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Ngày sinh:<strong style="color:red">*</strong></th>
                    <td> <input type="date" id="birth" name="birth" required oninvalid="this.setCustomValidity('Vui lòng chọn Ngày sinh.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Địa chỉ <strong style="color:red">*</strong></th>
                    <td> <input type="text" id="diachi" name="diachi" maxlength="50" placeholder="Vui lòng nhập địa chỉ" required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ.')" oninput="this.setCustomValidity('')">
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
<script src="../js/myself.js"></script>