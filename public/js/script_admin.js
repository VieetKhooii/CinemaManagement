//đánh dấu bảng đang hiện
function showContent(page, file) {
    var buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Đánh dấu nút hiện tại
    var currentButton = document.getElementById(page).querySelector('button');
    currentButton.classList.add('active');

    if (page !== "static") {
        showPage(page, file);
    }
    else {
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
        if (name === 'static') {
            loadContent('admin_static');
        }
        else {
            showContent(name, page);
        }
    }
}

// Gọi hàm xử lý chuyển hướng khi trang được tải
window.onload = function () {
    handleUrlParams();
};

// Hiện trang thống kê
function loadContent(file) {
    window.history.pushState({}, "", `?name=static`);
    fetch(file).then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            var script = document.createElement('script')
            script.src = 'js/script_statistic.js';
            document.body.appendChild(script)
        })
        .catch(error => console.error('error', error));
}

//Hiện các trang khác
function showPage(name, page) {
    window.history.pushState({}, "", `?${name}&page=${page}`);
    url = 'http://localhost:8000/' + name + '?page=' + page;
    console.log(url)
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            if (data.status === 'success') {
                const message1 = data.data.data;
                const total = data.last_page;
                const current_page = data.data.current_page;
                const message = Array.isArray(message1) && message1.length === 0 ? "" : message1;

                $.ajax({
                    type: 'POST',
                    url: '/admin/query',

                    data: { message: message, name: name, total: total, current_page: current_page }, // Pass the message data to PHP
                    success: function (response) {
                        $('#content').html(response);
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            var responseJSON = xhr.responseJSON;
                            if (responseJSON && responseJSON.error) {
                                alert(responseJSON.error);
                            } else {
                                alert('Validation error occurred.');
                            }
                        } else {
                            console.error('AJAX request failed:', status, error);
                        }
                    }
                });
            }
        },
        error: function (xhr, status, error) {
            // console.error(xhr.responseText);
            alert("Session has expired! Please Provide credential");
            location.reload(true);
        }
    });
}

// hiện trang add
function openPage(name, value, id, idtable) {
    var url = "";
    // Thêm
    if (value == 0) {
        if (name === 'rooms' || name === 'seatTypes' || name === 'roles' || name === 'categories' ||
            name === 'seats' || name === 'reservations' || name === 'transactions') {
            alert("Không thể thêm.");
            return;
        }
        url = '/admin/add?name=' + name;
        window.history.pushState({}, "", `?add_form`);
    }

    // chỉnh sửa
    else {
        if (name === 'reservations' || name === 'transactions') {
            alert("Không thể chỉnh sửa.");
            return;
        }
        window.history.pushState({}, "", `?edit_form`);
        tableInfo = '';
        idName = '';
        url = '/admin/edit?name=' + encodeURIComponent(name) +
            '&id=' + encodeURIComponent(id) + '&idtable=' + encodeURIComponent(idtable);
        url1 = 'http://localhost:8000/' + name + '/search';
        console.log(url1)
        $.ajax({
            type: 'POST',
            data: {
                [idtable]: id
            },
            url: url1,
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data.status === 'success') {
                    const message1 = data.data;
                    const message = Array.isArray(message1) && message1.length === 0 ? "" : message1;
                    tableInfo = message;
                    url += '&tableInfo=' + JSON.stringify(tableInfo);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Error enter edit");
            }
        });
    }
    // Sử dụng AJAX để tải nội dung của admin_add.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    };
    console.log(url)
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
function checkNumber(columnName) {
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

function logout() {
    $.ajax({
      method: 'GET',
      url: 'http://localhost:8000/logout',
      async: false,
      success: function (data) {
        if (data.status == 'success') {
            window.location.replace('/login');
        }
        else {
          alert(data.message)
        }
      }
    });
  }

// thêm dữ liệu vào database
function insertDB(tableName, e) {
    e.preventDefault();
    url = 'http://localhost:8000/' + tableName;
    console.log(url);
    var formData = new FormData($('#add_form')[0]); // Sử dụng FormData để lấy dữ liệu từ form
    // formData.append('image', $('#add_form input[type="file"]')[0].files[0]); // Thêm tên bảng vào formData
    console.log(formData)
    $.ajax({
        type: 'POST',
        url: url,
        data: formData, // Truyền formData 
        processData: false,
        contentType: false,
        success: function (response) {
            $('#add_form')[0].reset(); // Đặt lại form sau khi gửi thành công
            iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'topRight'
            });
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                var responseJSON = xhr.responseJSON;
                if (responseJSON && responseJSON.error) {
                    iziToast.error({
                        title: 'Error',
                        message: responseJSON.error,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'Validation error occurred.',
                        position: 'topRight'
                    });
                }
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'AJAX request failed:', status, error,
                    position: 'topRight'
                });
            }
        }
    });
}
let sortDirection = 'asc';

