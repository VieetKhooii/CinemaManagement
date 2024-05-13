<?php
header('Content-type: text/html; charset=utf-8');
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}


$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

// Các thông tin cần gửi để tạo đơn hàng
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua mã QR MoMo";
$redirectUrl = "http://localhost:3000/resources/views/payment.php";
$ipnUrl = "http://localhost:3000/resources/views/payment.php";
$extraData = "";
$amount = $_POST["amount"]; // Lấy giá trị đơn hàng

// Tạo requestId và requestType
$requestId = time() . "";
$requestType = "captureWallet";

// Tạo chuỗi rawHash và tính toán chữ ký signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $requestId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

// Dữ liệu gửi đi
$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $requestId, // Sử dụng requestId làm orderId
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

// Gửi yêu cầu tạo thanh toán
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);
$payUrl = $jsonResult['payUrl'];

// Khởi tạo cURL để lấy nội dung từ payUrl
$ch = curl_init($payUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'
]);
$response = curl_exec($ch);

if ($response === false) {
    echo json_encode(['error' => 'Lỗi khi tải nội dung từ URL: ' . curl_error($ch)]);
    exit;
}

// Đóng session cURL
curl_close($ch);
// Tạo một đối tượng DOMDocument
$dom = new DOMDocument();
// Load nội dung HTML vào DOMDocument
@$dom->loadHTML($response);
// Tạo một đối tượng DOMXPath
$xpath = new DOMXPath($dom);
// Tìm tất cả các thẻ img có class là 'image-qr-code'
$qrCodeImages = $xpath->query('//img[contains(@class, "image-qr-code")]');

// Duyệt qua danh sách các thẻ img tìm được và lấy thuộc tính src của thẻ đầu tiên
$qrCodeFile = null;
foreach ($qrCodeImages as $image) {
    $qrCodeFile = $image->getAttribute('src');
    break; // Chỉ lấy src của thẻ đầu tiên
}
// header('Location: ' . $jsonResult['payUrl']);
// Trả về kết quả dưới dạng JSON
if ($qrCodeFile) {
    echo json_encode(['qrCodeFile' => $qrCodeFile]);
} else {
    echo json_encode(['error' => 'Không tìm thấy ảnh QR code']);
}
