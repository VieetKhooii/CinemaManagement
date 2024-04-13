<link rel="stylesheet" href="../css/forgetpass.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div id="form_forgetPass" onsubmit="validateForgetPass(event)">
    <form onsubmit="return validateForm()">
        <h3><button type="button" class="btn-back" onclick="goBack()"></button><span>Xác thực</span></h3>

        <label for="contact">Số điện thoại hoặc Email:</label>
        <input type="text" id="contact" name="contact" placeholder="Vui lòng nhập sđt/ email" required oninvalid="this.setCustomValidity('Vui lòng nhập đúng số điện thoại hoặc email.')" oninput="this.setCustomValidity('')">

        <label for="captcha">Mã captcha:</label>
        <div id="captchaBackground" style="display: flex;">
            <input type="text" id="captcha" name="captcha" required oninvalid="this.setCustomValidity('Vui lòng nhập mã captcha.')" oninput="this.setCustomValidity('')">
            <canvas id="captchaCode" width="150" height="40"></canvas>
            <button type="button" id="refreshButton" onclick="refreshCaptcha()"><i class="fa-solid fa-rotate-right"></i></button>
        </div>

        <small>Nhập mã gatcha theo hình bên phải. <span id="Notification"></span></small>

        <input type="submit" value="Gửi mã" >
    </form>
</div>
<script src="../js/forgetpass.js"></script>