function sortTable(column) {
    const table = document.getElementById('table_query');
    const rows = Array.from(table.rows).slice(1);
    const sortedRows = rows.sort((a, b) => {
        // const aText = a.querySelector(`td:nth-child(${column + 1})`).innerText;
        const aText=a.cells[column].innerText;
        // const bText = b.querySelector(`td:nth-child(${column + 1})`).innerText;
        const bText=b.cells[column].innerText;

        // if (aText < bText) {
        if(!isNaN(aText)&& !isNaN(bText)){
            // return sortDirection === 'asc' ? -1 : 1;
            return sortDirection === 'asc' ? aText - bText : bText - aText;
        }
        if (aText > bText) {
            // return sortDirection === 'asc' ? 1 : -1;
            return sortDirection === 'asc' ? aText.localeCompare(bText) : bText.localeCompare(aText) ;
        }
        // return 0;
    });

    sortedRows.forEach(row => table.appendChild(row));

    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
    document.querySelectorAll('.sort-arrow').forEach(arrow => arrow.innerHTML = '&#x25B2;');
    document.querySelector(`th:nth-child(${column + 1}) .sort-arrow`).innerHTML = sortDirection === 'asc' ? '&#x25B2;' : '&#x25BC;';
}
//cập nhật, sửa 
function updateDB(tableName, id, idtable, e) {
    e.preventDefault();
    url = 'http://localhost:8000/' + tableName + '/' + id;
    console.log(url);

    // var formData = new FormData($('#edit_form')[0]); // Sử dụng FormData để lấy dữ liệu từ form
    // formData.append('tableName', tableName); // Thêm tên bảng vào formData
    var formData = $('#edit_form').serialize();
    console.log(formData)
    $.ajax({
        type: 'PUT',
        url: url,
        data: formData, // Truyền formData 
        // processData: false, // Không xử lý dữ liệu
        success: function (response) {
            // $('#add_form')[0].reset(); // Đặt lại form sau khi gửi thành công
            alert("Dữ liệu đã được sửa thành công!");
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                var responseJSON = xhr.responseJSON;
                if (responseJSON && responseJSON.error) {
                    iziToast.error({
                        title: 'Error',
                        message: responseJSON.error,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'Validation error occurred.',
                        position: 'topRight'
                    });
                }
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'AJAX request failed:', status, error,
                    position: 'topRight'
                });
            }
        }
    });
}


// xóa 
function deleteDB(tableName, value) {
    var result = confirm("Bạn có chắc chắn muốn thực hiện hành động này?");
    if (result){
        url = 'http://localhost:8000/' + tableName + '/hide/' + value;
    console.log(url);
    $.ajax({
        type: 'PUT',
        url: url,
        // processData: false, // Không xử lý dữ liệu
        success: function (response) {
            // $('#add_form')[0].reset(); // Đặt lại form sau khi gửi thành công
            iziToast.success({
                title: 'Success',
                message: 'Xóa thành công!',
                position: 'topRight'
            });
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                var responseJSON = xhr.responseJSON;
                if (responseJSON && responseJSON.error) {
                    iziToast.error({
                        title: 'Error',
                        message: responseJSON.error,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'Validation error occurred.',
                        position: 'topRight'
                    });
                }
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'AJAX request failed:', status, error,
                    position: 'topRight'
                });
            }
        }
    });
    }
}