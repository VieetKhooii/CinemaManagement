function setDefaultDate() {
    // Lấy ngày hiện tại
    var today = new Date();

    // Format ngày hiện tại thành yyyy-MM-dd (định dạng mà trường input type="date" yêu cầu)
    var formattedDate = today.toISOString().substr(0, 10);

    // Thiết lập giá trị mặc định cho trường ngày
    document.getElementById("date").value = formattedDate;
}

// Gọi hàm để thiết lập giá trị mặc định khi trang được tải
setDefaultDate();

function checkSelectionQuery() {
    var valueSelect = document.getElementById('statistic_Select').value;
    if (myChart) {
        myChart.destroy();
    }
    $('#myTable').empty();
    if (valueSelect === "0") {
        veBieuDoFilmSeat();
        // Kích hoạt lại input có name là "date" và "time"
        document.getElementsByName("date")[0].disabled = false;
        var timeInputs = document.getElementsByName("time");
        for (var i = 0; i < timeInputs.length; i++) {
            timeInputs[i].disabled = false;
        }
    } else if (valueSelect === "1") {
        veBieuDoCombo();
        // Kích hoạt lại input có name là "date" và "time"
        document.getElementsByName("date")[0].disabled = false;
        var timeInputs = document.getElementsByName("time");
        for (var i = 0; i < timeInputs.length; i++) {
            timeInputs[i].disabled = false;
        }
    } else if (valueSelect === "2") {
        veBieuDoFilm();
        // Kích hoạt lại input có name là "date" và "time"
        document.getElementsByName("date")[0].disabled = false;
        var timeInputs = document.getElementsByName("time");
        for (var i = 0; i < timeInputs.length; i++) {
            timeInputs[i].disabled = false;
        }
    } else {
        // Vô hiệu hóa input có name là "date" và "time"
        var dateInput = document.getElementsByName("date")[0];
        var timeInputs = document.getElementsByName("time");

        dateInput.disabled = true;
        for (var i = 0; i < timeInputs.length; i++) {
            timeInputs[i].disabled = true;
        }

        // Kích hoạt các phần tử không cần thiết khác
        document.getElementById("year").disabled = false;
        document.querySelector('label[for="year"]').style.color = 'black';
        veBieuDoTotalRevenue();
    }
}



var myChart;
loadDataFilmSeat();
getMaxFilmSeat();
getMinFilmSeat();
getTotalFilmSeat();

function veBieuDoFilmSeat() {
    var selectedTime = document.querySelector('input[name="time"]:checked').value; // Lấy giá trị của radBtn được chọn
    var selectedDate = document.getElementById('date').value; // Lấy giá trị của trường ngày

    // Kiểm tra giá trị của radBtn và thực hiện các hành động tương ứng
    if (selectedTime === "0") {
        loadDataFilmSeat();
        getMaxFilmSeat();
        getMinFilmSeat();
        getTotalFilmSeat();
    } else if (selectedTime === "1") {
        loadDataFilmSeat(selectedDate);
        getMaxFilmSeat(selectedDate);
        getMinFilmSeat(selectedDate);
        getTotalFilmSeat(selectedDate);
    } else if (selectedTime === "2") {
        var selectedMonthYear = selectedDate.slice(0, 7); // Cắt chuỗi để lấy tháng và năm (yyyy-MM)
        loadDataFilmSeat(selectedMonthYear);
        getMaxFilmSeat(selectedMonthYear);
        getMinFilmSeat(selectedMonthYear);
        getTotalFilmSeat(selectedMonthYear);
    } else if (selectedTime === "3") {
        var selectedYear = selectedDate.slice(0, 4); // Cắt chuỗi để lấy năm (yyyy)
        loadDataFilmSeat(selectedYear);
        getMaxFilmSeat(selectedYear);
        getMinFilmSeat(selectedYear);
        getTotalFilmSeat(selectedYear);
    }
}
function veBieuDoCombo() {
    var selectedTime = document.querySelector('input[name="time"]:checked').value; // Lấy giá trị của radBtn được chọn
    var selectedDate = document.getElementById('date').value; // Lấy giá trị của trường ngày

    // Kiểm tra giá trị của radBtn và thực hiện các hành động tương ứng
    if (selectedTime === "0") {
        // Không lấy date, thực hiện hành động tương ứng ở đây
        // console.log("Không lấy date");
        loadDataCombo();
        getMaxCombo();
        getMinCombo();
        getTotalCombo();

    } else if (selectedTime === "1") {
        // Lấy date, thực hiện hành động tương ứng ở đây
        // console.log("Lấy date:", selectedDate); 
        loadDataCombo(selectedDate);
        getMaxCombo(selectedDate);
        getMinCombo(selectedDate);
        getTotalCombo(selectedDate);
    } else if (selectedTime === "2") {
        // Chỉ lấy tháng và năm từ date, thực hiện hành động tương ứng ở đây
        var selectedMonthYear = selectedDate.slice(0, 7); // Cắt chuỗi để lấy tháng và năm (yyyy-MM)
        // console.log("Lấy tháng và năm từ date:", selectedMonthYear);
        loadDataCombo(selectedMonthYear);
        getMaxCombo(selectedMonthYear);
        getMinCombo(selectedMonthYear);
        getTotalCombo(selectedMonthYear);
    } else if (selectedTime === "3") {
        // Chỉ lấy năm từ date, thực hiện hành động tương ứng ở đây
        var selectedYear = selectedDate.slice(0, 4); // Cắt chuỗi để lấy năm (yyyy)
        // console.log("Lấy năm từ date:", selectedYear);
        loadDataCombo(selectedYear);
        getMaxCombo(selectedYear);
        getMinCombo(selectedYear);
        getTotalCombo(selectedYear);
    }
}

