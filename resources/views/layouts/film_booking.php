<style>
    *{
        font-family: 'Times New Roman', Times, serif;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="header">
    <?php
    if(isset($_COOKIE['jwt'])) {
        include("header1.php");
    }
    ?>
</div>
<div class="content_main" id="content_main">
    <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');

function getDayOfWeek($dayNumber)
{
    switch ($dayNumber) {
        case 1:
            return "Hai";
        case 2:
            return "Ba";
        case 3:
            return "Tư";
        case 4:
            return "Năm";
        case 5:
            return "Sáu";
        case 6:
            return "Bảy";
        case 7:
            return "CN";
        default:
            return "Không hợp lệ";
    }
}
?>

<div class="container_booking" id="container_booking">
    <div id="content_booking" class="ticket_booking">
        <div class="cont_ticket">
            <div class="calendar">
                <a href="#" class="week_pick_nav fas fa-chevron-left left" style="display: none;"></a>
                <fieldset class="week_picker_field">
                    <div class="calender_area">
                        <?php $currentDayNumber = date('N');
                        $offset = 0;
                        $currentWeek = array();
                        $currentDate = date('Y-m-d'); // Ngày hiện tại
                        for ($i = $currentDayNumber; $i <= 7; $i++) {
                            // Tăng số ngày cho ngày hiện tại
                            $newDate = date('Y-m-d', strtotime("+$offset days", strtotime($currentDate)));
                            list($year, $month, $day) = explode('-', $newDate);
                            if (checkdate($month, $day, $year)) {
                                $newDay = date('d', strtotime($newDate));
                                $newMonth = date('m', strtotime($newDate));
                                $newYear = date('Y', strtotime($newDate));
                                $id = $newYear . $newMonth . $newDay;
                                $dayofweek = getDayOfWeek($i);
                                $currentWeek[] = array(
                                    'dayofweek' => $dayofweek,
                                    'newDay' => $newDay,
                                    'id' => $id
                                );
                        ?>
                                <input type="radio" id="check_<?php echo $id; ?>">
                                <label for="check_<?php echo $id; ?>" id="<?php echo $id; ?>" onclick="action_click('<?php echo $id ?>','<?php echo getDayOfWeek($i) ?>',event)">
                                    <span><?php echo getDayOfWeek($i); ?></span>
                                    <em><?php echo $newDay ?></em>
                                </label>

                            <?php
                            }
                            $offset++;
                        }
                        for ($i = 1; $i < $currentDayNumber; $i++) {
                            $newDate = date('Y-m-d', strtotime("+$offset days", strtotime($currentDate)));
                            list($year, $month, $day) = explode('-', $newDate);
                            if (checkdate($month, $day, $year)) {
                                $newDay = date('d', strtotime($newDate));
                                $newMonth = date('m', strtotime($newDate));
                                $newYear = date('Y', strtotime($newDate));
                                $id = $newYear . $newMonth . $newDay;
                                $dayofweek = getDayOfWeek($i);
                                $currentWeek[] = array(
                                    'dayofweek' => $dayofweek,
                                    'newDay' => $newDay,
                                    'id' => $id
                                );
                            ?>
                                <input type="radio" id="check_<?php echo $id; ?>">
                                <label for="check_<?php echo $id; ?>" id="<?php echo $id; ?>" onclick="action_click('<?php echo $id ?>','<?php echo getDayOfWeek($i) ?>',event)">
                                    <span><?php echo getDayOfWeek($i); ?></span>
                                    <em><?php echo $newDay ?></em>
                                </label>
                        <?php
                            }
                            $offset++;
                        }
                        ?>
                        <?php
                        $nextWeek = array();
                        for ($i = $currentDayNumber; $i <= 7; $i++) {
                            $newDate = date('Y-m-d', strtotime("+$offset days", strtotime($currentDate))); // Tăng ngày theo $i
                            list($year, $month, $day) = explode('-', $newDate);
                            if (checkdate($month, $day, $year)) {
                                $newDay = date('d', strtotime($newDate));
                                $newMonth = date('m', strtotime($newDate));
                                $newYear = date('Y', strtotime($newDate));
                                $id = $newYear . $newMonth . $newDay;
                                $dayofweek = getDayOfWeek($i);
                                // Thêm các giá trị vào mảng $nextWeek
                                $nextWeek[] = array(
                                    'dayofweek' => $dayofweek,
                                    'newDay' => $newDay,
                                    'id' => $id
                                );
                            }
                            $offset++;
                        }
                        for ($i = 1; $i < $currentDayNumber; $i++) {
                            $newDate = date('Y-m-d', strtotime("+$offset days", strtotime($currentDate)));
                            list($year, $month, $day) = explode('-', $newDate);
                            if (checkdate($month, $day, $year)) {
                                $newDay = date('d', strtotime($newDate));
                                $newMonth = date('m', strtotime($newDate));
                                $newYear = date('Y', strtotime($newDate));
                                $id = $newYear . $newMonth . $newDay;
                                $dayofweek = getDayOfWeek($i);
                                $nextWeek[] = array(
                                    'dayofweek' => $dayofweek,
                                    'newDay' => $newDay,
                                    'id' => $id
                                );
                            }
                            $offset++;
                        }
                        $nextWeekEncoded = json_encode($nextWeek);
                        $prevWeekEncoded = json_encode($currentWeek);
                        ?>
                    </div>

                </fieldset>

                <a href="#" class="week_pick_nav fas fa-chevron-right right" onclick="showWeekNext(<?php echo htmlspecialchars($nextWeekEncoded); ?>)"></a>
            </div>

        </div>

        <div class="select_film">
            <ul>
                <!-- <li id="MV001" onclick="click_film('MV001')"><span>1</span><a >kong&grozila:thế giới mới1</a></li> -->
                
            </ul>
        </div>

        <div class="time_ticket">
            <div class="date">
                <dt>Ngày:</dt>
                <dd></dd>
            </div>
            <div class="film">
                <dt>Phim: </dt>
                <dd>
                    <span>Vui Lòng Chọn Phim</span>
                    <ul class="film_choose"></ul>
                </dd>
            </div>
        </div>
    </div>
    <div class="time_inner">
        <div class="time_header">
            <h3>Giờ Chiếu</h3>
            <p>Thời gian chiếu phim có thể chênh lệch 15 phút do chiếu quảng cáo, giới thiệu phim ra rạp</p>
        </div>
        <div class="time_box_data">
            <h4></h4>
            <div class="list_showtime">
            <ul>
                    <!-- <li>
                        <span>Room</span>
                        <span>9:30</span>
                        <span>234/240 Ghế ngồi</span>
                    </li>
                     -->
                </ul>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var firstLabel = document.querySelector('.calendar .week_picker_field .calender_area label');
        // console.log(firstLabel)
        var id = firstLabel.getAttribute('id');
        var dayOfWeek = firstLabel.querySelector('span').textContent;
        action_click(id, dayOfWeek);

        // loadfocus
        setTimeout(function() {
            var allLiElements = document.querySelectorAll('.select_film ul li');
            if (allLiElements != null) {
                // click_film(movieFocus);
            }
        }, 100);
    });
    var prevWeekEncoded = <?php echo json_encode($prevWeekEncoded); ?>;
</script>
</div>
<div class="footer">
    <?php
    include("footer.php");
    ?>
</div>
<script src="/js/seatwrap.js"></script>
<script src="/js/app.js"></script>


<link rel="stylesheet" href="../css/app.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

