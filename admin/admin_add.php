<link rel="stylesheet" href="style_admin.css">

<?php
include("connect.php"); // Kết nối cơ sở dữ liệu

// Kiểm tra nếu tham số 'name' đã được gửi
if (isset($_GET['name'])) {
    $tableName = $_GET['name'];
    $count = "SELECT COUNT(*) AS total_rows FROM $tableName";
    // Thực thi truy vấn
    $resultCount = mysqli_query($conn, $count);
    // Lấy kết quả từ truy vấn
    $row = mysqli_fetch_assoc($resultCount);
    // Số dòng trong bảng
    $totalRows = (int)$row['total_rows']+1;
    // Lấy ngày hiện tại và chuyển đổi thành chuỗi
    $currentDate = date('dmy'); // Định dạng là 'Ngày-Tháng-Năm' (2 số)
    //Gán 0
    $string='';
    //Gán mã cho id
    $codeTable='';
    //cột truy xuất combobox
    $nameTextCombobox='none';
    //tên bảng truy xuất combobox
    $tabelTextCombobox='none';
    //gán mã 0
    if ($totalRows<10){     
        if($tableName==='reservation'||$tableName==='transactions'){
            $string='000';
        }else{
            $string='00';
        }
    }
    else if($totalRows>=10&&$totalRows<100){
        if($tableName==='reservation'||$tableName==='transactions'){
            $string='00';
        }else{
            $string='0';
        }
    }
    else if($totalRows>=100&&$totalRows<1000){
        $string='0';
    }else{
        $string='';
    } 
    //gán mã của table và gán các cột, tên bảng
    if ($tableName==='combo'){
        $codeTable='BN';
    }
    else if ($tableName==='movie'){
        $codeTable='MV';
        $nameTextCombobox='category_name';
        $tabelTextCombobox='category';
    }
    else if ($tableName==='showtime'){
        $codeTable='ST';
        $nameTextCombobox='movie_name';
        $tabelTextCombobox='movie';
    }
    else if ($tableName==='transactions'){
        $codeTable='TRA';
    }
    else if ($tableName==='reservation'){
        $codeTable='RE';
    }
    elseif ($tableName == 'users') {
        $nameTextCombobox='role_name';
        $tabelTextCombobox='roles';
    }
    //nếu có id, idtable thì chuyển sang edit
    if (isset($_GET['id']) && isset($_GET['idtable'])){
        $id=$_GET['id'];
        $idtable=$_GET['idtable'];
        $query="SELECT * FROM $tableName WHERE $idtable='$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<button id='back-btn' onclick=\"showPage('$tableName',1)\">Back</button>";
            echo "<div id='admin_add'>";
            echo "<form id='edit_form' enctype='multipart/form-data'>"; // Đặt id form là 'edit_form'
            echo"<input type='hidden' name='tableName' value='<?php echo $tableName; ?>'> ";
            // Hiển thị các trường và giá trị đã lấy được từ cơ sở dữ liệu
            $row = mysqli_fetch_assoc($result);
            foreach ($row as $columnName => $value) {
                echo "<div id='label_add'>";
                echo "<label for='$columnName'>$columnName:</label>";
                echo "</div>";
                echo "<div id='input_add'>";
                //cột khóa chính
                if ($columnName == $idtable){
                    echo "<input type='text' value='$value' readonly>";
                }
                // Kiểm tra nếu cột chứa "id"  mà không phải khóa chính
                else if (strpos($columnName, 'id') !== false ) {
                    echo "<select id='$columnName' name='$columnName'>";
                    // Thực hiện truy vấn để lấy dữ liệu cho combobox
                    // Lấy dữ liệu từ các bảng khác nhau dựa vào tên cột
                    if ($tableName == 'seat') {
                        if($columnName=='seat_type_id'){
                            $nameTextCombobox='type';
                            $tabelTextCombobox='seat_type';
                        }
                        elseif($columnName=='room_id'){
                            $nameTextCombobox='room_name';
                            $tabelTextCombobox='room';
                        }
                    }   
                    else if ($tableName=='transactions'){
                        if($columnName=='user_id'){
                            $nameTextCombobox='full_name';
                            $tabelTextCombobox='users';
                        }
                        elseif($columnName=='voucher_id'){
                            $nameTextCombobox='voucher_discount';
                            $tabelTextCombobox='voucher';
                        }
                    }
                    else if ($tableName=='reservation'){
                        if($columnName=='showtime_id'){
                            $nameTextCombobox='movie_id';
                            $tabelTextCombobox='showtime';
                        }
                        elseif($columnName=='seat_id'){
                            $nameTextCombobox='seat_type_id';
                            $tabelTextCombobox='seat';
                        }
                        elseif($columnName=='transaction_id'){
                            $nameTextCombobox='user_id';
                            $tabelTextCombobox='transactions';
                        }
                    }
                    $queryData = "SELECT $columnName,$nameTextCombobox FROM $tabelTextCombobox";
                    $resultData = mysqli_query($conn, $queryData);
                    while ($rowData = mysqli_fetch_assoc($resultData)) {          
                        if($value==$rowData[key($rowData)]){
                            echo "<option value='" . $rowData[$columnName] . "' selected>" .$rowData[key($rowData)] ." - " . $rowData[$nameTextCombobox] . "</option>";
                        }
                        else{
                            echo "<option value='" . $rowData[$columnName] . "'>" .$rowData[key($rowData)] ." - " . $rowData[$nameTextCombobox] . "</option>";
                        }      
                    }
                    echo "</select>";      
                }
                elseif($columnName=='gender'){
                    echo "<select id='$columnName' name='$columnName'>";
                    echo "<option value='Male' " . ($value == 'Male' ? 'selected' : '') . ">Male</option>";
                    echo "<option value='Female' " . ($value == 'Female' ? 'selected' : '') . ">Female</option>";
                    echo "<option value='Other' " . ($value != 'Male' && $value != 'Female'? 'selected' : '') . ">Other</option>";
                    echo "</select>";
                }
                elseif($columnName=='payment_method'){
                    echo"<select id='$columnName' name='$columnName'>";
                    echo"<option value='payment1' ".($value=='payment1'? 'selected':'').">Momo</option>";
                    echo"<option value='payment2' ".($value=='payment2'? 'selected':'').">Visa</option>";
                    echo "</select>";
                }
                elseif (strpos($columnName, 'date') !== false || $columnName=='voucher_condition') {
                    // Hiển thị input cho người dùng chọn ngày
                    echo "<input type='date' id='$columnName' name='$columnName' value='$value'>";
                }
                else if($columnName == 'image'){
                    echo "<div id='file_path'>";
                    echo "<input type='file' id='image_upload' name='image_upload' onchange=\"checkImage()\" >";
                    // echo "<input type='hidden' name='old_image_path' value='$value'>";
                    if ($value!=''){
                        echo "<span id='file_name'>Ảnh hiện tại:$value</span>";
                    }
                    echo "</div>";
                }
                elseif($columnName == 'display' || $columnName =='status') {
                    echo "<input type='text' id='$columnName' name='$columnName' value='$value' >";
                }
                elseif( $columnName =='voucher_discount'|| $columnName =='score'
                        || $columnName =='coin'|| $columnName =='total_cost'
                        || strpos($columnName, 'price') !== false||strpos($columnName, 'number') !== false) {
                    echo "<input type='number' id='$columnName' name='$columnName' onchange=\"checkNumber('$columnName')\" value='$value' min='0'>";
                }
                elseif($columnName == 'phone') {
                    echo "<input type='tel' id='$columnName' name='$columnName' onchange=\"checkPhone('$columnName')\" value='$value'>";
                }
                elseif($columnName == 'email') {
                    echo "<input type='email' id='$columnName' name='$columnName' onchange=\"checkEmail('$columnName')\" value='$value'>";
                }

                else{
                    // Hiển thị các input với giá trị từ cơ sở dữ liệu
                    echo "<input type='text' id='$columnName' name='$columnName' value='$value'>";
                }
                
                echo "</div>";
            }
            // Hiển thị nút Submit và đóng form
            echo "<div id='btn-submit'>";
            echo "<button type=\"submit\"  onclick=\"updateDB('$tableName','$id','$idtable',event)\" >Submit</button>";
            echo "</div>";
            echo "</form>";
            echo "</div";
        } else {
            echo "Error retrieving data from the database.";
        }
    }
    else{
        //không có thì chuyển sang add
        $query = "DESCRIBE $tableName"; 
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<button id='back-btn' onclick=\"showPage('$tableName',1)\">Back</button>";
            // Hiển thị form nhập liệu
            echo "<div id='admin_add'>";
            echo "<form  id='add_form' enctype='multipart/form-data'>"; // Chú ý thêm tham số 'name' vào action
            echo"<input type='hidden' name='tableName' value='<?php echo $tableName; ?>'> ";
            $columnIndex = 0;   
            while ($row = mysqli_fetch_assoc($result)) {    
                $columnName = $row['Field'];
                echo "<div id='label_add'>";
                echo "<label for='$columnName'>$columnName:</label>";
                echo "</div>";
                echo "<div id='input_add'>";
                
                if ($columnIndex == 0 && strpos($columnName, 'id') !== false && $row['Key'] == 'PRI' ) {
                    // Skip displaying this column if it contains 'id' and it is the primary key
                    // $columnIndex++;
                    // continue;
                    if ($tableName==='combo'||$tableName==='movie'||$tableName==='showtime'||$tableName==='transactions'||$tableName==='reservation'){
                        echo "<input type='text' id='$columnName' name='$columnName' value='$codeTable$string$totalRows' readonly>";
                    }
                    
                    else if ($tableName==='voucher'){
                        echo "<input type='text' id='$columnName' name='$columnName' value='$currentDate$string$totalRows' readonly>";
                    }
                    elseif ($tableName==='seat' ||$tableName==='users'){
                        echo "<input type='text' id='$columnName' name='$columnName' value='' readonly>";
                    }
                    else{
                        echo "<input type='text' id='$columnName' name='$columnName' value='$totalRows' readonly>";
                    }               
                }

                // Kiểm tra nếu cột chứa "id" và không ở cột đầu
                else if (strpos($columnName, 'id') !== false && $columnIndex != 0 ) {
                    echo "<select id='$columnName' name='$columnName'>";
                    // Thực hiện truy vấn để lấy dữ liệu cho combobox
                    // Lấy dữ liệu từ các bảng khác nhau dựa vào tên cột
                    if ($tableName == 'seat') {
                        if($columnName=='seat_type_id'){
                            $nameTextCombobox='type';
                            $tabelTextCombobox='seat_type';
                        }
                        elseif($columnName=='room_id'){
                            $nameTextCombobox='room_name';
                            $tabelTextCombobox='room';
                        }
                    }   
                    else if ($tableName=='transactions'){
                        if($columnName=='user_id'){
                            $nameTextCombobox='full_name';
                            $tabelTextCombobox='users';
                        }
                        elseif($columnName=='voucher_id'){
                            $nameTextCombobox='voucher_discount';
                            $tabelTextCombobox='voucher';
                        }
                    }
                    else if ($tableName=='reservation'){
                        if($columnName=='showtime_id'){
                            $nameTextCombobox='movie_id';
                            $tabelTextCombobox='showtime';
                        }
                        elseif($columnName=='seat_id'){
                            $nameTextCombobox='seat_type_id';
                            $tabelTextCombobox='seat';
                        }
                        elseif($columnName=='transaction_id'){
                            $nameTextCombobox='user_id';
                            $tabelTextCombobox='transactions';
                        }
                    }
                    $queryData = "SELECT $columnName,$nameTextCombobox FROM $tabelTextCombobox";
                    $resultData = mysqli_query($conn, $queryData);
                    while ($rowData = mysqli_fetch_assoc($resultData)) {
                        echo "<option value='" . $rowData[$columnName] . "'>" .$rowData[key($rowData)] ." - " . $rowData[$nameTextCombobox] . "</option>";
                    }
                    echo "</select>";
                }
                elseif($columnName=='gender'){
                    echo"<select id='$columnName' name='$columnName'>";
                    echo"<option value='Male'>Male</option>";
                    echo"<option value='Female'>Female</option>";
                    echo"<option value='Other'>Other</option>";
                    echo "</select>";
                }
                elseif($columnName=='payment_method'){
                    echo"<select id='$columnName' name='$columnName'>";
                    echo"<option value='payment1'>Momo</option>";
                    echo"<option value='payment2'>Visa</option>";
                    echo "</select>";
                }
                elseif (strpos($columnName, 'date') !== false || $columnName=='voucher_condition') {
                    // Hiển thị input cho người dùng chọn ngày
                    echo "<input type='date' id='$columnName' name='$columnName'>";
                }
                else if($columnName == 'image'){
                    echo "<div id='file_path'>";
                    echo "<input type='file' id='image_upload' name='image_upload' onchange=\"checkImage()\">";
                    echo "</div>";
                }
                elseif($columnName == 'display' || $columnName =='status') {
                    echo "<input type='text' id='$columnName' name='$columnName' value='0' readonly>";
                }
                elseif( $columnName =='voucher_discount'|| $columnName =='score'
                        || $columnName =='coin'|| $columnName =='total_cost'
                        || strpos($columnName, 'price') !== false||strpos($columnName, 'number') !== false) {
                    echo "<input type='number' id='$columnName' name='$columnName' onchange=\"checkNumber('$columnName')\" value='0'>";
                }
                elseif($columnName == 'phone') {
                    echo "<input type='tel' id='$columnName' name='$columnName' onchange=\"checkPhone('$columnName')\">";
                }
                elseif($columnName == 'email') {
                    echo "<input type='email' id='$columnName' name='$columnName' onchange=\"checkEmail('$columnName')\">";
                }
                else {
                    echo "<input type='text' id='$columnName' name='$columnName'>";
                }
                echo "</div>";
                $columnIndex++;
            }
            echo "<div id='btn-submit'>";
            echo "<button type=\"submit\"  onclick=\"insertDB('$tableName',event)\" >Submit</button>";
            echo "</div>";
            echo "</form>";
            echo "</div>";
        } 
        else {
            echo "Error retrieving table structure.";
        }
    }
} else {
    echo "error";
}
?>

<script src="script_admin.js"></script>
