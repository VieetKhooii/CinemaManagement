<link rel="stylesheet" href="../css/bookingCombo.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="bookingCombo">
    <div class="bookingCombo_wrap">
        <h3>Đặt Combo</h3>
        <div id="hiddenCombo_list">
            <ul id="combo_list">
                <?php 
                $urlEncodedData = urlencode(serialize($necessaryData));
                    foreach($combos as $row){
                           echo '
                           <li class="combo" onclick="showCombo(this, `'.$row['description'].'`)">
                                <span class="img_combo">
                                    <img src="'.$row['image'].'" alt="">
                                </span>
                                <a href="#" class="combo_txt">'.$row['name'].'</a>
                                <p class="combo_price">
                                    <span class="dash_price">Giá bán online</span>
                                    <span class="price"><em>'.$row['price'].'</em><span>₫</span></span>
                                </p>
                            </li>
                           ';
                    }
                ?>
            </ul>
            <div class="combo_info">
                
            </div>
        </div>
    </div>
</div>
<div class="bookingFinal">
    <div class="bookingFinal_wrap">
        <div class="btn_back_next">
            <a href="#"><i class="fa-solid fa-left-long"></i>Trở lại</a>
            <a href="/payment?data=<?php echo $urlEncodedData ?>">Tiếp tục<i class="fa-solid fa-right-long"></i></a>
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
                            <img src="<?php echo $necessaryData['image'] ?>" alt="">
                        </div>
                        <div class="title_right">
                            <?php echo $necessaryData['movie_name'] ?>
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
                            <div><?php echo $necessaryData['date'] ?></div>
                            <div><?php echo $necessaryData['start_time'] ?></div>
                            <div><?php echo $necessaryData['room_id'] ?></div>
                            <div class="seat_chosen">

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
                            <span class="price"><em><?php echo $necessaryData['bonus_price'] ?></em><span>₫</span></span>
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