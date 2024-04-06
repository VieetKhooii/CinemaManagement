<link rel="stylesheet" href="css/style_admin.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <div id="menu">
        <h1>Cinema Management</h1>
        
        <div id="categories" >
            <button onclick="showContent('categories',1)" >Thể loại</button>
        </div>
        <div id="combos" >
            <button onclick="showContent('combos',1)">Combo</button>
        </div>
        <div id="movies" >
            <button onclick="showContent('movies',1)">Phim</button>
        </div>
        <div id="roles" >
            <button onclick="showContent('roles',1)">Quyền</button>
        </div>
        <div id="rooms" >
            <button onclick="showContent('rooms',1)">Phòng</button>
        </div>
        <div id="seats" >
            <button onclick="showContent('seats',1)">Chỗ ngồi</button>
        </div>
        <div id="seatTypes" >
            <button onclick="showContent('seatTypes',1)">Loại chỗ ngồi</button>
        </div>
        <div id="showtimes" >
            <button onclick="showContent('showtimes',1)">Thời gian chiếu</button>
        </div>

        <div id="vouchers" >
            <button onclick="showContent('vouchers',1)">Phiếu giảm giá</button>
        </div>

        <div id="users" >
            <button onclick="showContent('users',1)"> Người dùng</button>
        </div>
        <div id="reservations" >
            <button onclick="showContent('reservations',1)">Hóa đơn</button>
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
        
            // include("admin_static.php");
            
        ?>       
    </div>
</div>
<script src="js/script_admin.js"></script>


