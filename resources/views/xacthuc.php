<link rel="stylesheet" href="../css/forgetpass.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="forgetpass2">
    <div class="content-change">
        <h3><button type="button" class="btn-back" onclick="goBack()"></button><span>Xác thực</span></h3>
        <div class="scroll-content no-scroll">
            <p class="note-txt text-center note-txt-res">Vui lòng nhập mã xác thực đã được gởi đến <strong>volekimtien@gmail.com</strong></p>
            <div class="opt-input-content">
                <div class="input_text">
                    <input type="text" id="otp1" name="otp-login" maxlength="6" placeholder="______" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
            </div>
            <br>
            <div class="verify-block">
                <button type="button" class="btn2 btn-border btn-sm" id="countdownBtn">03:00</button>
                <button type="button" class="btn2 btn-border btn-sm" id="resend_code" style="cursor:pointer" onclick="restartCountdown()">Gửi lại</button>
            </div>
            <button type="button" id="verifySmsUser" style="cursor:pointer">Xác thực</button>

        </div>
    </div>
</div>
<script src="../js/forgetpass.js"></script>