function veBieuDoFilm() {
    var selectedTime = document.querySelector('input[name="time"]:checked').value; // Lấy giá trị của radBtn được chọn
    var selectedDate = document.getElementById('date').value; // Lấy giá trị của trường ngày

    // Kiểm tra giá trị của radBtn và thực hiện các hành động tương ứng
    if (selectedTime === "0") {
        // Không lấy date, thực hiện hành động tương ứng ở đây
        // console.log("Không lấy date");
        loadDataFilm();
        getMaxFilm();
        getMinFilm();
        getTotalFilm();
    } else if (selectedTime === "1") {
        // Lấy date, thực hiện hành động tương ứng ở đây
        // console.log("Lấy date:", selectedDate); 
        loadDataFilm(selectedDate);
        getMaxFilm(selectedDate);
        getMinFilm(selectedDate);
        getTotalFilm(selectedDate);
    } else if (selectedTime === "2") {
        // Chỉ lấy tháng và năm từ date, thực hiện hành động tương ứng ở đây
        var selectedMonthYear = selectedDate.slice(0, 7); // Cắt chuỗi để lấy tháng và năm (yyyy-MM)
        // console.log("Lấy tháng và năm từ date:", selectedMonthYear);
        loadDataFilm(selectedMonthYear);
        getMaxFilm(selectedMonthYear);
        getMinFilm(selectedMonthYear);
        getTotalFilm(selectedMonthYear);
    } else if (selectedTime === "3") {
        // Chỉ lấy năm từ date, thực hiện hành động tương ứng ở đây
        var selectedYear = selectedDate.slice(0, 4); // Cắt chuỗi để lấy năm (yyyy)
        // console.log("Lấy năm từ date:", selectedYear);
        loadDataFilm(selectedYear);
        getMaxFilm(selectedYear);
        getMinFilm(selectedYear);
        getTotalFilm(selectedYear);
    }
}

function veBieuDoTotalRevenue() {
    var selectedTime = document.querySelector('input[name="time"]:checked').value; // Lấy giá trị của radBtn được chọn
    var selectedDate = document.getElementById('date').value; // Lấy giá trị của trường ngày

    // Kiểm tra giá trị của radBtn và thực hiện các hành động tương ứng
    if (selectedTime === "3") {
        var selectedYear = selectedDate.slice(0, 4); // Cắt chuỗi để lấy năm (yyyy)
        loadDataTotalRevenue(selectedYear);
        getMaxRevenue(selectedYear);
        getMinRevenue(selectedYear);
        getTotalRevenue(selectedYear);
    }
}

