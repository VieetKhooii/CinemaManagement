<link rel="stylesheet" href="../css/signup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div id="form_signUp" onsubmit="validateSignUp(event)">
    <form onclick="validateForm()" >
        <h2>Đăng ký</h2>
        <label for="fullname">Họ và tên:</label>
        <input type="text" id="fullname" name="fullname" required oninvalid="this.setCustomValidity('Vui lòng nhập Họ và tên.')" oninput="this.setCustomValidity('')">

        <label for="phone">Số điện thoại:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required oninvalid="this.setCustomValidity('Vui lòng nhập Số điện thoại 10 chữ số.')" oninput="this.setCustomValidity('')">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required oninvalid="this.setCustomValidity('Vui lòng nhập đúng định dạng Email.')" oninput="this.setCustomValidity('')">

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required oninvalid="this.setCustomValidity('Vui lòng nhập Mật khẩu.')" oninput="this.setCustomValidity('')">

        <div class="form-row">
            <div>
                <label for="dob">Ngày sinh:</label>
                <input type="date" id="dob" name="dob" required oninvalid="this.setCustomValidity('Vui lòng chọn Ngày sinh.')" oninput="this.setCustomValidity('')">
            </div>
            <div>
                <label for="gender" id="lb_gender">Giới tính:</label>
                <select id="gender" name="gender" required oninvalid="this.setCustomValidity('Vui lòng chọn Giới tính.')" oninput="this.setCustomValidity('')">
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                </select>
            </div>
        </div>
        </option>
        </select>

        <br><label for="region">Khu vực:</label>
        <input type="text" id="region" name="region" required oninvalid="this.setCustomValidity('Vui lòng chọn Khu vực.')" oninput="this.setCustomValidity('')">

        <label for="captcha">Mã captcha:</label>
        <div id="captchaBackground" style="display: flex;">
            <input type="text" id="captcha" name="captcha" required oninvalid="this.setCustomValidity('Vui lòng nhập mã captcha.')" oninput="this.setCustomValidity('')">
            <canvas id="captchaCode" width="150" height="40"></canvas>
            <button type="button" id="refreshButton" onclick="refreshCaptcha()"><i class="fa-solid fa-rotate-right"></i></button>
        </div>

        <small>Nhập mã gatcha theo hình bên phải. <span id="Notification"></span></small>

        <input type="submit" value="Đăng ký" onclick="validateCaptcha()">
    </form>
</div>
<script src="../js/app.js"></script>