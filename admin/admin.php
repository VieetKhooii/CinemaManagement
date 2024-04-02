<link rel="stylesheet" href="style_admin.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <div id="menu">
        <h1>Cinema Management</h1>
        
        <div id="category" >
            <button onclick="showContent('category',1)" >Thể loại</button>
        </div>
        <div id="combo" >
            <button onclick="showContent('combo',1)">Combo</button>
        </div>
        <div id="movie" >
            <button onclick="showContent('movie',1)">Phim</button>
        </div>
        <div id="roles" >
            <button onclick="showContent('roles',1)">Quyền</button>
        </div>
        <div id="room" >
            <button onclick="showContent('room',1)">Phòng</button>
        </div>
        <div id="seat" >
            <button onclick="showContent('seat',1)">Chỗ ngồi</button>
        </div>
        <div id="seat_type" >
            <button onclick="showContent('seat_type',1)">Loại chỗ ngồi</button>
        </div>
        <div id="showtime" >
            <button onclick="showContent('showtime',1)">Thời gian chiếu</button>
        </div>

        <div id="voucher" >
            <button onclick="showContent('voucher',1)">Phiếu giảm giá</button>
        </div>

        <div id="users" >
            <button onclick="showContent('users',1)"> Người dùng</button>
        </div>
        <div id="reservation" >
            <button onclick="showContent('reservation',1)">Hóa đơn</button>
        </div>
        <div id="transactions" >
            <button onclick="showContent('transactions',1)">Chi tiết hóa đơn</button>
        </div>
        
        <div id="static" >
            <button onclick="showContent('static','admin_static.php')" >Thống kê</button>
        </div>
    </div>
    <div id="content">
        <?php 
        
            include("admin_static.php");
            
        ?>       
    </div>
</div>
<script src="script_admin.js"></script>


