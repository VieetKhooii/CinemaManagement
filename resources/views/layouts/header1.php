<link rel="stylesheet" href="/css/header_footer.css">
<header>
    <div id="header_contain">
        <div id="start_Header">
            <div id="start_submenu">
                <h5 id="cinemaApp">Cinema APP</h5>
                <h5 id="cinemaFB">Cinema Facebook</h5>
            </div>
        </div>
        <?php 
            use \Illuminate\Support\Facades\Cookie;
                $cookie = Cookie::get('jwt_role');
                $cookie_data = json_decode($cookie, true);
                $user_id = isset($cookie_data['user_id']) ? $cookie_data['user_id'] : 'Unknown';
        ?>
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id ?>">
        <div id="end_Header">
            <div id="end_submenu">
                <h5 id="theTV" onclick="loadViewOnly('member')">Thẻ thành viên</h5>
                <h5 id="trangCaNhan" onclick="loadViewOnly('myself')">Trang cá nhân</h5>
                <button id="logout" onclick="logout()">Đăng xuất</button>
            </div>
        </div>
    </div>

    <div id="logo">
        <h1><a href="/dashboard">CINEMA</a></h1>
    </div>
    <div id="header_menu">
        <h3 id="shopquatang">SHOP QUÀ TẶNG </h3>
        <h3><a id="muave" onclick="film_booking()">MUA VÉ</a></h3>
        <h3 id="phim">PHIM</h3>
        <h3 id="rapchieuphim">RẠP CHIẾU PHIM</h3>
        <h3><a id="khuyenmai" onclick="loadSign('vouchers')">KHUYẾN MÃI</a></h3>
        <h3 id="lienhe">LIÊN HỆ</h3>
    </div>
    <?php include ("menu-container.php");?>
</header>
<script src="/js/app.js"></script>
<!-- <script src="/js/foot_item.js"></script> -->
