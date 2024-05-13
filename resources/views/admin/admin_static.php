<link rel="stylesheet" href="../css/style_statistic.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="header">

    <div id="pickTime">
        <div class="date_selector">
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date">
        </div>
        <div id="radBtn_Time">
            <!-- <div class="radBtn"> -->
                <input type="radio" id="none" name="time" value="0" checked onclick=checkSelectionQuery()>
                <label for="none">Không</label>

                <input type="radio" id="date" name="time" value="1" onclick=checkSelectionQuery()>
                <label for="date">Ngày</label>

                <input type="radio" id="month" name="time" value="2" onclick=checkSelectionQuery()>
                <label for="month">Tháng</label>
            <!-- </div>
            <div class="radBtn"> -->
    
                <input type="radio" id="year" name="time" value="3" onclick=checkSelectionQuery()>
                <label for="year">Năm</label>
            <!-- </div>         -->
        </div>  
    </div>

    <div id="pickStatistic">
        <select id="statistic_Select" onchange="checkSelectionQuery()" >
            <option value="0" >Phim theo số người đặt</option>
            <option value="1">Doanh thu theo đồ ăn</option>
            <option value="2">Doanh thu theo phim</option>
            <option value="3">Doanh thu của rạp</option>
        </select>
    </div>

          
    
</div>
<div class="body">
    <div id="TextMax">
        <h3 id='title1'>PHIM CÓ NHIỀU GHẾ ĐƯỢC ĐẶT NHẤT</h3>
        <div class="key">
            <h3 id='titlekey1'>TÊN PHIM: </h3><h3 id='key1'></h3>
        </div>
        <div class="value">
            <h3 id='titlevalue1'>SỐ LƯỢNG GHẾ ĐÃ ĐẶT: </h3><h3 id='value1'></h3>
        </div>

    </div>
    <div id="TextMin">
        <h3 id='title2'>PHIM CÓ ÍT GHẾ ĐƯỢC ĐẶT NHẤT</h3>
        <div class="key">
            <h3 id='titlekey2'>TÊN PHIM: </h3><h3 id='key2'></h3>
        </div>
        <div class="value">
            <h3 id='titlevalue2'>SỐ LƯỢNG GHẾ ĐÃ ĐẶT: </h3><h3 id='value2'></h3>
        </div>
        
    </div>
    <div id="TextTotal">
        <h3 id='title3'>TỔNG GHẾ ĐƯỢC ĐẶT CỦA TẤT CẢ PHIM</h3>
        <!-- <h4 id='key3'>textare</h5> -->
        <div class="value">
            <h3 id='titlevalue3'>SỐ LƯỢNG GHẾ ĐÃ ĐẶT: </h3><h3 id='value3'></h3>
        </div>
    </div>
</div>
<canvas id="myChart"></canvas>
<table id="myTable"></table>
<script src="/js/script_statistic.js"></script>
