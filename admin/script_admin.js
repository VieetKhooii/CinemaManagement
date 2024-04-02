//đánh dấu bảng đang hiện
function showContent(page,file) {
    var buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Đánh dấu nút hiện tại
    var currentButton = document.getElementById(page).querySelector('button');
    currentButton.classList.add('active');

    if(page !=="static"){
        showPage(page,file);
    }
    else{
        loadContent(file);
        
    }
   
}
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Hàm để xử lý chuyển hướng dựa trên tham số URL
function handleUrlParams() {
    var name = getUrlParameter('name');
    var page = getUrlParameter('page');

    if (name !== '') {
        if(name==='static'){
            loadContent('admin_static.php');
        }
        else{
            showContent(name,page);
        }
    }
}

// Gọi hàm xử lý chuyển hướng khi trang được tải
window.onload = function() {
    handleUrlParams();
};

// Hiện trang thống kê
function loadContent(file){ 
    window.history.pushState({}, "", `?name=static`);
    fetch(file).then(response => response.text())
                .then(data => {
                    document.getElementById('content').innerHTML=data;
                })
                .catch(error => console.error('error',error));
}

//Hiện các trang khác
function showPage(name,page){
    window.history.pushState({}, "", `?name=${name}&page=${page}`);

    if (name==""){
        document.getElementById("content").innerHTML="";
        return;
    }

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET",`admin_query.php?name=${name}&page=${page}`,true);
    xmlhttp.send();
}

// hiện trang add
function openPage(name,value,id,idtable){
    var url="";
    if (value==0){
        if (name === 'room'||name==='seat_type') {
            alert("Không thể thêm.");
            return;
        }
        url='admin_add.php?name='+name;
        window.history.pushState({}, "", `?add_form`);  
    }
    else{
        window.history.pushState({}, "", `?edit_form`);
        url = 'admin_add.php?name=' + encodeURIComponent(name) + 
               '&id=' + encodeURIComponent(id) + '&idtable=' + encodeURIComponent(idtable);
    }
    
    // Sử dụng AJAX để tải nội dung của admin_add.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET', url, true);
    xhttp.send();
    
}



// kiểm tra ảnh từ input của trang add
function checkImage() {
    var fileInput = document.getElementById('image_upload');
    if (fileInput) {
        var filePath = fileInput.value;
        var extension = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();

        // Kiểm tra xem phần mở rộng có phải là .png hoặc .jpg không
        if (extension !== 'png' && extension !== 'jpg') {
            alert('Vui lòng chỉ tải lên tệp ảnh .png hoặc .jpg');
            fileInput.value = ''; // Xóa tệp đã chọn
        }
    } else {
        console.error('Không tìm thấy đối tượng với ID: image_upload');
    }
}

// kiểm tra số từ input của trang add
function checkNumber(columnName){
    var input = document.getElementById(columnName);
        if (input.value < 0) {
            input.value = 0;
        }
}

// kiểm tra sdt từ input của trang add
function checkPhone(columnName) {
    var input = document.getElementById(columnName);
    var phoneNumber = input.value;
    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    
    if (phoneNumber !== '') {
        if (vnf_regex.test(phoneNumber) == false) {
            alert('Số điện thoại của bạn không đúng định dạng!');
            input.value = ''; // Xóa nội dung của ô input
            return;
        } 
    } else {
        alert('Bạn chưa điền số điện thoại!');
        return;
    }
}

// kiểm tra email từ input của trang add
function checkEmail(columnName) {
    var input = document.getElementById(columnName);
    var email = input.value;
    // Kiểm tra định dạng email bằng biểu thức chính quy
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Địa chỉ email không hợp lệ. Vui lòng nhập lại.");
        input.value = ''; // Xóa nội dung của ô input
        return;
    }
}



// thêm dữ liệu vào database
function insertDB(tableName, e) {
    e.preventDefault();

    var formData = new FormData($('#add_form')[0]); // Sử dụng FormData để lấy dữ liệu từ form

    formData.append('tableName', tableName); // Thêm tên bảng vào formData

    $.ajax({
        type: 'POST',
        url: 'query.php',
        data: formData, // Truyền formData 
        processData: false, // Không xử lý dữ liệu
        contentType: false, // Không đặt loại nội dung
        success: function(response) {
            console.log(response);
            $('#add_form')[0].reset(); // Đặt lại form sau khi gửi thành công
            alert("Dữ liệu đã được chèn thành công!");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("Đã xảy ra lỗi khi chèn dữ liệu.");
        }
    });
}

// function insertDB(tableName, e) {
//     e.preventDefault();

//     var formData = {}; // Khởi tạo đối tượng JSON để chứa dữ liệu từ biểu mẫu

//     // Thu thập dữ liệu từ các trường của biểu mẫu và thêm vào đối tượng JSON
//     $('#add_form').find('input, select').each(function(index, element) {
//         var fieldName = $(element).attr('name');
//         var fieldValue = $(element).val();
//         formData[fieldName] = fieldValue;
//     });

//     formData['tableName'] = tableName; // Thêm tên bảng vào đối tượng JSON

//     $.ajax({
//         type: 'POST',
//         url: 'query.php',
//         data: JSON.stringify(formData), // Chuyển đối tượng JSON thành chuỗi JSON
//         processData: false, // Không xử lý dữ liệu
//         contentType: 'application/json', // Đặt loại nội dung là JSON
//         success: function(response) {
//             console.log(response);
//             $('#add_form')[0].reset(); // Đặt lại form sau khi gửi thành công
//             alert("Dữ liệu đã được chèn thành công!");
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//             alert("Đã xảy ra lỗi khi chèn dữ liệu.");
//         }
//     });
// }


//cập nhật, sửa 
function updateDB(tableName,id,idtable, e){
    e.preventDefault();
    var formData = new FormData($('#edit_form')[0]); // Sử dụng FormData để lấy dữ liệu từ form
    formData.append('tableName', tableName); // Thêm tên bảng vào formData
    formData.append('id',id);
    formData.append('idtable',idtable);
    $.ajax({
        type: 'POST',
        url: 'update_query.php',
        data: formData, // Truyền formData 
        processData: false, // Không xử lý dữ liệu
        contentType: false, // Không đặt loại nội dung
        success: function(response) {
            console.log(response);
            //$('#edit_form')[0].reset(); // Đặt lại form sau khi gửi thành công
            alert("Dữ liệu đã được chèn thành công!");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("Đã xảy ra lỗi khi chèn dữ liệu.");
        }
    });
}


// xóa 
function deleteDB(name, value,columnName){
    // alert(name + value);
    // alert(columnName);
    if (confirm("Are you sure you want to delete this record?")) {
        // Gửi yêu cầu AJAX đến máy chủ để xóa bản ghi
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_query.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Xử lý phản hồi từ máy chủ nếu cần
                alert(xhr.responseText); // Hiển thị thông báo từ máy chủ
                // Sau khi xóa thành công, có thể thực hiện cập nhật giao diện người dùng
            }
        };
        xhr.send("name=" + encodeURIComponent(name) + "&value=" + encodeURIComponent(value)+"&columnName="+ encodeURIComponent(columnName));
    }
    showContent(name,1);
}
