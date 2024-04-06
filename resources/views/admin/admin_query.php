<link rel="stylesheet" href="css/style_admin.css">
<?php
    $result = $_POST['message'];
    $name = $_POST['name'];
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
                echo "<button class='delete-btn' data-value='" . reset($row) . "' onclick=\"deleteDB('$name',this.dataset.value,'$firstColumnName')\">Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

    }
    catch (\Exception $exception){
        echo("Chưa có dữ liệu, hãy thêm zô!");
    }
?>
<script src="js/script_admin.js"></script>