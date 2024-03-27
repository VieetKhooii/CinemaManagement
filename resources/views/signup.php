<link rel="stylesheet" href="/css/signup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div id="form_signUp">
    <form id="signupForm" method="post">
        <h2>Đăng ký</h2>
        <label for="full_name">Họ và tên:</label>
        <input type="text" id="full_name" name="full_name" required oninvalid="this.setCustomValidity('Vui lòng nhập Họ và tên.')" oninput="this.setCustomValidity('')">
        <label for="phone">Số điện thoại:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required oninvalid="this.setCustomValidity('Vui lòng nhập Số điện thoại 10 chữ số.')" oninput="this.setCustomValidity('')">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required oninvalid="this.setCustomValidity('Vui lòng nhập đúng định dạng Email.')" oninput="this.setCustomValidity('')">
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required oninvalid="this.setCustomValidity('Vui lòng nhập Mật khẩu.')" oninput="this.setCustomValidity('')">
        <div class="form-row">
            <div>
                <label for="dob">Ngày sinh:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required oninvalid="this.setCustomValidity('Vui lòng chọn Ngày sinh.')" oninput="this.setCustomValidity('')">
            </div>
            <div>
                <label for="gender" id="lb_gender">Giới tính:</label>
                <select id="gender" name="gender" required oninvalid="this.setCustomValidity('Vui lòng chọn Giới tính.')" oninput="this.setCustomValidity('')">
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                    <option value="cat">Mèo</option>
                    <option value="dog">Chó</option>
                    <option value="shark">Cá mập</option>
                    <option value="helicopter">Trực thăng</option>
                    <option value="non-tax">Người không phải đóng thuế</option>
                    <option value="no">hong thích có giới tính</option>
                </select>
            </div>
        </div>
        </option>
        </select>
        <br><label for="address">Địa chỉ:</label>
        <input type="text" id="address" name="address" required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ.')" oninput="this.setCustomValidity('')">
        <label for="captcha">Mã captcha:</label>
        <div id="captchaBackground" style="display: flex;">
            <input type="text" id="captcha" name="captcha" required oninvalid="this.setCustomValidity('Vui lòng nhập mã captcha.')" oninput="this.setCustomValidity('')">
            <canvas id="captchaCode" width="150" height="40"></canvas>
            <button type="button" id="refreshButton" onclick="refreshCaptcha()"><i class="fa-solid fa-rotate-right"></i></button>
        </div>
        <small>Nhập mã gatcha theo hình bên phải. <span id="Notification"></span></small>
        <input type="submit" value="Đăng ký">
    </form>
</div>
<script src="/js/app.js"></script>