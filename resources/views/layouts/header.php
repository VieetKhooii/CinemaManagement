<link rel="stylesheet" href="/css/header_footer.css">
<header>
    <div id="header_contain">
        <div id="start_Header">
            <div id="start_submenu">
                <h5 id="cinemaApp">Cinema APP</h5>
                <h5 id="cinemaFB">Cinema Facebook</h5>
            </div>
        </div>

        <div id="end_Header">
            <div id="end_submenu">
                <h5 id="signIn" onclick="loadSign('login')"> Đăng nhập</h5>
                <h5 id="signUp" onclick="loadSign('sign-up')"> Đăng kí</h5>
                <h5 id="theTV" onclick="pleaseLogIn()">Thẻ thành viên</h5>
                <h5 id="htKH">Hỗ trợ khách hàng</h5>
                <!-- <button id="language">ENGLISH</button> -->
            </div>
        </div>
    </div>

    <div id="logo">
        <h1>CINEMA</h1>
    </div>
    <div id="header_menu">
        <!-- <h3 id="shopquatang">SHOP QUÀ TẶNG </h3> -->
        <h3 id="muave"><a id="muave" href="film_booking">MUA VÉ</a></h3>
        <h3 id="phim">PHIM</h3>
        <!-- <h3 id="rapchieuphim">RẠP CHIẾU PHIM</h3> -->
        <h3 id="khuyenmai" onclick="pleaseLogIn()">KHUYẾN MÃI</h3>
        <h3 id="lienhe">LIÊN HỆ</h3>
    </div>
    <?php include ("menu-container.php");?>
</header>
<script src="/js/app.js"></script>