function loadDataFilmSeat(date) {
    var url = 'filmSeat';

    // Nếu có ngày được chọn, thêm ngày vào URL
    if (date) {
        url += '?date=' + date;
    }
    // Kiểm tra nếu biểu đồ đã được tạo và là một đối tượng Chart.js
    if (myChart) {
        // Hủy biểu đồ cũ trước khi vẽ biểu đồ mới
        myChart.destroy();
    }
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (jsonData) {
            console.log(jsonData);
            var labels = [];
            var data = [];

            jsonData.forEach(function (item) {
                labels.push(item.movie_name);
                data.push(item.total_seats_booked);
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Seats Booked',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            $('#myTable').empty();
    
            // Tạo header cho bảng
            var tableHeader = '<thead><tr><th>Movie Name</th><th>Total Seats Booked</th></tr></thead>';
            
            // Tạo một biến để lưu body của bảng
            var tableBody = '<tbody>';
            
            // Duyệt qua mỗi item trong jsonData và thêm vào body của bảng
            jsonData.forEach(function (item) {
                tableBody += '<tr><td>' + item.movie_name + '</td><td>' + item.total_seats_booked + '</td></tr>';
            });
            
            // Kết thúc body của bảng
            tableBody += '</tbody>';
            
            // Kết hợp header và body để tạo bảng hoàn chỉnh
            var table = tableHeader + tableBody;
            
            // Thêm bảng vào #myTable
            $('#myTable').html(table);
        },
        error: function (xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });
}

function loadDataCombo(date) {
    var url = 'combo';

    // Nếu có ngày được chọn, thêm ngày vào URL
    if (date) {
        url += '?date=' + date;
    }
    // Kiểm tra nếu biểu đồ đã được tạo và là một đối tượng Chart.js
    if (myChart) {
        // Hủy biểu đồ cũ trước khi vẽ biểu đồ mới
        myChart.destroy();
    }
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (jsonData) {
            console.log(jsonData);
            var labels = [];
            var data = [];

            jsonData.forEach(function (item) {
                labels.push(item.combo_name);
                data.push(item.revenue);
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            $('#myTable').empty();
    
            // Tạo header cho bảng
            var tableHeader = '<thead><tr><th>Combo Name</th><th>Revenue</th></tr></thead>';
            
            // Tạo một biến để lưu body của bảng
            var tableBody = '<tbody>';
            
            // Duyệt qua mỗi item trong jsonData và thêm vào body của bảng
            jsonData.forEach(function (item) {
                tableBody += '<tr><td>' + item.combo_name + '</td><td>' + item.revenue + '</td></tr>';
            });
            
            // Kết thúc body của bảng
            tableBody += '</tbody>';
            
            // Kết hợp header và body để tạo bảng hoàn chỉnh
            var table = tableHeader + tableBody;
            
            // Thêm bảng vào #myTable
            $('#myTable').html(table);
        },
        error: function (xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });
}


function loadDataFilm(date) {
    var url = 'film';

    // Nếu có ngày được chọn, thêm ngày vào URL
    if (date) {
        url += '?date=' + date;
    }
    // Kiểm tra nếu biểu đồ đã được tạo và là một đối tượng Chart.js
    if (myChart) {
        // Hủy biểu đồ cũ trước khi vẽ biểu đồ mới
        myChart.destroy();
    }
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (jsonData) {
            console.log(jsonData);
            var labels = [];
            var data = [];

            jsonData.forEach(function (item) {
                labels.push(item.movie_name);
                data.push(item.total_bonus); // Thay đổi từ item.total_seats_booked sang item.total_bonus
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Bonus', // Thay đổi label thành 'Total Bonus'
                        data: data,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền mới cho biểu đồ
                        borderColor: 'rgba(255, 99, 132, 1)', // Màu viền mới cho biểu đồ
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            $('#myTable').empty();
    
            // Tạo header cho bảng
            var tableHeader = '<thead><tr><th>Movie Name</th><th>Total Bonus</th></tr></thead>';
            
            // Tạo một biến để lưu body của bảng
            var tableBody = '<tbody>';
            
            // Duyệt qua mỗi item trong jsonData và thêm vào body của bảng
            jsonData.forEach(function (item) {
                tableBody += '<tr><td>' + item.movie_name + '</td><td>' + item.total_bonus + '</td></tr>';
            });
            
            // Kết thúc body của bảng
            tableBody += '</tbody>';
            
            // Kết hợp header và body để tạo bảng hoàn chỉnh
            var table = tableHeader + tableBody;
            
            // Thêm bảng vào #myTable
            $('#myTable').html(table);
        },
        error: function (xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });
}

function loadDataTotalRevenue(selectedYear) {
    var url = 'revenue?date=' + selectedYear; // Cập nhật url với tham số selectedYear
    if (myChart) {
        myChart.destroy();
    }   
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (jsonData) {
            console.log(jsonData);
        
            var labels = [];
            var data = [];
        
            // Lặp qua mỗi bản ghi trong mảng dữ liệu
            for (var i = 0; i < jsonData.length; i++) {
                // Lấy tháng và doanh thu từ mỗi bản ghi
                var month = jsonData[i].purchase_month;
                var revenue = parseFloat(jsonData[i].total_revenue);
        
                labels.push(month); // Thêm tháng vào mảng nhãn
                data.push(revenue); // Thêm doanh thu vào mảng dữ liệu
            }
        
            console.log(labels);
            console.log(data);
            // Tạo biểu đồ Chart.js tại đây
           
            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Revenue',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            $('#myTable').empty();
    
            // Tạo header cho bảng
            var tableHeader = '<thead><tr><th>Month</th><th>Revenue </th></tr></thead>';
            
            // Tạo một biến để lưu body của bảng
            var tableBody = '<tbody>';
            
            // Duyệt qua mỗi item trong jsonData và thêm vào body của bảng
            jsonData.forEach(function (item) {
                tableBody += '<tr><td>' + item.purchase_month + '</td><td>' + item.total_revenue + '</td></tr>';
            });
            
            // Kết thúc body của bảng
            tableBody += '</tbody>';
            
            // Kết hợp header và body để tạo bảng hoàn chỉnh
            var table = tableHeader + tableBody;
            
            // Thêm bảng vào #myTable
            $('#myTable').html(table);
        },
        error: function (xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });
}

// // Gọi hàm để tải dữ liệu và vẽ biểu đồ khi trang được tải
// $(document).ready(function() {
//     loadDataTotalRevenue();
// });



var title1 = document.getElementById('title1');
var title2 = document.getElementById('title2');
var title3 = document.getElementById('title3');

var titlekey1 = document.getElementById('titlekey1');
var titlekey2 = document.getElementById('titlekey2');

var titlevalue1 = document.getElementById('titlevalue1');
var titlevalue2 = document.getElementById('titlevalue2');
var titlevalue3 = document.getElementById('titlevalue3');

var textKey1 = document.getElementById('key1');
var textValue1 = document.getElementById('value1');
var textKey2 = document.getElementById('key2');
var textValue2 = document.getElementById('value2');
var textKey3 = document.getElementById('key3');
var textValue3 = document.getElementById('value3');

function getMaxFilmSeat(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title1.textContent = "PHIM CÓ NHIỀU GHẾ ĐƯỢC ĐẶT NHẤT";
                titlekey1.textContent = "TÊN PHIM: ";
                titlevalue1.textContent = "SỐ LƯỢNG GHẾ ĐÃ ĐẶT: "
                if (typeof data.movie_name !== 'undefined') {
                    textKey1.textContent = data.movie_name;
                } else {
                    textKey1.textContent = 'Không có';
                }
                if (typeof data.total_seats_booked !== 'undefined') {
                    textValue1.textContent = data.total_seats_booked;
                } else {
                    textValue1.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'maxFilmSeat?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}
function getMinFilmSeat(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title2.textContent = "PHIM CÓ ÍT GHẾ ĐƯỢC ĐẶT NHẤT";
                titlekey2.textContent = "TÊN PHIM: ";
                if (typeof data.total_seats_booked !== 'undefined') {
                    textValue2.textContent = data.total_seats_booked;
                } else {
                    textValue2.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'minFilmSeat?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}

function getTotalFilmSeat(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title3.textContent = "TỔNG GHẾ ĐƯỢC ĐẶT CỦA TẤT CẢ PHIM";
                titlevalue3.textContent = "SỐ LƯỢNG GHẾ ĐÃ ĐẶT: "
                console.log(data.total_seats_booked);
                if (data.total_seats_booked !== null) {
                    textValue3.textContent = data.total_seats_booked;
                } else {
                    textValue3.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'totalFilmSeat?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}


function getMaxCombo(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title1.textContent = "COMBO CÓ DOANH THU CAO NHẤT";
                titlekey1.textContent = "TÊN COMBO:";
                titlevalue1.textContent = "DOANH THU:";

                if (typeof data.combo_name !== 'undefined') {
                    textKey1.textContent = data.combo_name;
                } else {
                    textKey1.textContent = 'Không có';
                }
                if (typeof data.revenue !== 'undefined') {
                    textValue1.textContent = data.revenue;
                } else {
                    textValue1.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'maxCombo?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}
function getMinCombo(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title2.textContent = "COMBO CÓ DOANH THU THẤP NHẤT";
                titlekey2.textContent = "TÊN COMBO:";
                titlevalue2.textContent = "DOANH THU:";
                if (typeof data.combo_name !== 'undefined') {
                    textKey2.textContent = data.combo_name;
                } else {
                    textKey2.textContent = 'Không có';
                }
                if (typeof data.revenue !== 'undefined') {
                    textValue2.textContent = data.revenue;
                } else {
                    textValue2.textContent = 'Không có';
                }

            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'minCombo?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}

function getTotalCombo(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title3.textContent = "TỔNG DOANH THU COMBO"
                titlevalue3.textContent = "DOANH THU: "
                console.log(data.total_revenue);
                if (data.total_revenue !== null) {
                    textValue3.textContent = data.total_revenue;
                } else {
                    textValue3.textContent = 0 + " đồng";
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'totalCombo?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}



function getMaxFilm(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title1.textContent = "PHIM CÓ DOANH THU CAO NHẤT";
                titlekey1.textContent = "TÊN PHIM:";
                titlevalue1.textContent = "DOANH THU:";
                if (typeof data.movie_name !== 'undefined') {
                    textKey1.textContent = data.movie_name;
                } else {
                    textKey1.textContent = 'Không có';
                }
                if (typeof data.total_bonus !== 'undefined') {
                    textValue1.textContent = data.total_bonus;
                } else {
                    textValue1.textContent = 'Không có';
                }

            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'maxFilm?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}
function getMinFilm(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title2.textContent = "PHIM CÓ DOANH THU THẤP NHẤT";
                titlekey2.textContent = "TÊN PHIM:";
                titlevalue2.textContent = "DOANH THU:";
                if (typeof data.movie_name !== 'undefined') {
                    textKey2.textContent = data.movie_name;
                } else {
                    textKey2.textContent = 'Không có';
                }
                if (typeof data.total_bonus !== 'undefined') {
                    textValue2.textContent = data.total_bonus;
                } else {
                    textValue2.textContent = 'Không có';
                }

            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'minFilm?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}

function getTotalFilm(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();
    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);

                title3.textContent = "TỔNG DOANH THU CỦA TẤT CẢ PHIM";
                titlevalue3.textContent = "DOANH THU: "
                console.log(data.all_total_bonus);
                if (data.all_total_bonus !== null) {
                    textValue3.textContent = data.all_total_bonus + " đồng";
                } else {
                    textValue3.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    // Mở kết nối đến máy chủ
    xhr.open('GET', 'totalFilm?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}

function getMaxRevenue(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title1.textContent = "THÁNG CÓ DOANH THU CAO NHẤT";
                titlekey1.textContent = "THÁNG: ";
                titlevalue1.textContent = "DOANH THU: "

                if (typeof data.purchase_month !== 'undefined') {

                    textKey1.textContent = data.purchase_month;
                }
                else {
                    textKey1.textContent = 'Không có';
                }

                if (typeof data.total_revenue !== 'undefined') {
                    textValue1.textContent = data.total_revenue;
                } else {
                    textValue1.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'maxRevenue?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}
function getMinRevenue(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title2.textContent = "Tháng có doanh thu thấp nhất";
                titlekey2.textContent = "Tháng: ";
                titlevalue2.textContent = "DOANH THU: "

                if (typeof data.purchase_month !== 'undefined') {

                    textKey2.textContent = data.purchase_month;
                    console.log(textKey2.textContent)
                }
                else {
                    textKey2.textContent = 'Không có';
                }

                if (typeof data.total_revenue !== 'undefined') {
                    console.log(data.total_revenue)
                    textValue2.textContent = data.total_revenue;
                } else {
                    textValue2.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'minRevenue?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}

function getTotalRevenue(date) {
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Định nghĩa hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                var data = JSON.parse(xhr.responseText);
                title3.textContent = "TỔNG DOANH THU TRONG NĂM";
                titlevalue3.textContent = "Doanh thu: "
                if (data.total_revenue !== null) {
                    textValue3.textContent = data.total_revenue;
                } else {
                    textValue3.textContent = 'Không có';
                }
            } else {
                // Xử lý lỗi khi nhận phản hồi không thành công từ máy chủ
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    // Mở kết nối đến máy chủ
    xhr.open('GET', 'totalRevenue?date=' + date, true);

    // Gửi yêu cầu đến máy chủ
    xhr.send();
}