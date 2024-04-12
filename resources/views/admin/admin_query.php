<link rel="stylesheet" href="css/style_admin.css">
<?php
    $result = $_POST['message'];
    $name = $_POST['name'];
    $total_pages = $_POST['total'];
    $current_page = $_POST['current_page'];
    echo "<button id='add-btn' onclick=\"openPage('$name',0)\">Add</button>";
    echo "<table id='table_query' >";
    echo "<tr>";
    try{
            $firstColumnName = "";
            $statusDisplay = [];
            foreach ($result[0] as $key => $value) {
                echo "<th>" . $key . "</th>";
                if ($firstColumnName === "") {
                    $firstColumnName = $key;
                }
            }
            echo "<th>Actions</th>";
            echo "</tr>";
            foreach ($result as $row) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td class='table-cell'>" . $value . "</td>";
                }
                echo "<td class='button-container'>";
                echo "<button class='edit-btn' data-value='" . reset($row) . "' onclick=\"openPage('$name',1,this.dataset.value,'$firstColumnName')\">Edit</button>";
                echo "<button class='delete-btn' data-value='" . reset($row) . "' onclick=\"deleteDB('$name',this.dataset.value)\">Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

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


    }
    catch (\Exception $exception){
        echo("Chưa có dữ liệu, hãy thêm zô!");
    }
?>
<script src="js/script_admin.js"></script>