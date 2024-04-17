<link rel="stylesheet" href="../css/app.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="tab_member">
    <div class="member_wrap">
        <ul class="member_ul">
            <li class="member_li">
                <a href="#" id="cctv" class="on" onclick="showVip('tab1','cctv')">
                    Cấp độ thành viên
                </a>
            </li>
            <li class="member_li">
                <a href="#" id="skrt" onclick="showVip('tab2','skrt')">
                    Sự kiện riêng tư
                </a>
            </li>
        </ul>

        <div class="show_vip" id="tab1">
            <div class="vip_grade">
                <div id="show_member_login" style="display: block;">
                    <div class="gradeinfo">
                        Xếp hạng của
                        <?php 
                        use \Illuminate\Support\Facades\Cookie;
                            $cookie = Cookie::get('jwt_role');
                            $cookie_data = json_decode($cookie, true);
                            $username = isset($cookie_data['username']) ? $cookie_data['username'] : 'Unknown';
                            $coin = isset($cookie_data['coin']) ? $cookie_data['coin'] : '0';
                            $rank = "Normal";
                            if ($coin >= 2000000 && $coin < 5000000){
                                $rank = "VIP";
                            }
                            else if ($coin >= 5000000){
                                $rank = "Bạch Kim";
                            }
                        ?>
                        <strong class="name_members" id="member_name"> <?php echo $username?> </strong>
                        là
                        <strong class="grade_members" id="member_grades"><?php echo $rank?></strong>
                    </div>

                    <div class="wrap_gradegraph">
                        <dl class="gradegraph_txt">
                            <dt>Số tiền chi tiêu nâng cấp lên VIP</dt>
                            <dd class="money_grade">
                            
                                <span class="num" id="vip_points"><?php echo $coin?></span>
                                <span class="txt_menhgia">VNĐ</span>
                            </dd>
                        </dl>

                        <div class="grade_bar">
                            <div class="grade_progress">
                                <span class="bar arrow" id="spanArrow" style="width: 0px;"></span>
                            </div>

                            <div class="scale_num">
                                <ul class="point_line">
                                    <li class="point_l1">0</li>
                                    <li class="point_l2" id="vip_point">
                                        <span>VIP</span>
                                        "2.000.000"
                                    </li>
                                    <li class="point_l3" id="plantinum_point">
                                        <span>Bạch kim</span>
                                        "5.000.000"
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info_member_box">
                <ul>
                    <li>
                        <b>Chương trình Khách hàng Thường xuyên của LOTTE Cinema 2023</b>
                        là chương trình ưu đãi dựa trên điểm tích lũy của các thành viên, với những quyền lợi và mức ưu đãi khác nhau tương ứng với các cấp độ thành viên khác nhau.
                    </li>
                </ul>

                <div style="display:table; width:100%; ">
                    <table class="boardRead">
                        <colgroup>
                            <col style="width:26%">
                            <col style="width:26%">
                            <col style="width:16%">
                            <col style="width:16%">
                            <col style="width:16%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th colspan="2">Cấp độ thành viên</th>
                                <th scope="row">Normal</th>
                                <th scope="row">VIP</th>
                                <th scope="row">Platinum</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight: bold;">Điều kiện nâng hạng: Tổng chi tiêu năm 2022</td>
                                <td></td>
                                <td>Từ 2,000,000 VND</td>
                                <td>Từ 5,000,000 VND</td>
                            </tr>
                            <tr>
                                <td rowspan="2" style="vertical-align : middle; font-weight:bold">Tỉ lệ tích điểm</td>
                                <td>Vé</td>
                                <td>5%</td>
                                <td>7%</td>
                                <td>7%</td>
                            </tr>
                            <tr>
                                <td>Canteen</td>
                                <td>3%</td>
                                <td>5%</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td rowspan="3" style="vertical-align : middle; font-weight:bold">Voucher</td>
                                <td>Vé xem phim 2D</td>
                                <td></td>
                                <td>4 vé</td>
                                <td>10 vé</td>
                            </tr>
                            <tr>
                                <td>Harmony Solo CB<br> (01 bắp + 01 nước ngọt)</td>
                                <td></td>
                                <td>1 combo</td>
                                <td>2 combo</td>
                            </tr>
                            <tr>
                                <td>Harmony Couple CB<br> (01 bắp + 02 nước ngọt)</td>
                                <td></td>
                                <td>1 combo</td>
                                <td>2 combo</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight: bold;">Quà tặng đặc biệt</td>
                                <td></td>
                                <td></td>
                                <td>✔</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>

                <ul>
                    <li class="title_membership" style="float: left;">1. ĐIỂM TÍCH LUỸ CINEMA COIN</li>
                    <br>
                    <li style="float: left;">Thành viên có thể sử dụng điểm tích lũy Cinema Coin để thanh toán các giao dịch tại quầy vé hoặc quầy bắp nước như tiền mặt. Số điểm tối thiểu cho mỗi giao dịch thanh toán là
                        <b>1,000 điểm</b>
                    </li>
                    <br>

                    <li style="text-align: center;">
                        <br>
                        <span style="color:red; ">
                            <b>1,000 Cinema Coin = 1,000 VND</b>
                        </span>
                    </li>
                    <li>Ví dụ: Thành viên Nguyễn Văn A đã tích lũy được 200,000 LOTTE Cinema Point. Với giao dịch mua 2 vé xem phim tổng cộng 200,000 VND:</li>
                    <li>&nbsp;&nbsp;&nbsp;- Thành viên có thể thanh toán 100,000 VND và 100,000 Cinema Coin</li>
                    <li>&nbsp;&nbsp;&nbsp;- Hoặc thanh toán hoàn toàn với 200,000 Cinema Coin</li>
                    <br>

                    <li class="title_membership">2. VÉ XEM PHIM 2D, COMBO BẮP NƯỚC VÀ QUÀ TẶNG</li>

                    <li>- Thành viên VIP 2024 (Khách hàng có chi tiêu từ 2,000,000 VND đến 4,999,999 VND trong năm 2022):</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 04 Vé xem phim 2D</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 01 Harmony Single Combo (01 bắp rang + 01 nước ngọt)</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 01 Harmony Couple Combo (01 bắp rang + 02 nước ngọt)</li>
                    <li>- Thành viên Platinum 2024 (Khách hàng có chi tiêu từ 5,000,000 VND trở lên trong năm 2022):</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 10 Vé xem phim 2D</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 02 Harmony Single Combo (01 bắp rang + 01 nước ngọt)</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 02 Harmony Couple Combo (01 bắp rang + 02 nước ngọt)</li>
                    <li>&nbsp;&nbsp;&nbsp;+ 01 Quà tặng đxặc biệt</li>
                    <br>
                    <li>Lưu ý:</li>
                    <li>&nbsp;&nbsp;&nbsp;- Điểm tích lũy Cinema Coin có thời hạn sử dụng tới 31/12 của năm kế tiếp (Điểm tích lũy của năm 2022 sẽ hết hạn vào 31/12/2023; điểm tích lũy của năm 2023 sẽ hết hạn vào 31/12/2024);</li>
                    <li>&nbsp;&nbsp;&nbsp;- Sau 01 (một) năm, nếu không duy trì sẽ tính lại cấp độ thành viên.</li>
                    <br>
                    <li class="title_membership" style="text-align:center;"><span style="background-color:red; color:white;  padding:5px">HẠN MỨC NÂNG HẠNG THÀNH VIÊN 2024</span></li>
                    <li style="text-align:center" class="member_rank_content">&nbsp;&nbsp;&nbsp;Tiêu chí xét hạng thành viên VIP/ Platinum 2024, cũng như tỉ lệ tích điểm<br>
                        và các quyền lợi khác của Thành viên 2024 sẽ được cập nhật sau.</li>

                </ul>
            </div>
        </div>

        <div class="show_vip" id="tab2" style="display:none">
            <table class="tbl_thongTinVip">
                <tr>
                    <th>Họ và tên: <strong style="color:red">*</strong></th>
                    <td> <input type="text" id="fullname" name="fullname" maxlength="50" placeholder="Vui lòng nhập họ và tên" required oninvalid="this.setCustomValidity('Vui lòng nhập Họ và tên.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Số điện thoại <strong style="color:red">*</strong></th>
                    <td> <input type="tel" id="phone" name="phone" maxlength="10" placeholder="Vui lòng nhập số điện thoại" pattern="[0-9]{10}" required oninvalid="this.setCustomValidity('Vui lòng nhập Số điện thoại 10 chữ số.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Email <strong style="color:red">*</strong></th>
                    <td> <input type="email" id="email" name="email" maxlength="50" placeholder="Vui lòng nhập email" required oninvalid="this.setCustomValidity('Vui lòng nhập đúng định dạng Email.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <th>Chọn phim muốn đặt<strong style="color:red">*</strong></th>
                    <td>
                        <select name="ChonPhim_skrt" id="SKRT_ChonPhim">
                            <option value="">Chọn phim</option>
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Ngày diễn ra sự kiện:<strong style="color:red">*</strong></th>
                    <td> <input type="date" id="dob" name="dob" required oninvalid="this.setCustomValidity('Vui lòng chọn Ngày sinh.')" oninput="this.setCustomValidity('')">
                    </td>
                </tr>
            </table>

            <div class="cancel_send_skrt">
                <a href="" class="cancel_skrt">Hủy bỏ</a>
                <a href="" class="send_skrt">Gửi</a>
            </div>

        </div>
    </div>
</div>
<script src="../js/app.js"></script>