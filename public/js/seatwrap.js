var isUlDisplayed = false; // biến kiển tra load hay hidden
function loadPerson(event, elementClick) {
    event.preventDefault();
    var ulElement = elementClick.nextElementSibling;
    if (!isUlDisplayed) {
        ulElement.style.display = "block";
        var listli = ulElement.querySelectorAll('li');
        var delay = 30;//thời gian hiện từng li
        listli.forEach((li, index) => {
            setTimeout(() => {
                li.style.opacity = 1;
            }, delay * (index + 1));
        });
        isUlDisplayed = true; //đã load
        hiddenFocus(elementClick)
        disabledGet()
    } else {
        hiddenPeson(event, elementClick); // Nếu ul đã hiển thị, gọi hàm ẩn ul
        isUlDisplayed = false;
    }

}
function reloadDOMContentLoaded() {
    document.dispatchEvent(new Event('DOMContentLoaded'));
}
function hiddenPeson(event, elementClick) {
    event.preventDefault();
    var ulElementFocus = elementClick.nextElementSibling;
    var listlifocus = ulElementFocus.querySelectorAll('li');
    var delay = 30;
    var completedCount = 0; // Biến để đếm số lượng phần tử đã hoàn thành hiệu ứng
    for (var i = listlifocus.length - 1; i >= 0; i--) {
        (function (index) {
            setTimeout(() => {
                listlifocus[index].style.opacity = 0;
                completedCount++;
                if (completedCount === listlifocus.length) {
                    ulElementFocus.style.display = "none";
                }
            }, delay * (listlifocus.length - index));
        })(i);
    }
}


function hiddenFocus(elementFocus) {
    var seatbox = elementFocus.parentNode;
    seatbox.addEventListener('mouseleave', function (event) {
        hiddenPeson(event, elementFocus);
        isUlDisplayed = false;
    });
}
var disabled1 = "";
var disabled2 = "";
var disabled3 = "";
var disabled4 = "";

function disabledGet(){
    disabled1 = document.querySelector(' .container_seat .seatwrap .seatarea .seatbox .seat_bottom .seatset .seat_setting .per1 #per1')
    disabled2 = document.querySelector(' .container_seat .seatwrap .seatarea .seatbox .seat_bottom .seatset .seat_setting .per2 #per2')
    disabled3 = document.querySelector(' .container_seat .seatwrap .seatarea .seatbox .seat_bottom .seatset .seat_setting .per3 #per3')
    disabled4 = document.querySelector(' .container_seat .seatwrap .seatarea .seatbox .seat_bottom .seatset .seat_setting .per4 #per4')
    onPageLoad();
    checkSeatLoad();

}

var changeElement_a
var sumText;
function addnum(event, elementText) {
    event.preventDefault();
    var parentUl = elementText.parentNode.parentNode;
    var targetAnchor = parentUl.previousElementSibling;
    targetAnchor.innerText = elementText.innerText;
    changeElement_a = targetAnchor;
    targetAnchor.insertAdjacentHTML('beforeend', '<i class="fa-solid fa-chevron-down"></i>');
    // console.log(targetAnchor.innerText)
    hiddenPeson(event, targetAnchor);
    isUlDisplayed = false;
    var SumPersonChoose = document.querySelectorAll('.select_box>a');
    sumText = 0
    SumPersonChoose.forEach(function (sum) {
        sumText += parseInt(sum.innerText);
    });
    show_seat(sumText);
    // console.log(sumText);
    removeChosenSeats(); // Gọi hàm xóa các ghế đã chọn
    checkCoupLoad();
    checkSeatLoad()
}

function removeChosenSeats() {
    seatToBill = []
    document.querySelector('.info_ticket .title_right .seat_chosen').innerHTML = ''
    var chosenSeats = document.querySelectorAll('.choosen');
    chosenSeats.forEach(function (seat) {
        seat.classList.remove('choosen');
    });
}

