<link rel="stylesheet" href="../css/payment.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="container_payment">
    <div class="qr_code_container" style="display: none;">
        <div class="content_qr">
            <div class="qr_code">
                <img src="" alt="">
                <div class="total_momo">Tổng tiền: <span></span></div>
            </div>
            <div class="instruct_step">
                <div class="exit_momo"><a href="#" onclick="exit(event)"><i class="fa-solid fa-circle-xmark"></i></a></div>
                <p>Quét mã QR để thanh toán
                    Bước 1
                    Mở ứng dụng MOMO trên điện thoại

                    Bước 2
                    Trên MOMO, chọn biểu tượng icon Quét mã

                    Bước 3
                    Quét mã QR ở trang này và thanh toán
                </p>
            </div>
        </div>
    </div>
    <div class="payment">
        <h5>Đặt Hàng/Thanh Toán</h5>
        <div class="list_item_pay">
            <h5>Danh Sách Đã Chọn</h5>
            <table id="tbl_item">
                <tbody>
                    <?php 
                        if (htmlspecialchars($necessaryData)){
                            $unserializedData = unserialize($necessaryData);
                            echo  $necessaryData;
                        }
                        foreach($unserializedData as $row){}
                    ?>
                    <tr>
                        <td class="img_item" style="width: 25%;"><img src="../img/ticket_film-removebg-preview.png" alt=""></td>
                        <td class="info_item" colspan="2" style="width: 50%;">
                            <div class="info_name">Lật mặt 7:Một điều ước</div>
                            <div class="info_chosen">
                                <!-- Nếu là film -->
                                <p><span class="time">Ngày chiếu: 20/5/2024</span>| <span>Xuất chiếu: 9:30</span>| <span> Phòng: </span>| <span>Ghế:</span></p>
                                <!-- Nếu là combo -->
                                <p><span>1 Bắp</span> | <span>1 nước</span></p>
                            </div>
                        </td>
                        <td class="price_item" style="width: 25%;">
                            <p>300.000</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="img_item" style="width: 25%;"><img src="../img/ticket_film-removebg-preview.png" alt=""></td>
                        <td class="info_item" colspan="2" style="width: 50%;">
                            <div class="info_name">Lật mặt 7:Một điều ước</div>
                            <div class="info_chosen">
                                <!-- Nếu là film -->
                                <p><span class="time">Ngày chiếu: 20/5/2024</span>| <span>Xuất chiếu: 9:30</span>| <span> Phòng: </span>| <span>Ghế:</span></p>
                                <!-- Nếu là combo -->
                                <p><span>1 Bắp</span> | <span>1 nước</span></p>
                            </div>
                        </td>
                        <td class="price_item" style="width: 25%;">
                            <p>300.000</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="img_item" style="width: 25%;"><img src="../img/ticket_film-removebg-preview.png" alt=""></td>
                        <td class="info_item" colspan="2" style="width: 50%;">
                            <div class="info_name">Lật mặt 7:Một điều ước</div>
                            <div class="info_chosen">
                                <!-- Nếu là film -->
                                <p><span class="time">Ngày chiếu: 20/5/2024</span>| <span>Xuất chiếu: 9:30</span>| <span> Phòng: </span>| <span>Ghế:</span></p>
                                <!-- Nếu là combo -->
                                <p><span>1 Bắp</span> | <span>1 nước</span></p>
                            </div>
                        </td>
                        <td class="price_item" style="width: 25%;">
                            <p>300.000</p>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Tổng tiền đặt hàng:</td>
                        <td id="total_price">
                            <p>300.000</p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="voucher_box">
            <div class="voucher">
                <h3>Danh sách Voucher</h3>
                <ul class="voucher_list">
                    <li>Voucher 1</li>
                    <li>Voucher 2</li>
                </ul>
            </div>
        </div>

        <div class="payment_method">
            <h5>Phương thức thanh toán</h5>
            <form id="payment_form" method="POST"><!--  action="../views/Momo.php" -->
                <div class="info_payment">
                    <div class="input_wrapper">
                        <input type="hidden" id="amount" name="amount" value="500000"> <!-- Giá trị đơn hàng -->
                    </div>

                    <div class="input_wrapper">
                        <input type="radio" name="payment_method" value="momo">Quét mã QR MoMo <img src="../img/momo_icon.png" alt=""> <!-- Phương thức thanh toán MoMo -->
                    </div>

                    <div class="input_wrapper">
                        <input type="radio" name="payment_method" value="MTTS"> Mua Trước Trả Sau <img src="../img/MTTS_icon.png" alt=""><!-- Phương thức thanh toán Visa -->
                    </div>

                    <button type="submit" id="payment_button"><i class="fa-solid fa-hand-holding-dollar"></i> Thanh toán</button>
                </div>

            </form>
        </div>

        <div class="invoice">
            <h2>Thông tin thanh toán</h2>
            <div class="button-back">
                <a href="#"><i class="fa-solid fa-left-long"></i>Trở lại</a>
            </div>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Thành tiền</th>
                        <th>Số tiền được giảm</th>
                        <th>Tổng tiền đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="film"><span>Đặt trước phim:</span> <span>240.000đ</span></div>
                            <div class="combo"><span>Mua hàng:</span> <span>155.000đ</span></div>
                        </td>
                        <td>20,000₫</td>
                        <td>80,000₫</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function exit(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
        $('.qr_code img').attr('src', '');
        // Xóa giá trị tổng tiền
        $('.total_momo span').text('');
        // Ẩn phần tử chứa mã QR code
        $('.qr_code_container').css('display', 'none');
    }
    $(document).ready(function() {
        $('#payment_form').submit(function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của form
            var amount = $('#amount').val(); // Lấy giá trị đơn hàng
            var paymentMethod = $('input[name="payment_method"]:checked').val(); // Lấy phương thức thanh toán đã chọn
            // Kiểm tra xem người dùng đã chọn phương thức thanh toán chưa
            if (!paymentMethod) {
                alert('Vui lòng chọn phương thức thanh toán.');
                return; // Ngăn form tiếp tục submit
            }
            // Kiểm tra nếu phương thức thanh toán là MoMo thì mới gọi tới momo.php
            if (paymentMethod === 'momo') {
                // Gửi yêu cầu AJAX tới momo.php để lấy qrCodeFile
                $.ajax({
                    type: 'POST',
                    url: 'momo', // Đường dẫn đến file momo.php
                    data: {
                        amount: amount
                    },
                    dataType: 'json', // Loại dữ liệu trả về là JSON
                    success: function(response) {
                        if (response.qrCodeFile) {
                            // Cập nhật src của ảnh QR code
                            $('.qr_code img').attr('src', response.qrCodeFile);
                            // Cập nhật tổng tiền
                            var totalAmount = parseFloat(amount).toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            $('.total_momo span').text(totalAmount);
                            // Hiển thị phần tử chứa mã QR code
                            $('.qr_code_container').css('display', 'flex');
                        } else {
                            alert('Không thể tải mã QR. Vui lòng thử lại sau.');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Có lỗi xảy ra khi tải mã QR. Vui lòng thử lại sau.');
                    }
                });
            } else {
                // Nếu người dùng chọn phương thức thanh toán khác MoMo, thực hiện các hành động khác ở đây (nếu cần)
                // Ví dụ: alert('Phương thức thanh toán chưa được hỗ trợ.');
            }
        });
    });
</script>