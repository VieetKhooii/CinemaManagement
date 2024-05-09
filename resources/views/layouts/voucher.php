<link rel="stylesheet" href="../css/voucher.css">
<?php 
    if($_POST['result']){
        $array = $_POST['result'];
        echo '<div class="container_voucher">
        <div class="list_voucher">';
        foreach ($array as $row){
            echo '
                    <div class="voucher">
                        <div class="img" style="background: url('.'img/background_dang_ki.jpg'.') no-repeat center; background-size: 100% 100%;"></div>
                        <div class="description">
                            <p>';
                            echo "Giảm giá: ".$row['voucher_discount']."%<br>";
                            echo $row['description'];
                            echo '</p>
                        </div>
                        <div class="text_time">';
                            $date = new DateTime($row['voucher_condition']);
                            $formatted_date = $date->format('Y-m-d');
                            echo $formatted_date;
                        echo '</div>
                    </div>';
        }
        echo '</div>
            </div>';
    } else {
        echo "No data received";  // Debug message
    }
?>