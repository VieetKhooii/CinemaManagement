<link rel="stylesheet" href="../css/bookingCombo.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<?php
include("bookingCombo.php");
?>
<div class="bookingFinal">
    <div class="bookingFinal_wrap">
        <div class="btn_back_next">
            <a href="#"><i class="fa-solid fa-left-long"></i>Trở lại</a>
            <a href="#">Tiếp tục<i class="fa-solid fa-right-long"></i></a>
        </div>
        <table class="final">
            <colgroup>
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:25%">
            </colgroup>
            <tbody>
                <tr class="header">
                    <td class="title_final">Phim đã đặt</td>
                    <td class="title_final">Thông tin vé đã đặt</td>
                    <td class="title_final">Thông tin combo đã đặt</td>
                    <td class="title_final">Tổng hóa đơn</td>
                </tr>
                <tr class="info_table">
                    <td class="film_booking">
                        <div class="title_left">
                            <img src="../img/thanhxuan18x2_final.jpg" alt="">
                        </div>
                        <div class="title_right">
                            THANH XUÂN 18x2: LỮ TRÌNH HƯỚNG VỀ EM 2D
                        </div>
                    </td>
                    <td class="info_ticket">
                        <div class="title_left">
                            <div>Ngày:</div>
                            <div>Giờ:</div>
                            <div>Rạp chiếu:</div>
                            <div>Ghế:</div>
                        </div>
                        <div class="title_right">
                            <div>2024-04-16</div>
                            <div>18:00</div>
                            <div>Rạp A</div>
                            <div class="seat_chosen">
                                <!-- <div class="seat">A01</div>
                                <div class="seat">A02</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A02</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div>
                                <div class="seat">A01</div> -->
                            </div>
                        </div>

                    </td>
                    <td id="combo_info_td">
                        <div class="header_combo_info">Danh sách combo Đã Chọn:</div>
                        <div class="combo_info_chosen" id="combo_info_chosen">
                            <!-- <div class="combo_chosen">
                                <div class="title_left">
                                    <div id="selected_combo_name">com1</div>
                                </div>
                                <div class="title_right" style="text-align:right">
                                    <span class="price" id="selected_combo_price">ádasd</span>
                                </div>
                                <div class="exit_combo"><a href="#" onclick="hidden_combo(event,this)"><i class="fa-solid fa-square-xmark"></i></a></div>
                            </div> -->
                        </div>
                    </td>
                    <td class="bill_total">
                        <div class="title_left">
                            <div class="ticket_header">Đặt trước vé</div>
                            <div class="combo_header">Đặt trước combo</div>
                        </div>
                        <div class="title_right" style="text-align: right;">
                            <div class="ticket_info_price">
                                <span class="price price_ticket"><em>0</em><span>₫</span></span>
                            </div>
                            <div class="combo_info_price">
                                <span class="price price_combo_info"><em>0</em><span>₫</span></span>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="footer">
                    <td></td>
                    <td>
                        <div class="total_price_ticket">
                            Giá vé:
                            <span class="price"><em>0</em><span>₫</span></span>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div>
                            Tổng Cộng:
                            <span class="price price_total_combo"><em>0</em><span>₫</span></span>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
<script src="/js/bookingCombo.js"></script>
<!-- <script src="/js/seatwrap.js"></script> -->