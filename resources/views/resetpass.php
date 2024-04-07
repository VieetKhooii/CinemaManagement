<link rel="stylesheet" href="../css/forgetpass.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div id="form_forgetPass">
    <form onsubmit="return validateForgetPass2()">
    <h3><button type="button" class="btn-back" onclick="goBack()"></button><span>Khôi phục mật khẩu</span></h3>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" placeholder="Vui lòng nhập mật khẩu" required oninvalid="this.setCustomValidity('Vui lòng nhập mật khẩu.')" oninput="this.setCustomValidity('')">

        <label for="password2">Nhập lại mật khẩu:</label>
        <input type="password" id="password2" name="password2" placeholder="Vui lòng nhập mật khẩu" required oninvalid="this.setCustomValidity('Vui lòng nhập mật khẩu.')" oninput="this.setCustomValidity('')">
        <input type="submit" value="Khôi phục mật khẩu">
    </form>
</div>
<script src="../js/forgetpass.js"></script>