var pair_of_seat = [];// Mảng chứa cặp ghế
var showDisabled1;
var showDisabled2;
var showDisabled3;
var showDisabled4;
function show_seat(sumText) {
    var seat = [2, 3, 4]; // Ghế 2, 3, 4
    pair_of_seat = [];
    showDisabled1 = true;
    showDisabled2 = true;
    showDisabled3 = true;
    showDisabled4 = true;
    if (parseInt(sumText) === 1) {
        // Xử lý khi tổng là 1
        showDisabled1 = false
        disabledSeat(showDisabled1, showDisabled2, showDisabled3, showDisabled4)
    } else if (parseInt(sumText) <= 8) {
        var capso_count = 1; // Biến đếm cặp ghế
        for (var i = 0; i < seat.length; i++) {
            var remainder = sumText % seat[i];//số dư
            var count = (sumText - remainder) / seat[i];//số lần của seat[i] count 2
            if (count !== 0) {
                if (remainder === 1) {
                    var tempSum = sumText
                    if (count > 1) {
                        for (var j = count - 1; j > 0; j--) {//j=1
                            for (var k = 0; k < seat.length; k++) {
                                if (seat[i] * j + seat[k] === tempSum) {
                                    pair_of_seat.push({ soghe: seat[i], solan: j, capso: capso_count });
                                    pair_of_seat.push({ soghe: seat[k], solan: 1, capso: capso_count });
                                    capso_count++;
                                }
                            }
                        }
                    }
                    // console.log('check: ' + seat[i]+" + "+ remainder)
                } else if (remainder === 0) {
                    pair_of_seat.push({ soghe: seat[i], solan: count, capso: capso_count });
                    capso_count++;
                } else if (remainder === 2 || remainder === 3) {
                    pair_of_seat.push({ soghe: seat[i], solan: count, capso: capso_count });
                    pair_of_seat.push({ soghe: remainder, solan: 1, capso: capso_count });
                    capso_count++;
                }
            }
        }
        load_pair()
    } else {
        var message = document.querySelector('.container_message')
        message.style.display = 'flex'
        var focusedLinks = document.querySelectorAll('.seatbox .pesonselect .select_box>a');
        focusedLinks.forEach(function (link) {
            link.innerText = 0
            link.insertAdjacentHTML('beforeend', '<i class="fa-solid fa-chevron-down"></i>');

        });
    }
    //truyền vào giá trị ghế nào sẻ hiện lên ********* true là ẩn; false là hiện*****

    // console.log(pair_of_seat);
}
function load_pair() {
    showDisabled1 = true;
    showDisabled2 = true;
    showDisabled3 = true;
    showDisabled4 = true;
    // console.log(pair_of_seat)
    pair_of_seat.forEach(function (pair) {
        // console.log('soghe: ' + pair.soghe)
        if (pair.soghe === 1) {
            showDisabled1 = false;
        } else if (pair.soghe === 2) {
            showDisabled2 = false;
        } else if (pair.soghe === 3) {
            showDisabled3 = false;
        } else if (pair.soghe === 4) {
            showDisabled4 = false;
        }
    });
    disabledSeat(showDisabled1, showDisabled2, showDisabled3, showDisabled4)
}
function disabledSeat(showDisabled1, showDisabled2, showDisabled3, showDisabled4) {
    var show_seat = [showDisabled1, showDisabled2, showDisabled3, showDisabled4]
    var disabled_seat = [disabled1, disabled2, disabled3, disabled4]
    var oneChecked = false;
    console.log(disabled_seat)
    disabled_seat.forEach(function (disabledSeat, index) {
        
        disabledSeat.disabled = show_seat[index]
        var parentdisabledSeat = disabledSeat.parentNode
        if (show_seat[index] === true) {
            disabledSeat.checked = false
            parentdisabledSeat.style.backgroundPosition = "22px 4px";
        } else {
            // console.log(show_seat[index])
            if (!oneChecked) {
                disabledSeat.checked = true; // Đặt checked = true cho input đầu tiên
                oneChecked = true;
            }
            parentdisabledSeat.style.backgroundPosition = "22px -24px";
        }
    });
}


function hidden_message() {
    var message = document.querySelector('.container_message')
    message.style.display = 'none'
}
function show_detail_ticket() {
    var show_detail_ticket = document.querySelector('.show_detail_ticket');
    show_detail_ticket.style.display = 'block'
    fetch('detail_ticket')
        .then(response => response.text())
        .then(data => {
            show_detail_ticket.innerHTML = data;
        })
        .catch(error => console.error('Error fetching data:', error));
}

function reset_seatwrap() {
    var select_boxes = document.querySelectorAll('.personselect .select_box');
    select_boxes.forEach(function (select_box) {
        var a_default = select_box.querySelector('.personList li a');
        if (a_default) {
            a_default.click();//gọi hàm addnum trong thẻ a
        }
    });
}

