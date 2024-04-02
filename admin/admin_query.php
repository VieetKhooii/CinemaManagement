<link rel="stylesheet" href="style_admin.css">
<?php
    include("connect.php");
    // Số lượng bản ghi trên mỗi trang
    $records_per_page = 10;

    // Xác định trang hiện tại
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }

    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $start = ($current_page - 1) * $records_per_page;
        // Truy vấn chỉ lấy ra một phần của dữ liệu dựa trên trang hiện tại
        $query = "SELECT * FROM $name LIMIT $start, $records_per_page";
        $result = mysqli_query($conn, $query);
            
        if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result)==0 ) {
            echo "<button id='add-btn' onclick=\"openPage('$name',0)\">Add</button>";
            echo "<table id='table_query' >";
            // Hiển thị tiêu đề của bảng
            echo "<tr>";
            $firstColumnName="";
            $statusDisplay=[];
            while ($fieldinfo = mysqli_fetch_field($result)) {
                echo "<th>" . $fieldinfo->name . "</th>";
                if ($firstColumnName===""){
                    $firstColumnName=$fieldinfo->name;
                }
            }
            echo "<th>Actions</th>";
            echo "</tr>";

            // Hiển thị dữ liệu trên từng dòng
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td class='table-cell'>" . $value . "</td>";
                }
                echo "<td class='button-container'>";
                echo "<button class='edit-btn' data-value='" . reset($row) . "' onclick=\"openPage('$name',1,this.dataset.value,'$firstColumnName')\">Edit</button>";
                echo "<button class='delete-btn' data-value='" . reset($row) . "' onclick=\"deleteDB('$name',this.dataset.value,'$firstColumnName')\">Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

            
            // Tính toán và hiển thị các nút điều hướng trang
            $query = "SELECT COUNT(*) AS total_records FROM $name";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['total_records'];
            $total_pages = ceil($total_records / $records_per_page);

            echo "<div class='pagination'>";
            if ($current_page > 1) {
                echo "<a href='javascript:void(0);' onclick='showPage(\"$name\", 1)'>First</a>";
                echo "<a href='javascript:void(0);' onclick='showPage(\"$name\", " . ($current_page - 1) . ")'>Previous</a>";
            }

            $range = 3; // Số lượng trang hiển thị xung quanh trang hiện tại
            $start = ($current_page - $range > 0) ? $current_page - $range : 1;
            $end = ($current_page + $range < $total_pages) ? $current_page + $range : $total_pages;

            for ($i = $start; $i <= $end; $i++) {
                echo "<a href='javascript:void(0);' onclick='showPage(\"$name\", $i)'";
                if ($i == $current_page) {
                    echo " class='active'";
                }
                echo ">$i</a>";
            }

            if ($current_page < $total_pages) {
                echo "<a href='javascript:void(0);' onclick='showPage(\"$name\", " . ($current_page + 1) . ")'>Next</a>";
                echo "<a href='javascript:void(0);' onclick='showPage(\"$name\", $total_pages)'>Last</a>";
            }
            echo "</div>";

        } else {
            echo "<br>No data found.";
        }
    } else {
        echo "Tham số 'name' không được truyền trong URL.";
    }

?>
<script src="script_admin.js"></script>