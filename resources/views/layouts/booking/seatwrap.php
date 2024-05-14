<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="/css/seatwrap.css">
<link rel="stylesheet" href="/css/message.css">
<div class="container_message" style="display: none;">
    <div class="message">
        <div class="text">
            Không được vượt quá 8 người!
        </div>
        <button type="button" onclick="hidden_message()">Đã hiểu</button>
    </div>
</div>
<div class="container_seat">
    <div class="show_detail_ticket"></div>
    <div class="seatwrap">
        <div class="seatarea">
            <div class="seatheader">
                <h2>Chọn Ghế</h2>
                <div class="seat_right">
                    <div class="price"><a href="#" onclick="show_detail_ticket()"><i class="fa-solid fa-ticket"></i>Chọn Loại Vé</a></div>
                    <div class="reset"><a href="#" onclick="reset_seatwrap()"><i class="fa-solid fa-rotate"></i>Đặt lại</a></div>
                </div>
            </div>
            <div class="seatbox">
                <ul class="personselect">
                    <li>
                        <label for="person0">Người lớn</label>
                        <div class="select_box">
                            <a href="#" onclick="loadPerson(event, this)">0<i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="personList" style="display: none;">
                                <li><a href="#" onclick="addnum(event,this)">0</a></li>
                                <li><a href="#" onclick="addnum(event,this)">1</a></li>
                                <li><a href="#" onclick="addnum(event,this)">2</a></li>
                                <li><a href="#" onclick="addnum(event,this)">3</a></li>
                                <li><a href="#" onclick="addnum(event,this)">4</a></li>
                                <li><a href="#" onclick="addnum(event,this)">5</a></li>
                                <li><a href="#" onclick="addnum(event,this)">6</a></li>
                                <li><a href="#" onclick="addnum(event,this)">7</a></li>
                                <li><a href="#" onclick="addnum(event,this)">8</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <label for="person0">Trẻ em, u22</label>
                        <div class="select_box" id="text">
                            <a href="#" onclick="loadPerson(event, this)">0<i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="personList" style="display: none;">
                                <li><a href="#" onclick="addnum(event,this)">0</a></li>
                                <li><a href="#" onclick="addnum(event,this)">1</a></li>
                                <li><a href="#" onclick="addnum(event,this)">2</a></li>
                                <li><a href="#" onclick="addnum(event,this)">3</a></li>
                                <li><a href="#" onclick="addnum(event,this)">4</a></li>
                                <li><a href="#" onclick="addnum(event,this)">5</a></li>
                                <li><a href="#" onclick="addnum(event,this)">6</a></li>
                                <li><a href="#" onclick="addnum(event,this)">7</a></li>
                                <li><a href="#" onclick="addnum(event,this)">8</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <label for="person0">Học Sinh, Sinh Viên</label>
                        <div class="select_box">
                            <a href="#" onclick="loadPerson(event, this)">0<i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="personList" style="display: none;">
                                <li><a href="#" onclick="addnum(event,this)">0</a></li>
                                <li><a href="#" onclick="addnum(event,this)">1</a></li>
                                <li><a href="#" onclick="addnum(event,this)">2</a></li>
                                <li><a href="#" onclick="addnum(event,this)">3</a></li>
                                <li><a href="#" onclick="addnum(event,this)">4</a></li>
                                <li><a href="#" onclick="addnum(event,this)">5</a></li>
                                <li><a href="#" onclick="addnum(event,this)">6</a></li>
                                <li><a href="#" onclick="addnum(event,this)">7</a></li>
                                <li><a href="#" onclick="addnum(event,this)">8</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="seat_bottom">
                    <div class="seatset">
                        <dt class="seat_setup">
                            <em>Chọn ghế liền nhau</em>
                            <a href="#" title="Xem thông tin chi tiết"><i class="fa-solid fa-exclamation"></i></a>
                            <div class="layer_seat">
                                <div class="seat_in">
                                    <p>Bạn có thể chọn ghế liền nhau bằng cách click chọn vào từng mục bên cạnh.</p>
                                </div>
                            </div>
                        </dt>
                        <dd>
                            <ul class="seat_setting">
                                <li class="per1">
                                    <input type="radio" name="radioSelect" id="per1" value="1" disabled="disabled">
                                    <label for="per1">
                                        <em>
                                            Một chổ ngồi
                                        </em>
                                    </label>
                                </li>
                                <li class="per2">
                                    <input type="radio" name="radioSelect" id="per2" value="2" disabled="disabled">
                                    <label for="per2">
                                        <em>
                                            Hai chổ ngồi
                                        </em>
                                    </label>
                                </li>
                                <li class="per3">
                                    <input type="radio" name="radioSelect" id="per3" value="3" disabled="disabled">
                                    <label for="per3">
                                        <em>
                                            Ba chổ ngồi
                                        </em>
                                    </label>
                                </li>
                                <li class="per4">
                                    <input type="radio" name="radioSelect" id="per4" value="4" disabled="disabled">
                                    <label for="per4">
                                        <em>
                                            Bốn chổ ngồi
                                        </em>
                                    </label>
                                </li>
                            </ul>
                        </dd>
                        <dd>
                        </dd>

                    </div>
                    <div class="advice">
                        <span>Có thể chọn tối đa 8 người(Max 8).</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="seat_screenbox">
        <div class="seat_screenbox_header">
            <span>Screen</span>
        </div>
        <div class="screenbox_scroll">
            <div id="refreshButton"><a href="#" onclick="reset_chossen()"><i class="fa-solid fa-rotate"></a></i></div>
            <div class="seat_Barea">
                <div class="seat">
                    <?php 
                        $seatPrice = 0;
                        if ($_POST['seatArray']){
                            $seatArray = $_POST['seatArray'];
                        }
                        else {
                            echo "no seat data ";
                        }
                        
                        if ($_POST['necessaryData']){
                            $necessaryData = $_POST['necessaryData'];
                        }
                        else {
                            echo "no necessary data ";
                        }
                        if ($_POST['combos']){
                            $combos = $_POST['combos'];
                        }
                        else {
                            echo "no combo data ";
                        }
                    ?>
                    <?php 
                        $position = "A";
                        $i = 0;
                        foreach ($seatArray as $row){
                            if ($row['seat_number'] == "1" && $row['seat_row'] === "A") {
                                echo '<ul id="R'.$row['seat_row'].'">'.
                                '<li class="header_row">'.
                                   '<a href="#">'.$row['seat_row'].'</a>'.
                                '</li>';
                            }
                            if ($row['seat_row'] != $position && $row['display'] === "true"){
                                echo '</ul><ul id="R'.$row['seat_row'].'">'.
                                     '<li class="header_row">'.
                                        '<a href="#">'.$row['seat_row'].'</a>'.
                                     '</li>';
                                $position = $row['seat_row'];
                            }
                            $seatType = '';
                            if ($row['display'] == "true"){
                                if ($row['final_is_reserved'] == "0"){
                                    if ($row['seat_type_id'] == 1){
                                        $seatType = '<li class="normal_seat" data-bonus-price="' . $row['bonus_price'] . '"';
                                    }
                                    else if ($row['seat_type_id'] == 2){
                                        $seatType = '<li class="vip_seat" data-bonus-price="' . $row['bonus_price'] . '"';
                                    }

                                    // ghế couple: Mỗi 2 ghế có 1 khoảng cách 
                                    if ($row['seat_type_id'] == 3) {
                                        // ghế couple số chẵn sẽ cách khoảng trắng
                                        if ($row['seat_number'] % 2 == 0){
                                            $seatType = '<li class="couple_seat" data-bonus-price="' . $row['bonus_price'] . '" id="column_seat_left"';
                                        }
                                        else {
                                            $seatType = '<li class="couple_seat" data-bonus-price="' . $row['bonus_price'] . '"';
                                        }
                                    }

                                    // nếu không phải ghế couple
                                    else {
                                            // sắp xếp ghế, 2 ghế đầu và 2 ghế cuối có khoảng cách với dãy giữa 
                                        if ($row['seat_number'] == 2){
                                            $seatType = $seatType . 'id="column_seat_left"';
                                        }
                                        else if (isset($seatArray[$i+2])){
                                            // kiểm nếu 2 ghế tiếp là ghế khác hàng và ghế kế tiếp vẫn còn là cùng hàng
                                            if ($seatArray[$i+2]['seat_row'] != $position && $seatArray[$i+1]['seat_row'] == $position)
                                            $seatType = $seatType . 'id="column_seat_right"';
                                        }
                                    }
                                    $seatType = $seatType . '><a href="#">'.$row['seat_number'].'</a></li>';
                                }
                                else {
                                    // $seatType = '<li class="bought_seats"></li>';
                                    if ($row['seat_type_id'] == 1){
                                        $seatType = '<li class="bought_seats" data-bonus-price="' . $row['bonus_price'] . '"';
                                    }
                                    else if ($row['seat_type_id'] == 2){
                                        $seatType = '<li class="bought_seats" data-bonus-price="' . $row['bonus_price'] . '"';
                                    }

                                    // ghế couple: Mỗi 2 ghế có 1 khoảng cách 
                                    if ($row['seat_type_id'] == 3) {
                                        // ghế couple số chẵn sẽ cách khoảng trắng
                                        if ($row['seat_number'] % 2 == 0){
                                            $seatType = '<li class="bought_seats" data-bonus-price="' . $row['bonus_price'] . '" id="column_seat_left"';
                                        }
                                        else {
                                            $seatType = '<li class="bought_seats" data-bonus-price="' . $row['bonus_price'] . '"';
                                        }
                                    }

                                    // nếu không phải ghế couple
                                    else {
                                            // sắp xếp ghế, 2 ghế đầu và 2 ghế cuối có khoảng cách với dãy giữa 
                                        if ($row['seat_number'] == 2){
                                            $seatType = $seatType . 'id="column_seat_left"';
                                        }
                                        else if (isset($seatArray[$i+2])){
                                            // kiểm nếu 2 ghế tiếp là ghế khác hàng và ghế kế tiếp vẫn còn là cùng hàng
                                            if ($seatArray[$i+2]['seat_row'] != $position && $seatArray[$i+1]['seat_row'] == $position)
                                            $seatType = $seatType . 'id="column_seat_right"';
                                        }
                                    }
                                    $seatType = $seatType . '><a href="#">'.$row['seat_number'].'</a></li>';
                                }
                            }
                            echo $seatType;
                            $i = $i + 1;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="footer_screenbox">
            <div class="type_seat_info">
                <p>Thông Tin Loại Ghế:</p>
                <ul class="type_seat">
                    <li class="nor_seat_type"><span></span>Ghế thường</li>
                    <li class="vip_seat_type"><span></span>Ghế vip</li>
                    <li class="coup_seat_type"><span></span>Ghế cặp đôi</li>
                    <li class="chose_seat_type"><span></span>Ghế đã chọn</li>
                    <li class="dis_seat_type"><span></span>Ghế không thể chọn</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content_combo_info">
        <?php
            include('bookingFinal.php')
        ?>
    </div>
</div>
<script src="/js/seatwrap.js"></script>
<script src="/js/bookingCombo.js"></script>
<script src="/js/app.js"></script>