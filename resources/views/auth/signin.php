<link rel="stylesheet" href="../css/header_footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<form id="loginForm" method="post">
    <h1>Đăng nhập</h1>
    <div id="khung">
        <h4>Vui lòng đăng nhập để nhận nhiều ưu đãi</h4>
        <input type="text" id="email" name="contact" placeholder="Vui lòng nhập sđt/ email" required oninvalid="this.setCustomValidity('Vui lòng nhập đúng số điện thoại hoặc email.')" oninput="this.setCustomValidity('')">
        <input type="password" id="password" name="password" placeholder="Vui lòng nhập mật khẩu" required oninvalid="this.setCustomValidity('Vui lòng nhập đúng số điện thoại hoặc email.')" oninput="this.setCustomValidity('')">
        <div class="show_hidden_pass">
            <i class="fa-solid fa-eye-slash" onclick="show_hidden(false)"></i>
        </div>
        <input id="continue" type="submit" value="Đăng nhập">

        <div class="forget_Pass">
            <a href="#" onclick="goBack()">Quên mật khẩu?</a>
        </div>
        <h5>hoặc đăng nhập bằng</h5>

        <div class="icon_signin">
            <button id="google"><img src="../img/google.png" alt="">Google</button>
            <button id="apple"><img src="../img/Facebook_f_logo_(2019).svg" alt="">Facebook</button>
        </div>
        <script src="/js/login.js"></script>
    </div>
</form>
<script src="../js/forgetpass.js"></script>
