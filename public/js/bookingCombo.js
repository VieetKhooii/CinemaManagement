function hideCombo() {
    var combo_info = document.querySelector('.combo_info');
    combo_info.style.display = 'none';
}

function showCombo(combo_choosed, description) {
    var combo_info = document.querySelector('.combo_info');
    combo_info.style.display = 'block';
    var name_combo = combo_choosed.querySelector('.combo_txt');
    var price_combo = combo_choosed.querySelector('.price em');

    combo_info.innerHTML = `
        <div class="header_combo_info">
            <h1 class="combo_title">${name_combo.innerText}</h1>
            <h1 class="exit_combo" onclick="hideCombo()">X</h1>
        </div>
        <dl class="info_scroll">
            <table>
                <tr>
                    <th>Nội dung sản phẩm</th>
                    <td>${description}</td>
                </tr>
                <tr>
                    <th>Số lượng mua tối thiểu</th>
                    <td>Không giới hạn</td>
                </tr>
                <tr>
                    <th>Hạn sử dụng sản phẩm</th>
                    <td>★ 30 ngày sau khi mua</td>
                </tr>
                <tr>
                    <th>Giải thích</th>
                    <td>Combo ${name_combo.innerText}, bao gồm ${description}. Voucher không hỗ trợ đổi trả và hoàn tiền.</td>
                </tr>
            </table>
        </dl>
        <div class="price_combo">
            <span class="price">Thành tiền: <em>${price_combo.innerText}</em><span>₫</span></span>
        </div>
        <button id="add_combo" onclick="addToCart()"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng</button>`;

}
//ẩn combo
function hidden_combo(event,element){
    event.preventDefault();
    var combo_exit=element.parentNode.parentNode
    combo_exit.remove()
    console.log(combo_exit)
}

// Hàm thêm một mục vào giỏ hàng
function addToCart() {
    // Lấy thông tin của combo đã chọn
    var combo_info = document.getElementById('combo_info_chosen')
    var name_combo = document.querySelector('.combo_title');
    var price_combo = document.querySelector('.price_combo em');
    combo_info.innerHTML = combo_info.innerHTML +
        `<div class="combo_chosen">
            <div class="title_left">
                <div id="selected_combo_name">${name_combo.innerText}</div>
            </div>
            <div class="title_right" style="text-align:right">
                <span class="price" id="selected_combo_price">${price_combo.innerText}</span>
            </div>
            <div class="exit_combo"><a href="#" onclick="hidden_combo(event,this)"><i class="fa-solid fa-square-xmark"></i></a></div>
        </div>`;
    var price_total = 0
    var combo_item = combo_info.querySelectorAll('.combo_chosen')
    combo_item.forEach(function (item) {
        var price = item.querySelector('.title_right #selected_combo_price')
        // console.log(price)
        price_total = price_total + parseInt(price.innerText)
    })
    var formatted_price_total = price_total.toLocaleString('vi-VN');

    document.querySelector('.bill_total .title_right .price_total_combo em').innerText = formatted_price_total

}