function reset_chossen() {
    var select_boxes = document.querySelectorAll('.personselect .select_box');
    select_boxes.forEach(function (select_box) {
        var aDefault = select_box.querySelector('a');
        var aclick = select_box.querySelectorAll('.personList>li>a');
        aclick.forEach(function (click) {
            if (click.textContent.trim() === aDefault.textContent.trim()) {
                click.click();
            }
        });
    });
}
// *****************************************************Hover seats*************************************************
function checkCoupLoad() {
    var checkedCoup = document.querySelector('.seat_setting input[type="radio"]:checked');
    if (checkedCoup) {
        var checkedCoupValue = parseInt(checkedCoup.value);
        document.querySelectorAll('.couple_seat').forEach(function (seat) {
            if (checkedCoupValue === 2) {
                seat.classList.remove('enough_seats');
            } else {
                seat.classList.add('enough_seats');
            }
        });
    }
}
var seatToBill = []
function checkSeatLoad() {
    var numSelectedSeats;
    var seatRows = document.querySelectorAll('.seat_Barea .seat ul');
    seatRows.forEach(function (seatRow) {
        var checkedInputCoup = document.querySelector('.seat_setting input[type="radio"]:checked');
        if (checkedInputCoup) {
            numSelectedSeats = parseInt(checkedInputCoup.value);
            var areaSeat = ['left', 'middle', 'right']
            areaSeat.forEach(function (area) {
                var areaSeats = seatRow.querySelectorAll('.normal_seat.' + area + ', .vip_seat.' + area);
                if (areaSeats.length < numSelectedSeats){
                    areaSeats.forEach(function(area){
                        // console.log(area)
                        area.classList.add('enough_seats');
                    })
                }else{
                    areaSeats.forEach(function(area){
                        area.classList.remove('enough_seats');
                    })
                }
                // console.log(areaSeats.length)
            })
        }
    })
}
loadContentSeatWrap()
// document.addEventListener('DOMContentLoaded', function () {
function loadContentSeatWrap(){
    // alert('lo')
    onPageLoad(); // Gọi hàm xử lý khi trang được tải
    checkSeatLoad()
    function onPageLoad() {
        var seatSelectInputs = document.querySelectorAll('.seat_setting input[type="radio"]');
        seatSelectInputs.forEach(function (input) {
            input.addEventListener('change', function (event) {
                checkCoupLoad();
                checkSeatLoad()
                document.querySelectorAll('.normal_seat, .vip_seat').forEach(function (seat) {
                    seat.classList.remove('selected');
                });
            });
        });

        var seatRows = document.querySelectorAll('.seat_Barea .seat ul');
        seatRows.forEach(function (seatRow) {
            var seatsInRow = seatRow.querySelectorAll('.normal_seat, .vip_seat');
            var seatsInRowCoup = seatRow.querySelectorAll('.couple_seat')
            var { leftSeats, middleSeats, rightSeats } = classifySeats(seatsInRow);
            // Gọi trực tiếp hàm xử lý khi con chuột di vào hàng đầu tiên
            addClassToSeats(leftSeats, 'left');
            addClassToSeats(middleSeats, 'middle');
            addClassToSeats(rightSeats, 'right');
            addLeaveEventToSeats(leftSeats);
            addLeaveEventToSeatsCoup(seatsInRowCoup);
            addLeaveEventToSeats(middleSeats);
            addLeaveEventToSeats(rightSeats);
            //add class cho dãy coup
            addClassToSeatsCoup(seatsInRowCoup);
        });
    }

    function addClassToSeatsCoup(seatsInRowCoup) {
        var numSelectedSeats
        seatsInRowCoup.forEach(function (seat) {
            seat.addEventListener('mouseenter', function (event) {
                var checkedInputCoup = document.querySelector('.seat_setting input[type="radio"]:checked');
                if (checkedInputCoup) {
                    numSelectedSeats = parseInt(checkedInputCoup.value);
                    if (numSelectedSeats === 2) {
                        document.querySelectorAll('.couple_seat.selected').forEach(function (seat) {
                            seat.classList.remove('selected');
                        });
                        var startIndex;
                        var endIndex;
                        if (seat.id === 'column_seat_coup') {
                            startIndex = Array.from(seatsInRowCoup).indexOf(seat);
                            endIndex = startIndex - 1
                            for (var i = startIndex; i >= endIndex; i--) {
                                seatsInRowCoup[i].classList.add('selected')
                            }
                        } else {
                            startIndex = Array.from(seatsInRowCoup).indexOf(seat);
                            endIndex = startIndex + 1
                            for (var i = startIndex; i <= endIndex; i++) {
seatsInRowCoup[i].classList.add('selected')
                            }
                        }
                    }
                }
            })
            seat.onclick = function () {
                var seatRow = seat.closest('.seat_Barea .seat ul');
                var selectedSeats = seatRow.querySelectorAll('.selected');
                // Nếu có ghế đã chọn, thêm lớp 'choosen'
                if (selectedSeats.length > 0) {
                    selectedSeats.forEach(function (selectedSeat) {
                        selectedSeat.classList.add('choosen');
                        seatToBill.push(selectedSeat)
                    });
                    removeUnnecessarySeats(numSelectedSeats);
                    var seatRowsSelected = document.querySelectorAll('.seat_Barea .seat ul');
                    var sumSelectedSeats = 0;
                    seatRowsSelected.forEach(function (seatRowSelected) {
                        var selectedSeatsInRow = seatRowSelected.querySelectorAll('.choosen');
                        selectedSeatsInRow.forEach(function () {
                            sumSelectedSeats++;
                        });
                    });
                    // Kiểm tra nếu tổng số ghế đã chọn của các dãy bằng sumText thì ẩn tất cả các input
                    if (sumSelectedSeats === sumText) {
                        disabledSeat(true, true, true, true);
                    }
                    // console.log('sumSelectedSeats: ' + sumSelectedSeats)
                    // console.log('sumText: ' + sumText)
                    addSeatToBill(seatToBill)
                }
            }
        });
    }
    function addClassToSeats(seats, className) {
        var numSelectedSeats
        seats.forEach(function (seat) {
            seat.classList.add(className);
            seat.addEventListener('mouseenter', function (event) {
                // Kiểm tra nếu ghế có class 'choosen' thì không thực hiện hành động
                if (!seat.classList.contains('choosen')) {
                    var checkedInput = document.querySelector('.seat_setting input[type="radio"]:checked');
                    if (checkedInput) {
                        numSelectedSeats = parseInt(checkedInput.value);
                        var seatRow = seat.closest('.seat ul');
                        // var seatArea = seatRow.querySelectorAll('.choosen.' + className)
                        var chosenSeatsCount = seatRow.querySelectorAll('.choosen.' + className).length;
                        if (numSelectedSeats <= seats.length - chosenSeatsCount) {
                            document.querySelectorAll('.normal_seat.selected, .vip_seat.selected').forEach(function (seat) {
                                seat.classList.remove('selected');
                            });
                            var startIndex = Array.from(seats).indexOf(seat);
var endIndex = startIndex + numSelectedSeats - 1;
                            var seatNumchoose = 0;
                            var arraySeatselected = []
                            // console.log('startIndex: '+startIndex)
                            // console.log('endIndex: '+endIndex)
                            var check = false;
                            if (endIndex >= seats.length) {
                                for (var i = startIndex; i <= endIndex && i < seats.length; i++) {
                                    seatNumchoose++;
                                    arraySeatselected.push(seats[i])
                                }
                                // console.log(arraySeatselected.length)
                                // console.log('seatNumchoose: ' + (seats.length - numSelectedSeats))
                                for (var i = seats.length - seatNumchoose - 1; i >= seats.length - numSelectedSeats; i--) {
                                    if (seats[i].classList.contains('choosen')) {
                                        break;
                                    } else {
                                        arraySeatselected.push(seats[i])
                                    }
                                }
                                // console.log(arraySeatselected.length)
                                if (arraySeatselected.length === numSelectedSeats) {
                                    arraySeatselected.forEach(function (seat) {
                                        seat.classList.add('selected');
                                    });
                                }
                            } else {
                                for (var i = startIndex; i <= endIndex && i < seats.length; i++) {
                                    if (seats[i].classList.contains('choosen')) {
                                        check = true;
                                        break;
                                    } else {
                                        seatNumchoose++;
                                        arraySeatselected.push(seats[i])
                                    }
                                }
                                if (check) {
                                    for (var i = startIndex - seatNumchoose; i >= 0; i--) {
                                        if (seatNumchoose === numSelectedSeats) {
                                            break;
                                        }
                                        seatNumchoose++;
                                        arraySeatselected.push(seats[i])
                                    }
                                }
                                if (arraySeatselected.length === numSelectedSeats) {
                                    arraySeatselected.forEach(function (seat) {
seat.classList.add('selected');
                                    });
                                }
                            }
                        }
                    }
                }
            });
            seat.onclick = function () {
                var seatRow = seat.closest('.seat_Barea .seat ul');
                var selectedSeats = seatRow.querySelectorAll('.selected');
                // Nếu có ghế đã chọn, thêm lớp 'choosen'
                if (selectedSeats.length > 0) {
                    selectedSeats.forEach(function (selectedSeat) {
                        selectedSeat.classList.add('choosen');
                        seatToBill.push(selectedSeat)
                    });
                    removeUnnecessarySeats(numSelectedSeats);
                    var seatRowsSelected = document.querySelectorAll('.seat_Barea .seat ul');
                    var sumSelectedSeats = 0;
                    seatRowsSelected.forEach(function (seatRowSelected) {
                        var selectedSeatsInRow = seatRowSelected.querySelectorAll('.choosen');
                        selectedSeatsInRow.forEach(function () {
                            sumSelectedSeats++;
                        });
                    });
                    // Kiểm tra nếu tổng số ghế đã chọn của các dãy bằng sumText thì ẩn tất cả các input
                    if (sumSelectedSeats === sumText) {
                        disabledSeat(true, true, true, true);
                    }
                    addSeatToBill(seatToBill)
                    // console.log('sumSelectedSeats: ' + sumSelectedSeats)
                    // console.log('sumText: ' + sumText)
                }

            }
        });
    }

    function addSeatToBill(seatToBill) {
        // console.log(seatToBill)
        var seatbill = document.querySelector('.info_ticket .title_right .seat_chosen')
        // var seatbillOld = seatbill.querySelectorAll('.seat')
        var html = '';
        // if (seatbillOld) {
        //     seatbillOld.forEach(function (seatold) {
        //         html += seatold.outerHTML
        //     })
        // }
        seatToBill.forEach(function (seat) {
            var seatheader = seat.parentNode.querySelector('li').textContent
            var nameSeat = seatheader + seat.textContent
            html += `<div class="seat">${nameSeat}</div>`;
        })
        seatbill.innerHTML = `${html}`
    }
    // Hàm xóa các ghế không cần thiết sau khi chọn
    function removeUnnecessarySeats(num) {
        var temp = pair_of_seat.filter(function (pair) {
            return pair.soghe === num;
        });
        var capsoToKeep = [];
        temp.forEach(function (pair) {
            capsoToKeep.push(pair.capso);
        });
        pair_of_seat = pair_of_seat.filter(function (pair) {
            return capsoToKeep.some(function (capso) {
                return pair.capso === capso;
            });
});

        for (var i = 0; i < pair_of_seat.length; i++) {
            var pair = pair_of_seat[i];
            if (pair.soghe === num) {
                pair.solan -= 1;
                if (pair.solan === 0) {
                    pair_of_seat.splice(i, 1); // Loại bỏ phần tử nếu solan = 0
                    i--; // Giảm chỉ số i để không bỏ qua phần tử tiếp theo
                }
            }
        }

        load_pair()
        // console.log(pair_of_seat);
    }

    function addLeaveEventToSeats(seats) {
        seats.forEach(function (seat) {
            seat.addEventListener('mouseleave', function (event) {
                removeSelectedClass(seats);
            });
        });
    }
    function addLeaveEventToSeatsCoup(seats) {
        seats.forEach(function (seat) {
            seat.addEventListener('mouseleave', function (event) {
                removeSelectedClass(seats);
            });
        });
    }
    function removeSelectedClass(seats) {
        seats.forEach(function (seat) {
            seat.classList.remove('selected');
        });
    }

    function classifySeats(seatsInRow) {
        var leftSeats = [];
        var middleSeats = [];
        var rightSeats = [];
        var left = true;
        var middle = false;
        var right = false;

        // Phân loại các ghế vào từng khu vực
        seatsInRow.forEach(function (seat) {
            if (!seat.classList.contains('choosen')) { // Kiểm tra ghế không có class là "choosen"
                if (left) {
                    leftSeats.push(seat);
                    if (seat.id === 'column_seat_left') {
                        left = false;
                        middle = true;
                    }
                } else if (middle) {
                    if (seat.id === 'column_seat_right') {
                        right = true;
                        middle = false;
                        rightSeats.push(seat);
                    } else {
                        middleSeats.push(seat);
                    }
                } else {
                    rightSeats.push(seat);
                }
            }
        });
        return { leftSeats, middleSeats, rightSeats };
    }
// });
}