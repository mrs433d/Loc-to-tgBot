<?php
// توکن بات و چت‌آیدی
$telegram_token = '7926937226:AAFcIfZulEjhnXx7gQpnm712eE1-LvKoT_o';
$chat_id = '-1002570608346';  // مثلا '-123456789'

// دریافت ورودی JSON
$data = json_decode(file_get_contents("php://input"), true);

// بررسی اعتبار ورودی
if (!isset($data['latitude']) || !isset($data['longitude'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

// دریافت مقادیر
$latitude = $data['latitude'];
$longitude = $data['longitude'];

// ارسال به API تلگرام
$telegram_api_url = "https://api.telegram.org/bot{$telegram_token}/sendLocation";

$params = [
    'chat_id' => $chat_id,
    'latitude' => $latitude,
    'longitude' => $longitude
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($params),
    ]
];

$context  = stream_context_create($options);
$result = file_get_contents($telegram_api_url, false, $context);

// بررسی نتیجه
if ($result === FALSE) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'ارسال به تلگرام ناموفق بود']);
    exit;
}

echo json_encode(['status' => 'success', 'message' => 'موقعیت ارسال شد به تلگرام']);
?>