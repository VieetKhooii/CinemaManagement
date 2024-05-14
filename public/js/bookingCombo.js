function hideCombo() {
    var combo_info = document.querySelector('.combo_info');
    combo_info.style.display = 'none';
}

function showCombo(combo_choosed, description) {
    var combo_info = document.querySelector('.combo_info');
    combo_info.style.display = 'block';
    var name_combo = combo_choosed.querySelector('.combo_txt');
    var price_combo = combo_choosed.querySelector('.price em');
    var id = combo_choosed.querySelector('.id');
    combo_info.innerHTML = `
        <div class="header_combo_info">
        <input class="showId" type="hidden" value="${id.value}"></input>
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

function getComboInfo() {
    var combo_info = document.querySelector('.combo_info');
    return {
        id: combo_info.querySelector(".showId").value,
        name: combo_info.querySelector(".combo_title").innerText,
        price: combo_info.querySelector(".price_combo em").innerText,
    };
}

// Hàm thêm một mục vào giỏ hàng
function addToCart() {
    var comboInfo = getComboInfo()
    var hiddenInput = document.getElementById('listOfCombos');

    // Parse the current value of the hidden input field (assume it's a JSON string)
    var currentCombos = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

    // Add the new combo information
    currentCombos.push(comboInfo);

    // Update the hidden input field with the new list of combos
    hiddenInput.value = JSON.stringify(currentCombos);
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
    var totalMovieAndSeat = document.querySelector('.bill_total .title_right .price_ticket em').innerText;
    var totalMovieAndSeatInt = parseInt(totalMovieAndSeat.replace(/,/g, ''));
    var grandTotal = price_total + totalMovieAndSeatInt;
    var formattedGrandTotal = grandTotal.toLocaleString('vi-VN');
    document.querySelector('.bill_total .title_right .price_combo_info em').innerText = formatted_price_total
    document.querySelector('.price_total_combo em').innerText = formattedGrandTotal
}


